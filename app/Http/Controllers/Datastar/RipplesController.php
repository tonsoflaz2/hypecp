<?php

namespace App\Http\Controllers\Datastar;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use Putyourlightson\Datastar\DatastarEventStream;
use Symfony\Component\HttpFoundation\StreamedResponse;


class RipplesController extends Controller
{
    use DatastarEventStream;

    public function getNewRun($val)
    {
        if ($val > 5) {
            return 'white';
        }
        return 'clear';
    }

    public function textStream(): StreamedResponse
    {
        ignore_user_abort(false);
        ini_set('max_execution_time', 36000);
        $redis = Redis::connection();
        $oldgrid = json_decode($redis->get('ripple_grid'));

        $lastFrameTime = microtime(true);
        $fps = 0;

        return $this->getStreamedResponse(function() use ($redis, $oldgrid, $lastFrameTime, $fps) {

            while(true) {
                $grid = json_decode($redis->get('ripple_grid'));
                
                if ($oldgrid != $grid) {

                    $str = "";
                    foreach ($grid as $y => $row) {
                        $current_run = 'clear'; // white, black, clear
                        foreach ($row as $x => $val) {
                            $new_run = $this->getNewRun($val);
                            
                            if ($new_run != $current_run) {
                                if ($current_run != 'blank') {
                                    $str .= "</span>";
                                }
                                if ($new_run == 'white') {
                                    $str .= "<span style='color:#FFF;'>";
                                }
                                $current_run = $new_run;
                            }
                            if (!$val) {
                                $str .= ".";
                                continue;
                            }
                            if ($val < -1) {
                                $str .= "&nbsp;";
                                continue;
                            }
                            $ascii = asciiByWhitespace(abs($val));
                            $str .= $ascii;                            
                        }
                        if ($current_run != 'blank') {
                            $str .= "</span>";
                        }
                        $str .= "\n";
                    }
                    
                    //$this->mergeSignals(['_contents' => $str]);

                    // for coordinates after transform
                    $str .= '<div class="handle nw"></div><div class="handle ne"></div><div class="handle se"></div><div class="handle sw"></div>';

                    $str = "<div id='html'>".$str."</div>";

                    $str .= "<span id='fps_server'>".$redis->get('ripple_server_fps')."</span>";
                    
                    $str .= "<span id='fps_stream'>".$fps."</span>";

                    $this->mergeFragments(nl2br($str));
                }

                            
                usleep(20000);

                $now = microtime(true);
                $delta = $now - $lastFrameTime;

                if ($delta > 0) {
                    $fps = round(1 / $delta);
                }

                $lastFrameTime = $now;
            }
        });
    }
}

/*
    
    $asciiScale = [
        '.', '.', '`', ':', ',', '-', '~', '_', 'i', 'l',
        '!', '|', '/', '\\', '(', ')', '[', ']', '{', '}',
        '^', '<', '>', '=', '+', '*', '?', 't', 'r', 'c',
        's', 'v', 'o', 'u', 'n', 'a', 'e', 'x', 'd', 'g',
        'q', 'b', 'p', 'y', 'm', 'w', '#', '%', '&', '@',
        'M', 'W'
    ];

*/