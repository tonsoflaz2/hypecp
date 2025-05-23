<!DOCTYPE html>
<html>
<head>

    <meta property="og:title" content="Infinite scrolling with htmx" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://hypecp.com/images/thumbnail.png" />
    <meta property="og:url" content="https://hypecp.com/demos/infinite-scroll" />
    <meta property="og:description" content="3 ways to implement infinite scrolling with htmx." />

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Infinite scroll with htmx</title>
  <link rel="shortcut icon" type="image/png" href="/favicon.png">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

  <script src='https://unpkg.com/htmx.org@2.0.4'></script>

  <style>
    .spinner {
      width: 30px;
      display: block;
      margin:auto;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }
  </style>

</head>
<body class="bg-gray-900">
  <div >
  <header class="absolute inset-x-0 top-0 z-50">
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
      <div class="flex lg:flex-1">
        <a href="/" class="-m-1.5 p-1.5">
          <span class="text-white font-black">hype cp</span>
        </a>
      </div>
      <div class="flex lg:hidden">
        <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-400">
          <span class="sr-only">Open main menu</span>
          <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
      </div>
      <div class="hidden lg:flex lg:gap-x-12">
        <a href="/demos/htmx-structure" class="text-sm/6 font-semibold text-white">Htmx Structure</a>
        <a href="/demos/live-widget" class="text-sm/6 font-semibold text-white">Htmx Dashboard</a>
        <a href="/demos/datastar-signals" class="text-sm/6 font-semibold text-white">Datastar Signals</a>
        <a href="/demos/live-dashboard" class="text-sm/6 font-semibold text-white">hx-swap-oob</a>
      </div>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <a href="https://youtube.com/@hypermedia-tv" class="text-sm/6 font-semibold text-white">YouTube <span aria-hidden="true">&rarr;</span></a>
      </div>
    </nav>
    <!-- Mobile menu, show/hide based on menu open state. -->
    <div class="lg:hidden" role="dialog" aria-modal="true">
      <!-- Background backdrop, show/hide based on slide-over state. -->
      <div class="fixed inset-0 z-50"></div>
      <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-gray-900 px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-white/10">
        <div class="flex items-center justify-between">
          <a href="#" class="-m-1.5 p-1.5">
            <span class="sr-only">Your Company</span>
            <img class="h-8 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="">
          </a>
          <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-400">
            <span class="sr-only">Close menu</span>
            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="mt-6 flow-root">
          <div class="-my-6 divide-y divide-gray-500/25">
            <div class="space-y-2 py-6">
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-gray-800">Product</a>
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-gray-800">Features</a>
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-gray-800">Marketplace</a>
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-gray-800">Company</a>
            </div>
            <div class="py-6">
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-white hover:bg-gray-800">Log in</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

    <div class="relative isolate pt-14">
      <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
        <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
      </div>
      <div hx-preserve class="py-8">
        <div class="mx-auto max-w-4xl px-6 lg:px-8">
          <div class="mx-auto max-w-2xl text-center">
            <h1 class="text-balance text-5xl font-semibold tracking-tight text-white sm:text-7xl">Scrolling to infinity with htmx</h1>
            <p class="mt-8 text-pretty text-lg font-medium text-gray-400 sm:text-xl/8">I don't know what you're scrolling to. I don't care. <br>But listen: neither do you. You just keep scrolling.</p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
              <a href="#scroller" class="rounded-md bg-indigo-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-400">Click or scroll down to get started</a>
              <a target="_blank" href="https://github.com/tonsoflaz2/hypecp/blob/main/resources/views/demos/infinite-scroll" class="text-sm/6 font-semibold text-white">See the code <span aria-hidden="true">→</span></a>
            </div>
          </div>
          <iframe class="mt-16 rounded-md bg-white/5 shadow-2xl ring-1 ring-white/10 sm:mt-24" width="100%" height="500" src="https://www.youtube.com/embed/lgbNlhYwdus?si=KaS_gbCwHwYJO-ez" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

          <!-- <img src="/images/infinite-scroll-thumb.jpg" alt="App screenshot" width="2432" height="1442" class="mt-16 rounded-md bg-white/5 shadow-2xl ring-1 ring-white/10 sm:mt-24"> -->
        </div>
      </div>
      <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
        <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
      </div>
    </div>

    <div class="h-8" id="scroller"></div>

    @yield('scrollers')
  
  </div>


</body>
</html>