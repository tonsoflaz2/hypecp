<!DOCTYPE html>
<html>
<head>

    @php
        $redis = \Illuminate\Support\Facades\Redis::connection();
        $grid = json_decode($redis->get('ripple_grid'));

        //dd($grid);

    @endphp

    <title>Ripple Grid</title>
    <style>
        body {
            background-color: #000;
            color: rgb(127,127,127);
            font-family: monospace;
        }
        .grid {
            white-space: nowrap;
                transform: rotateX(53deg) 
                           rotateZ(45deg) 
                           scale(2.4) 
                           translateX(350px) 
                           translateY(150px);
                transform-style: preserve-3d;
        }
        /*.grid > span {
            height:10px;
            width:10px;
        }*/
     

    </style>
</head>



<body data-on-load="@get('/demos/live-datastar/text-stream')"
      data-on-click="ripple(evt.target.getAttribute('x'), evt.target.getAttribute('y'), 120)"
      data-on-mouseover="ripple(evt.target.getAttribute('x'), evt.target.getAttribute('y'), 20)">

    FPS Server: <span id="fps_server"></span><br>
    FPS Stream: <span id="fps_stream"></span>

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

    <script type="text/javascript">
        function ripple(x, y, z) {
            new Image().src = `/demos/live-datastar/ripple?x=${x}&y=${y}&z=${z}`;
        }
    </script>

</body>
</html>
