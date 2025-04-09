
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
        @mergefragments
            <div class="grid" id="rippleGrid">
        
                @foreach ($grid as $y => $row)
                    @foreach ($row as $x => $val)

                        @php
                            $ascii = asciiByWhitespace(abs($val));
                        @endphp
                       
                        @if ($val > 5)
                            <span x="{{$x}}" y="{{$y}}" style="color: white;">{{ $ascii }}</span>
                        @elseif ($val < -1)
                            <span x="{{$x}}" y="{{$y}}" style="color: black;">{{ $ascii }}</span>
                        @else
                            <span x="{{$x}}" y="{{$y}}">{{ $ascii }}</span>
                        @endif
                            
                        
                        
                    @endforeach
                    <br>
                @endforeach
                
            </div>
            <span id="fps_server">{{ $redis->get('ripple_server_fps') }}</span>
            <span id="fps_stream">{{ $fps }}</span>
            
        @endmergefragments
        @php
            $oldgrid = $grid;
        @endphp
    @endif


    @php
        usleep(5000);

        $now = microtime(true);
        $delta = $now - $lastFrameTime;

        if ($delta > 0) {
            $fps = round(1 / $delta, 1);
        }

        $lastFrameTime = $now;
    @endphp

@endwhile
