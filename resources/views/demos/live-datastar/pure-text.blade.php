<!DOCTYPE html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ripple Grid</title>
        <style>
            body {
                background-color: #000;
                color: rgb(127,127,127);
                font-family: monospace;
                overflow: hidden;
                
            }
            #transformer {
                pointer-events: none;
                position: relative;
                transform: rotateX(53deg) 
                           rotateZ(45deg) 
                           scale(2.4) 
                           translateX(300px) 
                           translateY(150px);
                transform-style: preserve-3d;
            }
            #html {
                pointer-events: none;
                letter-spacing: 8px;
/*                border: 2px solid red;*/
                display:inline-block;
                white-space: nowrap;
                -webkit-touch-callout: none;
                -webkit-user-select: none;
                -khtml-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;

                
            }
            #clickable {
                position: absolute;
                display: flex;
                flex-wrap: wrap;
                width: fit-content;
                transform-style: preserve-3d;
                backface-visibility: visible;
                pointer-events: auto;
            }
            .cell {
/*                border: 1px solid red;*/
                height: 12px; 
                width:12px;
                background:none;
                pointer-events: auto;
                will-change: transform;
                color: white;
                font-size: 4px;
            }


        </style>
    </head>

    @php
        $redis = \Illuminate\Support\Facades\Redis::connection();

        $rows = 60;
        $cols = 40;
        $grid_str = $redis->get('ripple_grid');
        if ($grid_str) {
            $grid = json_decode($grid_str);
            if (is_array($grid)) {
                $cols = count($grid[0]);
                $rows = count($grid);
            }
        }
    @endphp

    <body data-signals="{_contents: 'random text goes here'}"
          data-on-load="@get('/demos/pure-text/stream')"
          data-on-click="ripple(evt.target.getAttribute('x'), evt.target.getAttribute('y'), 120)"
          data-on-mouseover="ripple(evt.target.getAttribute('x'), evt.target.getAttribute('y'), 15)">


        <div style="background: black; bottom: 0; margin: 5px; padding: 5px; z-index: 2; position: fixed;">
            FPS Server: <span id="fps_server"></span><br>
            FPS Stream: <span id="fps_stream"></span><br>
            FPS Browse: <span id="fps_browse"></span>
        </div>

        <div style="line-height: 15px; top: 0; right: 0; margin: 20px; padding: 5px; z-index: 2; position: fixed; text-align: right;">
            <div style="font-size: 20px;">communal ripples</div>
            <br><br>
            Real-time interactivity from the server
            <br><br>
            <span style="color:white;font-weight:900;font-size:20px;">
            <span id="active_count"></span></span> CONCURRENT USERS<br>
            <span id="visitor_count"></span> visits
            <br><br>
            A hypermedia project<br>
            by Lazarus Morrison<br>
            Powered by <a target="_blank" style="text-decoration: none; color:white;" href="https://data-star.dev">Datastar</a>
            <br><br>
            See the <a target="_blank" style="text-decoration: none; color:white;" href="https://youtube.com/@hypermedia-tv">full video</a>

        </div>


        <div id="transformer">
            <div id="clickable"
                 >
                @for ($y=0; $y<$rows; $y++)
                    @for ($x=0; $x<$cols; $x++)
                        <div class="cell" x="{{ $x }}" y="{{ $y }}"></div>
                    @endfor
                @endfor
            </div>
            <div id="html"></div>
        </div>

        <script>

            

            const GRID_X = {{ $cols }};
            const GRID_Y = {{ $rows }};

            console.log("X: "+GRID_X);
            console.log("Y: "+GRID_Y);

            const htmlEl = document.getElementById('html');

            const { width: charWidth, height: charHeight } = getCharSize(htmlEl);


            function ripple(x, y, z) {
                new Image().src = `/demos/live-datastar/ripple?x=${x}&y=${y}&z=${z}&id={{ substr(session()->getId(), 0, 6) }}`;
            }

            (function adjustCellSizeToChar() {
                const { width: charWidth, height: charHeight } = getCharSize(htmlEl);

                // Apply char dimensions to each .cell
                const cells = document.querySelectorAll('.cell');
                cells.forEach(cell => {
                    cell.style.width = `${charWidth}px`;
                    cell.style.height = `${charHeight}px`;
                });

                // Set #clickable container width to exactly fit the grid
                const clickable = document.getElementById('clickable');
                if (clickable) {
                    clickable.style.width = `${charWidth * GRID_X}px`;
                    clickable.style.height = `${charHeight * GRID_Y}px`; // optional: fits total grid height too
                }

                console.log(`Adjusted .cell to ${charWidth}x${charHeight}, grid area: ${charWidth * GRID_X} x ${charHeight * GRID_Y}`);
            })();




            function getCharSize(htmlEl) {
                const sample = document.createElement('span');
                sample.innerText = '█';
                sample.style.fontFamily = 'monospace';
                sample.style.visibility = 'hidden';
                sample.style.position = 'absolute';
                sample.style.letterSpacing = '8px'; // match your #html exactly
                htmlEl.appendChild(sample);
                const width = sample.offsetWidth;
                const height = sample.offsetHeight;
                htmlEl.removeChild(sample);
                return { width, height };
            }

            /* 

            TRY TO GET BROWSER FPS

            */
            (function () {
                let updateCount = 0;
                let lastUpdateTime = performance.now();

                const fpsBrowseEl = document.getElementById('fps_browse');
                const target = document.getElementById('html');

                if (!target) {
                    console.warn('fps_browse: Could not find #html for DOM update tracking.');
                    return;
                }

                const observer = new MutationObserver(() => {
                    updateCount++;
                    const now = performance.now();

                    if (now - lastUpdateTime >= 1000) {
                        fpsBrowseEl.textContent = updateCount.toString();
                        updateCount = 0;
                        lastUpdateTime = now;
                    }
                });

                observer.observe(target, { childList: true, characterData: true, subtree: true });
            })();
        </script>

            

    </body>
</html>

