
@signals(x_y)

@php 
    ignore_user_abort(false);
    ini_set('max_execution_time', 36000);
    $redis = \Illuminate\Support\Facades\Redis::connection();
    $oldgrid = json_decode($redis->get('ripple_grid'));
    $max = 0;
    $min = 0;
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
                       
                            <div class="cell" x="{{ $x }}" y="{{ $y }}"
                             style="background-color: rgb({{ ($val/80)*255+20 }},{{ ($val/80)*255+20 }},{{ ($val/80)*255+20 }})">
                            </div>
                        
                        
                    @endforeach
                @endforeach
            </div>
            
        @endmergefragments
        @php
            $oldgrid = $grid;
        @endphp
    @endif

    @php
        usleep(10000); // 20ms delay
    @endphp

@endwhile
