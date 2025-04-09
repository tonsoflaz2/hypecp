
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
                letter-spacing: 8px;
            }
            .grid {
                white-space: nowrap;
                    /*transform: rotateX(53deg) 
                               rotateZ(45deg) 
                               scale(2.4) 
                               translateX(350px) 
                               translateY(150px);
                    transform-style: preserve-3d;*/
            }
            .grid > span {
                  
            }
         
        </style>
    </head>

    <body data-signals="{_contents: 'random text goes here'}"
          data-on-load="@get('/demos/pure-text/stream')">

        <div class="grid">
            <pre data-text="$_contents"></pre>
        </div>

        <div class="grid">
            <div id="html"></div>
        </div>
            

    </body>
</html>

