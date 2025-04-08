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
            transform: rotateX(53deg) rotateZ(45deg) scale(1.8) translateX(100px) translateY(100px);
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

    <div class="grid" id="rippleGrid">
        
    </div>

    <script type="text/javascript">
        function ripple(x, y, z) {
            new Image().src = `/demos/live-datastar/ripple?x=${x}&y=${y}&z=${z}`;
        }
    </script>

</body>
</html>
