<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title hx-head="re-eval">hype cp | Hypermedia Copy & Paste</title>

    <link rel="shortcut icon" type="image/png" href="/favicon.png">

    <!-- <meta http-equiv="refresh" content="5"> -->

    <script src="https://unpkg.com/htmx.org@2.0.3"></script>
    <script src="https://cdn.jsdelivr.net/npm/htmx-ext-head-support@2.0.2"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>

    @yield('styles')

    <style>
        .copy-button {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #ddd;
            cursor: pointer;
        }
        .example i {
            background: #eee;
            padding: 5px;
            border-radius: 5px;
            font-size: .9em;
            color:#333;
        }
        .example p b {
            color:black;
            font-weight: bold;
        }
        .example p {
            padding: 15px 15px 0px 15px;
        }
        .example button {

          align-items: center;
          appearance: none;
          background-color: #3EB2FD;
          background-image: linear-gradient(1deg, #4F58FD, #149BF3 99%);
          background-size: calc(100% + 20px) calc(100% + 20px);
          border-radius: 100px;
          border-width: 0;
          box-shadow: none;
          box-sizing: border-box;
          color: #FFFFFF;
          cursor: pointer;
          display: inline-flex;
          font-family: CircularStd,sans-serif;
          font-size: 1rem;
          height: auto;
          justify-content: center;
          line-height: 1.5;
          padding: 6px 20px;
          position: relative;
          text-align: center;
          text-decoration: none;
          transition: background-color .2s,background-position .2s;
          user-select: none;
          -webkit-user-select: none;
          touch-action: manipulation;
          vertical-align: top;
          white-space: nowrap;
          margin: 5px 0px;
        }

        .example button:active,
        .example button:focus {
          outline: none;
        }

        .example button:hover {
          background-position: -20px -20px;
        }

        .example button:focus:not(:active) {
          box-shadow: rgba(40, 170, 255, 0.25) 0 0 0 .125em;
        }

        .example input {
            border-radius: 5px;
            border: 1px solid lightgray;
            padding: 6px 10px;
            min-width: 200px;
            margin: 5px 0px;
        }
        .example select {
            border-radius: 5px;
            border: 1px solid lightgray;
            padding: 6px 10px;
            min-width: 200px;
            margin: 5px 0px;
        }
        #some-notification-target > div {
            padding: 15px;
            background: green;
            color:white;
        }
    </style>


    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css"> -->
    <style>
        pre code.hljs{display:block;overflow-x:auto;padding:1em}code.hljs{padding:3px 5px}.hljs{color:#abb2bf;background:#282c34}.hljs-comment,.hljs-quote{color:#5c6370;font-style:italic}.hljs-doctag,.hljs-formula,.hljs-keyword{color:#c678dd}.hljs-deletion,.hljs-name,.hljs-section,.hljs-selector-tag,.hljs-subst{color:#e06c75}.hljs-literal{color:#56b6c2}.hljs-addition,.hljs-attribute,.hljs-meta .hljs-string,.hljs-regexp,.hljs-string{color:#98c379}.hljs-attr,.hljs-number,.hljs-selector-attr,.hljs-selector-class,.hljs-selector-pseudo,.hljs-template-variable,.hljs-type,.hljs-variable{color:#d19a66}.hljs-bullet,.hljs-link,.hljs-meta,.hljs-selector-id,.hljs-symbol,.hljs-title{color:#61aeee}.hljs-built_in,.hljs-class .hljs-title,.hljs-title.class_{color:#e6c07b}.hljs-emphasis{font-style:italic}.hljs-strong{font-weight:700}.hljs-link{text-decoration:underline}
    </style>
</head>
<body hx-ext="head-support">

    <div class="flex w-full min-h-screen bg-white">
        <div style="width: 350px;" 
             class="hidden md:block h-screen overflow-scroll flex-shrink-0">
            <div>
                @include('htmx.sidebar')
            </div>
        </div>
        <div class="flex-1 min-h-screen overflow-hidden">
            <div class="w-full">
                @include('navigation')
            </div>
            <div class="overflow-x-auto">
                @include('htmx.main')
            </div>
        </div>
        <div id="some-notification-target"
             class="fixed top-0 right-0 m-8 bg-white z-10">
            
        </div>
    </div>

    <script>hljs.highlightAll();</script>

    <script type="text/javascript">
        
        document.addEventListener('DOMContentLoaded', function() {
            var codeBlocks = document.querySelectorAll('pre > code');
            codeBlocks.forEach(function (code) {
                var button = document.createElement('div');
                button.className = 'copy-button';
                button.textContent = 'Copy';
                var codeWrapper = code.closest('.code-block');
                codeWrapper.appendChild(button);

            })
            initCopyCodeBlocks();
        });


        function initCopyCodeBlocks() {
            document.removeEventListener('click', copyClickHandler);
            document.addEventListener('click', copyClickHandler);
        }

        function copyClickHandler(event) {
            if (event.target && event.target.classList.contains('copy-button')) {
                var code = event.target.closest('.code-block').querySelector('code');
                var text = code.innerText;
                if (navigator.clipboard) {
                  navigator.clipboard.writeText(text);
                } else {
                  unsecuredCopyToClipboard(text);
                }
                event.target.innerText = 'Copied!';
                setTimeout(function() {
                    event.target.innerText = 'Copy';
                }, 2000);
            }
        }

        // https://stackoverflow.com/questions/72237719/not-being-able-to-copy-url-to-clipboard-without-adding-the-protocol-https

        function unsecuredCopyToClipboard(text) {
          const textArea = document.createElement("textarea");
          textArea.value = text;
          document.body.appendChild(textArea);
          textArea.focus();
          textArea.select();
          try {
            document.execCommand('copy');
          } catch (err) {
            console.error('Unable to copy to clipboard', err);
          }
          document.body.removeChild(textArea);
        }

    </script>

</body>
</html>