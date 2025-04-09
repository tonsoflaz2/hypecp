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
                            $str .= $ascii = asciiByWhitespace(abs($val));
                        }
                        $str .= "\n";
                    }
                    
                    $this->mergeSignals(['_contents' => $str]);

                    $str = "<div id='html' style='color:#FFF'>".nl2br($str)."</div>";
                    $this->mergeFragments($str);
                }

                            
                usleep(20000);
            }
        });
    }
}