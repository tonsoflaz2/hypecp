
@signals(_contents)

@php 
    ignore_user_abort(false);
    ini_set('max_execution_time', 36000);
    $redis = \Illuminate\Support\Facades\Redis::connection();
    $oldgrid = json_decode($redis->get('ripple_grid'));

    //dd($oldgrid);

    function asciiByWhitespace($value) {
        // Clamp input value between 0 and 50
        $value = max(0, min(10, $value));

        // Ordered from most whitespace to most visually dense
        $asciiScale = [
            '.', '.', '`', ':', ',', '-', '~', '_', 'i', 'l',
            '!', '|', '/', '\\', '(', ')', '[', ']', '{', '}',
            '^', '<', '>', '=', '+', '*', '?', 't', 'r', 'c',
            's', 'v', 'o', 'u', 'n', 'a', 'e', 'x', 'd', 'g',
            'q', 'b', 'p', 'y', 'm', 'w', '#', '%', '&', '@',
            'M', 'W'
        ];

        // Map 0–10 to the index of the array
        $index = (int) round($value * (count($asciiScale) - 1) / 10);
        return $asciiScale[$index];
    }
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
                                <span x="{{$x}}" y="{{$y}}" class="cell">{{ $ascii }}</span>
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
        usleep(10000); // 20ms delay
    @endphp

@endwhile
