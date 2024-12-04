<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>hype cp | Hypermedia Copy & Paste</title>

    <meta http-equiv="refresh" content="5">

    <script src="https://unpkg.com/htmx.org@2.0.3"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
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

</body>
</html>