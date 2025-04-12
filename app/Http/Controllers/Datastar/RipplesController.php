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

    protected $white_threshhold = 5;
    protected $white_max_percent = 10;

    public function getNewRun($val)
    {
        if ($val > $this->white_threshhold) {
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
        if (!$oldgrid) {
            return null;
        }

        $sessionId = uniqid('session_', true);

        $redis->sadd('visitors', $sessionId);

        $lastFrameTime = microtime(true);
        $fps = 0;

        $squares = count($oldgrid) * count($oldgrid[0]);

        $white_max = floor(($this->white_max_percent/100) * $squares);

        return $this->getStreamedResponse(function() use ($redis, $oldgrid, $lastFrameTime, $fps, $white_max) {

            while(true) {

                $grid = json_decode($redis->get('ripple_grid'));
                
                $total_white = 0;

                if ($oldgrid != $grid) {

                    $str = "";
                    foreach ($grid as $y => $row) {
                        $current_run = 'clear'; // white, black, clear
                        foreach ($row as $x => $val) {
                            $new_run = $this->getNewRun($val);

                            if ($new_run == 'white') {
                                $total_white++;
                            }
                            
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
                    
                    

                    // for coordinates after transform

                    $str = "<div id='html'>".$str."</div>";

                    $str .= "<span id='fps_server'>".$redis->get('ripple_server_fps')."</span>";
                    
                    $str .= "<span id='fps_stream'>".$fps."</span>";

                    $count = $redis->hlen('ripple_users');
                    // $str .= "<span id='active_count'>".$count."</span>";


                    $vcount = $redis->scard('visitors');
                    $str .= "<span id='visitor_count'>".$vcount."</span>";

                    $this->mergeSignals(['active_count' => $count]);
                    $this->mergeFragments(nl2br($str));
                }

                if ($total_white > $white_max) {
                    $this->white_threshhold = max($this->white_threshhold + 1, 5);
                } else {
                    $this->white_threshhold = max($this->white_threshhold - 1, 5);
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