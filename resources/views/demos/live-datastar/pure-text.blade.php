
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
            .grid {
                letter-spacing: 8px;
                white-space: nowrap;
                    transform: rotateX(53deg) 
                               rotateZ(45deg) 
                               scale(2.4) 
                               translateX(250px) 
                               translateY(150px);
                    transform-style: preserve-3d;
            }
            .grid > span {
                  
            }
         
        </style>
    </head>

    <body data-signals="{_contents: 'random text goes here'}"
          data-on-load="@get('/demos/pure-text/stream')">

        <!-- <div class="grid">
            <pre data-text="$_contents"></pre>
        </div> -->

        <div style="background: black; margin: 5px; padding: 5px; z-index: 2; position: fixed;">
            FPS Server: <span id="fps_server"></span><br>
            FPS Stream: <span id="fps_stream"></span><br>
            FPS Browse: <span id="fps_browse"></span>
        </div>

        <div class="grid">
            <div id="html"></div>
        </div>

        <script>
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

