<?php

namespace App\Console\Commands\Datastar;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class RedisLoop extends Command
{
    protected $signature = 'ds:redis-loop';

    protected $description = 'Loops our grid updates in the background, sends them to redis array';

    public function handle()
    {
        $this->info('Starting Redis ripple loop. Press Ctrl+C to stop.');

        $width = 55;
        $height = 40;

        // Initialize grid
        $current = array_fill(0, $height, array_fill(0, $width, 0));
        $previous = array_fill(0, $height, array_fill(0, $width, 0));


        $redis = Redis::connection();

        while (true) {
            // Check for any incoming ripple trigger
            $signal = json_decode($redis->get('ripple_signal'), true);
            if (isset($signal['x']) && isset($signal['y'])) {

                $x = (int)$signal['x'];
                $y = (int)$signal['y'];
                $z = (int)$signal['z'];
                echo "Signal $x $y $z\n";
                if ($x >= 1 && $x < $width-1 && $y >= 1 && $y < $height-1) {
                    $previous[$y][$x] = $z; // Inject a ripple
                    $previous[$y][$x-1] = 10;
                    $previous[$y][$x+1] = 10;
                    $previous[$y-1][$x] = 10;
                    $previous[$y-1][$x-1] = 10;
                    $previous[$y-1][$x+1] = 10;
                    $previous[$y+1][$x] = 10;
                    $previous[$y+1][$x-1] = 10;
                    $previous[$y+1][$x+1] = 10; 
                }
                $redis->del('ripple_signal'); // Clear signal after use
            }

            // if (rand(1,50) == 45) {
            //     $first = rand(2,$height-2);
            //     $second = rand(2,$width-2);
            //     $current[$first][$second] = rand(20,40);
            // }

            // Run one ripple step
            for ($y = 1; $y < $height - 1; $y++) {
                for ($x = 1; $x < $width - 1; $x++) {
                    $current[$y][$x] = (
                        $previous[$y - 1][$x] +
                        $previous[$y + 1][$x] +
                        $previous[$y][$x - 1] +
                        $previous[$y][$x + 1]
                    ) / 2 - $current[$y][$x];

                    $current[$y][$x] *= 0.98;
                }
            }

            // Round down to zero
            for ($y = 0; $y < $height; $y++) {
                for ($x = 0; $x < $width; $x++) {
                    $current[$y][$x] = round($current[$y][$x], 3);
                    $previous[$y][$x] = round($previous[$y][$x], 3);

                    if (abs($current[$y][$x]) < 0.5) {
                        $current[$y][$x] = 0;
                    }
                    if (abs($previous[$y][$x]) < 0.5) {
                        $previous[$y][$x] = 0;
                    }
                }
            }

            // Edges stay at zero
            for ($i = 0; $i < $width; $i++) {
                $current[0][$i] = 0;
                $current[$height - 1][$i] = 0;
            }
            for ($j = 0; $j < $height; $j++) {
                $current[$j][0] = 0;
                $current[$j][$width - 1] = 0;
            }


            // Swap buffers
            $temp = $previous;
            $previous = $current;
            $current = $temp;

            // Store updated grid to Redis
            $redis->set('ripple_grid', json_encode($current));

            /*
            // Optional debug output:
            //$this->line("Updated ripple frame at " . now());
            foreach ($current as $col => $rows) {
                foreach ($rows as $row => $val) {
                    echo "$val | ";
                }
                echo "\n";
            }
            */
            usleep(15000); // 20ms
        }
    }
}
