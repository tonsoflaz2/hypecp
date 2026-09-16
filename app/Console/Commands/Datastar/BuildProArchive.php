<?php

namespace App\Console\Commands\Datastar;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * Builds database/pro.sqlite for the datastar/pro archive.
 *
 * The toy Python server keeps all 31k segments in memory because its process is
 * long-lived. PHP-FPM shares nothing between requests, so the index lives in
 * SQLite instead and FTS5 does the searching.
 */
class BuildProArchive extends Command
{
    protected $signature = 'pro:build
                            {--source= : dir holding transcripts/, episodes_meta.txt, episode_dates.json}';

    protected $description = 'Index every transcript segment into database/pro.sqlite (FTS5)';

    /** Offered as suggestion chips — counted for real against the corpus. */
    private const CANDIDATES = [
        'rocket', 'signals', 'stellar', 'htmx', 'javascript', 'react', 'php',
        'hypermedia', 'plugin', 'tailwind', 'sse', 'morph', 'nats', 'python',
        'laravel', 'idiomorph', 'alien', 'cult', 'gazpacho', 'stardust',
    ];

    public function handle(): int
    {
        $source = rtrim($this->option('source') ?: storage_path('app/pro/source'), '/');

        foreach (['transcripts', 'episodes_meta.txt', 'episode_dates.json'] as $needed) {
            if (! file_exists("$source/$needed")) {
                $this->error("Missing $source/$needed — pass --source=/path/to/data");

                return self::FAILURE;
            }
        }

        $titles = [];
        foreach (file("$source/episodes_meta.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
            [$video, , $title] = explode('|', $line, 3);
            $titles[$video] = $title;
        }
        $dates = json_decode(file_get_contents("$source/episode_dates.json"), true);

        $pdo = $this->freshDatabase();
        $this->schema($pdo);

        $episode = $pdo->prepare('INSERT INTO episodes (video, title, aired) VALUES (?, ?, ?)');
        $segment = $pdo->prepare('INSERT INTO segments (video, idx, from_ms, text) VALUES (?, ?, ?, ?)');
        $counts = array_fill_keys(self::CANDIDATES, 0);
        $segments = 0;

        $files = glob("$source/transcripts/*.json");
        sort($files);

        $pdo->beginTransaction();
        foreach ($files as $file) {
            $video = basename($file, '.json');
            if (! isset($titles[$video])) {
                continue;                       // no metadata, not part of the show
            }
            $episode->execute([$video, $titles[$video], $dates[$video] ?? '00000000']);

            $idx = 0;
            foreach (json_decode(file_get_contents($file), true)['transcription'] as $seg) {
                $text = trim($seg['text']);
                if ($text === '') {
                    continue;
                }
                $segment->execute([$video, $idx++, (int) $seg['offsets']['from'], $text]);
                $segments++;

                $lower = mb_strtolower($text);
                foreach (self::CANDIDATES as $word) {
                    $counts[$word] += preg_match_all('/\b'.preg_quote($word, '/').'\b/', $lower);
                }
            }
        }

        $term = $pdo->prepare('INSERT INTO terms (word, hits) VALUES (?, ?)');
        arsort($counts);
        foreach ($counts as $word => $hits) {
            $term->execute([$word, $hits]);
        }
        $pdo->commit();

        // external-content FTS: build the index from the segments table
        $pdo->exec("INSERT INTO segments_fts(segments_fts) VALUES('rebuild')");
        $pdo->exec('ANALYZE');

        $this->info(sprintf(
            'Indexed %s segments from %d episodes -> %s',
            number_format($segments),
            count($files),
            database_path('pro.sqlite')
        ));

        return self::SUCCESS;
    }

    private function freshDatabase(): \PDO
    {
        $path = database_path('pro.sqlite');
        if (is_file($path)) {
            unlink($path);
        }
        touch($path);
        DB::purge('pro');

        return DB::connection('pro')->getPdo();
    }

    private function schema(\PDO $pdo): void
    {
        $pdo->exec('CREATE TABLE episodes (
            video TEXT PRIMARY KEY,
            title TEXT NOT NULL,
            aired TEXT NOT NULL          -- YYYYMMDD
        )');
        $pdo->exec('CREATE TABLE segments (
            id      INTEGER PRIMARY KEY,
            video   TEXT NOT NULL,
            idx     INTEGER NOT NULL,    -- position within its own episode
            from_ms INTEGER NOT NULL,    -- the millisecond it was said
            text    TEXT NOT NULL
        )');
        $pdo->exec('CREATE INDEX segments_video_idx ON segments (video, idx)');
        $pdo->exec('CREATE INDEX segments_from_ms ON segments (from_ms)');
        $pdo->exec("CREATE VIRTUAL TABLE segments_fts USING fts5(
            text, content='segments', content_rowid='id', tokenize='unicode61'
        )");
        $pdo->exec('CREATE TABLE terms (word TEXT PRIMARY KEY, hits INTEGER NOT NULL)');
    }
}
