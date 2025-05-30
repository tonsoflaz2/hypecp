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
            height: 2000px;
            background-image: url("/images/pool3.png");
            background-size: 1524px;
            background-position: 0px;
            background-repeat: no-repeat;
            background-color: black;
        }
        .grid {
            display: flex;
            flex-wrap: wrap;
            width: calc(55 * 16px);
            transform: rotateX(53deg) rotateZ(45deg) scale(0.72) translateX(1590px) translateY(990px);
            transform-style: preserve-3d;
            opacity: 1;
            mix-blend-mode: color-dodge;
            
        }
        .cell {
            width: 16px;
            height: 16px;
            border-radius: 2px;
            font-size: 10px;
            color: #aaa;
            
            /*border-right: 1px solid lightgray;
            border-top: 1px solid lightgray;*/
        }

    </style>
</head>


<body data-on-load="@get('/demos/live-datastar/stream')"
      data-on-click="ripple(evt.target.getAttribute('x'), evt.target.getAttribute('y'), 120)"
      data-on-mouseover="ripple(evt.target.getAttribute('x'), evt.target.getAttribute('y'), 20)">

    <!-- style="background-image: url(/images/pool.jpg);" -->
    <div class="grid" 
         id="rippleGrid"
         >
        @foreach ($grid as $y => $row)
            @foreach ($row as $x => $val)
                <div class="cell" x="{{ $x }}" y="{{ $y }}"></div>
            @endforeach
        @endforeach
    </div>

    <script type="text/javascript">
        function ripple(x, y, z) {
            new Image().src = `/demos/live-datastar/ripple?x=${x}&y=${y}&z=${z}`;
        }
    </script>
</body>
</html>
