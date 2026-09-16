<?php

namespace App\Http\Controllers\Datastar;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

/**
 * Star Federation Archive — a raw-Datastar demo. No SDK.
 *
 * The whole real-time contract is two SSE event types, hand-rolled below in
 * ssePatchElements() / ssePatchSignals(). The browser sends its signals as a
 * `datastar` query param; we answer with rendered HTML and updated signals.
 */
class ArchiveController extends Controller
{
    private const MAX_RESULTS = 120;

    private array $mentions = [];
    private array $episodes = [];      // newest first
    private array $epById = [];
    private array $epDates = [];       // video id => "YYYYMMDD"
    private array $mentionsByEp = [];
    private array $termCounts = [];

    private const MONTHS = ['January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'];

    // ------------------------------------------------------------------
    // Lesson part 1: raw Datastar — the entire SSE protocol, no SDK.
    // ------------------------------------------------------------------

    private function ssePatchElements(string $html): string
    {
        $data = '';
        foreach (explode("\n", $html) as $line) {
            if (trim($line) !== '') {
                $data .= "data: elements {$line}\n";
            }
        }

        return "event: datastar-patch-elements\n{$data}\n";
    }

    private function ssePatchSignals(array $signals): string
    {
        return 'event: datastar-patch-signals'."\n".'data: signals '.json_encode($signals)."\n\n";
    }

    public function search(Request $request): Response
    {
        $this->loadData();

        $signals = json_decode($request->query('datastar', '{}'), true) ?: [];
        [$fragment, $count] = $this->renderResults(
            trim($signals['query'] ?? ''),
            $signals['term'] ?? '',
        );

        $payload = $this->ssePatchSignals(['count' => $count])
            .$this->ssePatchElements(
                '<main id="results" data-class:compact="$compact">'.$fragment.'</main>'
            );

        return response($payload, 200, [
            'Content-Type' => 'text/event-stream',
            'Cache-Control' => 'no-cache',
        ]);
    }

    /** The film's /search endpoint: the real loop over the real partial. */
    public function filmSearch(Request $request): Response
    {
        $this->loadData();

        $signals = json_decode($request->query('datastar', '{}'), true) ?: [];
        $q = mb_strtolower(trim($signals['query'] ?? ''));
        $term = $signals['term'] ?? '';

        $hits = array_values(array_filter($this->mentions, function ($m) use ($q, $term) {
            if ($term !== '' && $m['term'] !== $term) {
                return false;
            }

            return $q === '' || str_contains(mb_strtolower($m['text']), $q);
        }));

        $html = '<main id="results" data-init="@get(\'/search\')">';
        foreach (array_slice($hits, 0, 24) as $hit) {
            $ep = $this->epById[$hit['video']] ?? ['title' => $hit['title']];
            $m = (object) [
                'episode' => $ep['title'],
                'quote' => '...'.$hit['text'].'...',
                'video' => $hit['video'],
                'start' => max(0, intdiv($hit['from_ms'], 1000) - 2),
            ];
            $html .= view('mention', ['m' => $m])->render();
        }
        $html .= '</main>';

        return response($this->ssePatchElements($html), 200, [
            'Content-Type' => 'text/event-stream',
            'Cache-Control' => 'no-cache',
        ]);
    }

    /** Video-lesson stage pages: the real app at each build stage. */
    public function stage(string $stage): \Illuminate\View\View
    {
        abort_unless(in_array($stage, ['raw', 'rocket', 'stellar']), 404);

        return view('demos.archive-stage', ['stage' => $stage]);
    }

    /** Film build stages: render a staged copy of the archive view with real data. */
    public function filmStage(string $name): \Illuminate\View\View
    {
        abort_unless(preg_match('/^[a-z0-9_]+$/', $name) === 1, 404);
        $this->loadData();

        $chips = '';
        $topTerms = $this->termCounts;
        arsort($topTerms);
        foreach (array_slice($topTerms, 0, 12, true) as $term => $count) {
            $chips .= '<button type="button" class="chip" data-class:active="$term === \''.$term.'\'"'
                .' data-on:click="$term = $term === \''.$term.'\' ? \'\' : \''.$term.'\'; @get(\'/datastar/podcast/search\')">'
                .e($term).' <small>'.$count.'</small></button>';
        }

        return view('film.stage_'.$name, [
            'chips' => $chips,
            'nEpisodes' => count($this->episodes),
            'nMentions' => count($this->mentions),
        ]);
    }

