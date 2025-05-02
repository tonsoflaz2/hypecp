@extends('demos.infinite-scroll.main')

@section('scrollers')

	<div class="mx-auto max-w-7xl">

<nav class="bg-gray-800 rounded-2xl text-2xl">
  <div class="mx-auto max-w-7xl px-4">
    <div class="relative flex h-24 items-center justify-between">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <!-- mobile toggle if needed -->
      </div>

      <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
        <div class="flex shrink-0 items-center">
          <!-- logo or icon -->
        </div>

        <div class="flex flex-1 space-x-4">
          <a hx-boost="true" href="/demos/infinite-scroll#scroller" class="flex-1 text-center rounded-xl px-3 py-4 text-white hover:bg-gray-700 hover:text-white">Easiest</a>
          <a hx-boost="true" href="/demos/infinite-scroll/smoother#scroller" class="flex-1 text-center rounded-xl px-3 py-4 text-gray-300 bg-gray-900" aria-current="page">Smoother</a>
          <a hx-boost="true" href="/demos/infinite-scroll/insane#scroller" class="flex-1 text-center rounded-xl px-3 py-4 text-gray-300 hover:bg-gray-700 hover:text-white">Insane</a>
        </div>
      </div>
    </div>
  </div>
</nav>

  <div class="bg-gray-900 py-10">

    <h2 class="px-4 sm:px-6 lg:px-8 text-base text-gray-400">
      <span class="font-semibold text-lg text-white">Restaurant health inspections</span><br>
    performed in <span class="text-white">Anchorage, Alaska</span> <br>
  since the year <span class="text-white">2000</span><br>
    <a target="_blank" class="text-sm text-gray-500" href="https://vincentarelbundock.github.io/Rdatasets/datasets.html">View source</a></h2>
  
  <table class="mt-6 w-full whitespace-nowrap text-left">
    <colgroup>
      <col class="w-full sm:w-4/12">
      <col class="lg:w-4/12">
      <col class="lg:w-2/12">
      <col class="lg:w-1/12">
      <col class="lg:w-1/12">
    </colgroup>
    <thead class="border-b border-white/10 text-sm/6 text-white">
      <tr>
        <th scope="col" class="py-2 pl-4 pr-8 font-semibold sm:pl-6 lg:pl-8">Business</th>
        <th scope="col" class="hidden py-2 pl-0 pr-8 font-semibold sm:table-cell">Weekend?</th>
        <th scope="col" class="py-2 pl-0 pr-4 text-right font-semibold sm:pr-8 sm:text-left lg:pr-20">Score</th>
        <th scope="col" class="hidden py-2 pl-0 pr-8 font-semibold md:table-cell lg:pr-20"># Locations</th>
        <th scope="col" class="hidden py-2 pl-0 pr-4 text-right font-semibold sm:table-cell sm:pr-6 lg:pr-8">Inspection Year</th>
      </tr>
    </thead>

      @include('demos.infinite-scroll.better-rows')

  </table>
</div>
</div>

@endsection