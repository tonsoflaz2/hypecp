<?php

namespace App\Console\Commands\Csv;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Csv\Month;

class MonthCache extends Command
{
    protected $signature = 'csv:month-cache';

    protected $description = 'Goes through every table and creates a row for each month and table';

    public function handle()
    {
        $connection = DB::connection('csvs');

        $tables = $connection->select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");
        $tables = array_map(fn($table) => $table->name, $tables);

        //dd($tables);

        foreach ($tables as $table) {
            if ($table === 'months') {
                continue;
            }
            if ($table === 'comments') {
                continue;
            }

            $counts = $connection->table($table)
                ->select('hype_month', DB::raw('COUNT(*) as count'))
                ->whereNotNull('hype_month')
                ->groupBy('hype_month')
                ->get();

            foreach ($counts as $entry) {
                $month = Month::where('hype_month', $entry->hype_month)
                              ->where('csv', $table)
                              ->first();

                if (!$month) {
                    $month  = new Month;
                    $month->hype_month = $entry->hype_month;
                    $month->csv = $table;
                    $month->count = $entry->count;
                    $month->save();
                }

                $this->info("Cached month: {$entry->hype_month} for table: {$table} with count: {$entry->count}");
            }
        }

        $this->info('Month caching completed successfully.');
    }

}