    public function index(): \Illuminate\View\View
    {
        $this->loadData();

        $chips = '';
        $topTerms = $this->termCounts;
        arsort($topTerms);
        foreach (array_slice($topTerms, 0, 12, true) as $term => $count) {
            $chips .= '<button type="button" class="chip" data-class:active="$term === \''.$term.'\'"'
                .' data-on:click="$term = $term === \''.$term.'\' ? \'\' : \''.$term.'\'; @get(\'/datastar/podcast/search\')">'
                .e($term).' <small>'.$count.'</small></button>';
        }

        return view('demos.archive', [
            'chips' => $chips,
            'nEpisodes' => count($this->episodes),
            'nMentions' => count($this->mentions),
        ]);
    }

    // ------------------------------------------------------------------
    // Data: whisper-transcribed mentions from the podcast supercut project.
    // ------------------------------------------------------------------

    private function loadData(): void
    {
        $dir = storage_path('app/archive');
        $this->mentions = json_decode(file_get_contents("$dir/mentions.json"), true);
        $this->epDates = json_decode(file_get_contents("$dir/episode_dates.json"), true);

        foreach (file("$dir/episodes_meta.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
            [$vid, $secs, $title] = explode('|', $line, 3);
            $this->episodes[] = [
                'id' => $vid, 'secs' => (int) $secs, 'title' => $title,
                'date' => $this->epDates[$vid] ?? '00000000',
            ];
        }
        usort($this->episodes, fn ($a, $b) => strcmp($b['date'], $a['date']));

        foreach ($this->episodes as $ep) {
            $this->epById[$ep['id']] = $ep;
        }
        foreach ($this->mentions as $m) {
            $this->mentionsByEp[$m['video']][] = $m;
            $this->termCounts[$m['term']] = ($this->termCounts[$m['term']] ?? 0) + 1;
        }
    }

    // ------------------------------------------------------------------
    // Rendering: the server owns the HTML. Cards carry Rocket tags
    // (<yt-clip>, <copy-link>) that the browser upgrades — lesson part 2.
    // Each carries a stable id and data-ignore-morph: Rocket renders INTO these
    // elements, but we send them empty, so without those two a re-render would
    // morph the live element to match and delete every Watch button on the page.
    // The id is the identity — a different clip replaces the element outright.
    // ------------------------------------------------------------------

    private function renderResults(string $q, string $term): array
    {
        if ($q === '' && $term === '') {
            $sections = '';
            foreach ($this->groupByMonth($this->episodes, fn ($e) => $e['date']) as $i => [$label, $eps]) {
                $cards = implode('', array_map($this->renderEpisodeCard(...), $eps));
                $flip = $i % 2 ? ' tl-flip' : '';
                $sections .= '<section class="tl-month'.$flip.'"><h3 class="tl-stamp"><span>'.e($label).'</span></h3>'
                    .'<div class="tl-items">'.$cards.'</div></section>';
            }

            return ['<div class="timeline">'.$sections.'</div>', count($this->mentions)];
        }

        $results = array_values(array_filter($this->mentions, function ($m) use ($q, $term) {
            if ($term !== '' && $m['term'] !== $term) {
                return false;
            }
            if ($q === '') {
                return true;
            }
            $ql = mb_strtolower($q);

            return str_contains(mb_strtolower($m['text']), $ql)
                || str_contains(mb_strtolower($m['title']), $ql)
                || str_contains(mb_strtolower($m['before'] ?? ''), $ql)
                || str_contains(mb_strtolower($m['after'] ?? ''), $ql);
        }));

        if ($results === []) {
            return ['<h2>Nothing in the archive</h2>
<p class="muted">No transmissions match. The truth is out there &mdash; try another term.</p>', 0];
        }

        usort($results, fn ($a, $b) => strcmp($this->epDates[$b['video']] ?? '0', $this->epDates[$a['video']] ?? '0')
            ?: $a['from_ms'] <=> $b['from_ms']);

        $shown = array_slice($results, 0, self::MAX_RESULTS);
        $sections = '';
        foreach ($this->groupByMonth($shown, fn ($m) => $this->epDates[$m['video']] ?? '00000000') as $i => [$label, $ms]) {
            $groups = [];
            foreach ($ms as $m) {
                $k = $groups === [] ? null : array_key_last($groups);
                if ($k !== null && $groups[$k][0]['video'] === $m['video']) {
                    $groups[$k][] = $m;
                } else {
                    $groups[] = [$m];
                }
            }
            $cards = implode('', array_map(fn ($g) => $this->renderMentionGroup($g, $q), $groups));
            $n = count($ms);
            $flip = $i % 2 ? ' tl-flip' : '';
            $sections .= '<section class="tl-month'.$flip.'"><h3 class="tl-stamp"><span>'.e($label).'</span>'
                .'<small>'.$n.' mention'.($n === 1 ? '' : 's').'</small></h3>'
                .'<div class="tl-items">'.$cards.'</div></section>';
        }

        $note = count($results) > self::MAX_RESULTS
            ? '<p class="muted">Showing the first '.self::MAX_RESULTS.' of '.count($results).' matches.</p>'
            : '';

        return [$note.'<div class="timeline">'.$sections.'</div>', count($results)];
    }

    /** One card per episode: title + thumb once, then each quote with its own actions. */
    private function renderMentionGroup(array $ms, string $q): string
    {
        $vid = $ms[0]['video'];
        $ep = $this->epById[$vid] ?? ['title' => $ms[0]['title']];

        return view('demos.archive.mention', [
            'vid' => $vid,
            'title' => $ep['title'],
            'epUrl' => $this->ytLink($vid),
            'clips' => array_map(fn ($m) => [
                'ts' => $this->fmtTs($m['from_ms']),
                'term' => $m['term'],
                'start' => max(0, intdiv($m['from_ms'], 1000) - 2),
                'url' => $this->ytLink($vid, $m['from_ms']),
                'before' => $m['before'] ?? '',
                'after' => $m['after'] ?? '',
                'html' => $this->highlight($m['text'], $q),
            ], $ms),
        ])->render();
    }

    private function renderEpisodeCard(array $ep): string
    {
        return view('demos.archive.episode', [
            'id' => $ep['id'],
            'url' => $this->ytLink($ep['id']),
            'title' => $ep['title'],
            'minutes' => round($ep['secs'] / 60),
            'mentions' => count($this->mentionsByEp[$ep['id']] ?? []),
        ])->render();
    }


    /** Preserve input order; return [label, items[]] per calendar month. */
    private function groupByMonth(array $items, callable $dateOf): array
    {
        $groups = [];
        foreach ($items as $item) {
            $key = substr($dateOf($item), 0, 6);
            if ($groups === [] || $groups[array_key_last($groups)][0] !== $key) {
                $groups[] = [$key, []];
            }
            $groups[array_key_last($groups)][1][] = $item;
        }

        return array_map(fn ($g) => [
            self::MONTHS[(int) substr($g[0], 4, 2) - 1].' '.substr($g[0], 0, 4),
            $g[1],
        ], $groups);
    }

    /** Escape text, then wrap case-insensitive matches of the query in <mark>. */
    private function highlight(string $text, string $q): string
    {
        $safe = e($text);
        if ($q === '') {
            return $safe;
        }

        return preg_replace('/('.preg_quote(e($q), '/').')/i', '<mark>$1</mark>', $safe);
    }

    private function ytLink(string $vid, ?int $ms = null): string
    {
        $url = "https://www.youtube.com/watch?v={$vid}";

        return $ms === null ? $url : $url.'&t='.max(0, intdiv($ms, 1000) - 2).'s';
    }

    private function fmtTs(int $ms): string
    {
        $s = intdiv($ms, 1000);
        [$h, $m, $sec] = [intdiv($s, 3600), intdiv($s, 60) % 60, $s % 60];

        return $h ? sprintf('%d:%02d:%02d', $h, $m, $sec) : sprintf('%d:%02d', $m, $sec);
    }
}
