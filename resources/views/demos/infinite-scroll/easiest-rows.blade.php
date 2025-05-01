@php
  $page = request('page');
  if (!$page) {
    $page = 1;
  }
  $perpage = 20;
  $inspections = \App\Models\Infinite\Inspection::simplePaginate($perpage);
@endphp


@foreach ($inspections as $inspection)

  @php
    $tilesize = 40;
    $x = rand(0, 5) * $tilesize;
    $y = rand(0, 3) * $tilesize;
  @endphp


  <tr>
    <td class="py-4 pl-4 pr-8 sm:pl-6 lg:pl-8">
      <div class="flex items-center gap-x-4">
        <div class="rounded-lg bg-gray-800 shrink-0" style="
          width:{{ $tilesize }}px; 
          height: {{ $tilesize }}px;
          background-image: url('/images/logo_sprite.jpg');
          background-size: {{ $tilesize * 4 }}px {{ $tilesize * 6 }}px;
          background-position: -{{ $x }}px -{{ $y }}px;
          
        "></div>

        <div class="truncate text-sm/6 font-medium text-white">
          <span class="text-gray-400">{{ $inspection->rownames }}.</span> {{ $inspection->business_name }}</div>
      </div>
    </td>
    <td class="hidden py-4 pl-0 pr-4 sm:table-cell sm:pr-8">
      <div class="flex gap-x-3">
        <div class="font-mono text-sm/6 text-gray-400">Weekend</div>
        <div class="rounded-md bg-gray-700/40 px-2 py-1 text-xs font-medium text-gray-400 ring-1 ring-inset ring-white/10">{{ $inspection->Weekend }}</div>
      </div>
    </td>
    <td class="py-4 pl-0 pr-4 text-sm/6 sm:pr-8 lg:pr-20">
      <div class="flex items-center justify-end gap-x-2 sm:justify-start">
        <time class="text-gray-400 sm:hidden" datetime="2023-01-23T11:00">45 minutes ago</time>

        @if ($inspection->inspection_score > 90)
          <div class="flex-none rounded-full bg-green-400/10 p-1 text-green-400">
          <div class="size-4 rounded-full bg-current"></div>
        </div>
        @elseif ($inspection->inspection_score > 80)
          <div class="flex-none rounded-full bg-yellow-400/10 p-1 text-yellow-400">
          <div class="size-4 rounded-full bg-current"></div>
        </div>
        @else
          <div class="flex-none rounded-full bg-red-400/10 p-1 text-red-400">
          <div class="size-4 rounded-full bg-current"></div>
        </div>
        @endif

        <div class="hidden text-white sm:block">{{ $inspection->inspection_score }}</div>
      </div>
    </td>
    <td class="hidden py-4 pl-0 pr-8 text-sm/6 text-gray-400 md:table-cell lg:pr-20"><span class="text-white font-bold">{{ $inspection->NumberofLocations }}</span> locations</td>
    <td class="hidden py-4 pl-0 pr-4 text-right text-sm/6 text-gray-400 sm:table-cell sm:pr-6 lg:pr-8">
      <time datetime="2023-01-23T11:00">{{ $inspection->Year }}</time>
    </td>
  </tr>
@endforeach
<tr hx-get="/demos/infinite-scroll/rows?page={{ $page + 1 }}"
    hx-trigger="revealed"
    hx-swap="outerHTML">
  <td colspan="100" class="text-white text-center">
    <img src="/images/spinner.png" class="spinner block mx-auto" />
  </td>
</tr>