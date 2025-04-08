
@php 
    ignore_user_abort(false);
    ini_set('max_execution_time', 36000);
    $redis = \Illuminate\Support\Facades\Redis::connection();
    $oldgrid = json_decode($redis->get('ripple_grid'));

    //dd($oldgrid);

    
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
            
        @endmergefragments
        @php
            $oldgrid = $grid;
        @endphp
    @endif

    @php
        usleep(10000);
    @endphp

@endwhile
