<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>hype cp | Hypermedia Copy & Paste</title>

    <!-- <meta http-equiv="refresh" content="5"> -->

    <script src="https://unpkg.com/htmx.org@2.0.3"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>

    <style>
        .copy-button {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #ddd;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="flex w-full min-h-screen bg-white">
        <div style="width: 350px;" 
             class="bg-gray-200 h-screen overflow-scroll">
            <div>
                @include('htmx.sidebar')
            </div>
        </div>
        <div class="flex-1 min-h-screen">
            <div class="w-full">
                @include('htmx.navigation')
            </div>
            <div class="">
                @include('htmx.main')
            </div>
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
            initCopyCodeBlocks();
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