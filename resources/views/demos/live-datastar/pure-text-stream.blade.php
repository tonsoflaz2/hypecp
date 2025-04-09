@php 
    ignore_user_abort(false);
    ini_set('max_execution_time', 36000);
    $redis = \Illuminate\Support\Facades\Redis::connection();
    $oldgrid = json_decode($redis->get('ripple_grid'));

    $lastFrameTime = microtime(true);
    $fps = 0;
@endphp

@while(true)

    @php
        $grid = json_decode($redis->get('ripple_grid'));
    @endphp

    @if ($oldgrid != $grid)
        @php
            $str = "";
            foreach ($grid as $y => $row) {
                foreach ($row as $x => $val) {
                    $str .= asciiByWhitespace(abs($val));
                }
                $str .= "\n";
            }
        @endphp
        
        @mergesignals(['_contents' => $str]) 

    @endif

    @php
        usleep(50000);
    @endphp

@endwhile
