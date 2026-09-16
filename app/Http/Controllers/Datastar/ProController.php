<?php

namespace App\Http\Controllers\Datastar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

/**
 * Star Federation archive — every word of every episode.
 *
 * Signals arrive as one query string, rendered HTML goes back as one SSE event.
 * No SDK, no JSON API. The corpus lives in database/pro.sqlite (see pro:build);
 * FTS5 does the searching so nothing is held in memory between requests.
 */
class ProController extends Controller
{
    private const LIMIT = 30;       // room for every episode on the default view

    private const MONTHS = ['January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'];

    public function index()
    {
        return view('datastar.pro.index', [
            'terms' => DB::connection('pro')->select('SELECT word, hits FROM terms ORDER BY hits DESC'),
        ]);
    }

    public function search(Request $request): Response
    {
        $signals = json_decode($request->query('datastar', '{}'), true) ?: [];
        $query = trim($signals['query'] ?? '');

        $payload = $this->ssePatchElements(
            '<main id="results">'.$this->timeline($this->hits($query), $query).'</main>'
        );

        return response($payload, 200, [
            'Content-Type' => 'text/event-stream',
            'Cache-Control' => 'no-cache',
        ]);
    }

    /** The matching segments, oldest first so results stack upward. */
    private function hits(string $query): array
    {
        $db = DB::connection('pro');

        if ($query === '') {
            // no query: one moment from each episode, a couple of minutes in to
            // clear the intro — but short episodes have nothing past 2:00, so
            // fall back to their opening line rather than dropping them
            $rows = $db->select(
                'SELECT s.*, e.title, e.aired
                   FROM segments s
                   JOIN episodes e ON e.video = s.video
                  WHERE s.id IN (
                        SELECT COALESCE(MIN(CASE WHEN from_ms > 120000 THEN id END), MIN(id))
                          FROM segments GROUP BY video
                  )
                  ORDER BY e.aired DESC, s.from_ms ASC
                  LIMIT '.self::LIMIT
            );
        } else {
            $match = $this->ftsQuery($query);
            if ($match === '') {
                return [];
            }
            $rows = $db->select(
                'SELECT s.*, e.title, e.aired
                   FROM segments_fts f
                   JOIN segments s ON s.id = f.rowid
                   JOIN episodes e ON e.video = s.video
                  WHERE segments_fts MATCH ?
                  ORDER BY e.aired DESC, s.from_ms ASC
                  LIMIT '.self::LIMIT,
                [$match]
            );
        }

        // newest first while we trim, then flip: the oldest ends up highest and
        // the newest sits nearest the planet you launch from
        return array_reverse($rows);
    }

    /**
     * Turn what has been typed into an FTS5 query. Every word is quoted so
     * punctuation can't be read as an operator, and the word still being typed
     * matches as a prefix — "gazpach" finds "gazpacho" before you finish it.
     */
    private function ftsQuery(string $query): string
    {
        if (! preg_match_all("/[\p{L}\p{N}']+/u", $query, $found) || ! $found[0]) {
            return '';
        }

        $last = count($found[0]) - 1;
        foreach ($found[0] as $i => $word) {
            $found[0][$i] = '"'.$word.'"'.($i === $last ? '*' : '');
        }

        return implode(' ', $found[0]);
    }

    /** Months as nodes on the line, cards alternating sides month by month. */
    private function timeline(array $hits, string $query): string
    {
        if (! $hits) {
            $total = DB::connection('pro')->selectOne('SELECT COUNT(*) AS n FROM segments')->n;

            return '<p>Nothing in '.number_format($total).' transcript segments.</p>';
        }

        $body = '';
        $month = null;
        $months = 0;

        foreach ($hits as $hit) {
            $label = self::MONTHS[(int) substr($hit->aired, 4, 2) - 1].' '.substr($hit->aired, 0, 4);
            if ($label !== $month) {
                $body .= $month === null ? '' : '</div></section>';
                $body .= '<section class="tl-month'.($months % 2 ? ' tl-flip' : '').'">'
                        .'<h2 class="stamp">'.$label.'</h2><div class="tl-items">';
                $month = $label;
                $months++;
            }
            $body .= $this->mention($hit, $query);
        }

        $body .= '</div></section>';        // close the final month

        return '<div class="timeline">'.$body.'</div>';
    }

    private function mention(object $hit, string $query): string
    {
        [$before, $text, $after] = $this->context($hit->video, (int) $hit->idx);

        $marked = e($text);
        if ($query !== '' && preg_match_all("/[\p{L}\p{N}']+/u", $query, $words)) {
            // one pass over an alternation, so a word can't land inside a tag
            $alt = implode('|', array_map(
                fn ($w) => preg_quote(e($w), '/'),
                array_unique($words[0])
            ));
            $marked = preg_replace('/('.$alt.')/iu', '<mark>$1</mark>', $marked);
        }

        return view('datastar.pro.mention', [
            'video' => $hit->video,
            'title' => $hit->title,
            'stamp' => intdiv($hit->from_ms, 60000).':'.sprintf('%02d', intdiv($hit->from_ms, 1000) % 60),
            'start' => max(0, intdiv($hit->from_ms, 1000) - 2),
            'before' => $before,
            'hit' => $marked,
            'after' => $after,
        ])->render();
    }

    /** A readable quote: the hit plus its neighbours from the same episode. */
    private function context(string $video, int $idx): array
    {
        $rows = DB::connection('pro')->select(
            'SELECT idx, text FROM segments WHERE video = ? AND idx BETWEEN ? AND ? ORDER BY idx',
            [$video, $idx - 2, $idx + 2]
        );

        $before = $after = [];
        $hit = '';
        foreach ($rows as $row) {
            match (true) {
                $row->idx < $idx => $before[] = $row->text,
                $row->idx > $idx => $after[] = $row->text,
                default => $hit = $row->text,
            };
        }

        return [
            $this->clip(implode(' ', $before), 70, true),
            $this->clip($hit, 150),
            $this->clip(implode(' ', $after)),
        ];
    }

    /** Keep quotes card-sized. */
    private function clip(string $text, int $length = 70, bool $tail = false): string
    {
        $text = trim($text);
        if (mb_strlen($text) <= $length) {
            return $text;
        }

        return $tail
            ? '…'.mb_substr($text, -$length)
            : mb_substr($text, 0, $length).'…';
    }

    /** The entire wire format: one SSE event carrying HTML. */
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
}
