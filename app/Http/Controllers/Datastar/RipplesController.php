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
                        foreach ($row as $x => $val) {
                            if (!$val) {
                                $str .= ".";
                                continue;
                            }
                            $ascii = asciiByWhitespace(abs($val));

                            if ($val > 1) {
                                $str .= "<span style='color: #FFF;'>$ascii</span>";
                            } elseif ($val < -1) {
                                $str .= "<span style='color: #000;'>$ascii</span>";
                            } else {
                                $str .= $ascii;
                            }
                        }
                        $str .= "<br>";
                    }
                    
                    //$this->mergeSignals(['_contents' => $str]);

                    $str = "<div id='html'>".$str."</div>";

                    $str .= "<span id='fps_server'>".$redis->get('ripple_server_fps')."</span>";
                    
                    $str .= "<span id='fps_stream'>".$fps."</span>";

                    $this->mergeFragments($str);
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