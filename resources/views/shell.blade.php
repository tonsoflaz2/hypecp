<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title')</title>

	<script src="https://unpkg.com/htmx.org@2.0.3"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    @yield('styles')

    <!-- <meta http-equiv="refresh" content="5"> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
</head>
<body>
	<div class="flex w-full min-h-screen bg-white">
        <div style="width: 350px;" 
             class="hidden md:block bg-gray-200 h-screen overflow-scroll flex-shrink-0">
            <div>
                @yield('sidebar')
            </div>
        </div>
        <div class="flex-1 min-h-screen overflow-hidden">
            <div class="w-full">
                @include('navigation')
            </div>
            <div class="overflow-x-auto">
                @yield('main')
            </div>
        </div>
        <div id="some-notification-target"
             class="fixed top-0 right-0 m-8 bg-white z-10">
            
        </div>
    </div>
</body>
</html>