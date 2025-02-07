@extends('wave.app')

@section('main')


<div class="flex bg-gray-100 min-h-screen flex-col justify-center py-12 sm:px-6 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-md">
    <img class="mx-auto h-10 w-auto" src="https://data-star.dev/static/images/rocket-304e710dde0b42b15673e10937623789adf72cae569c0e0defe7ec21c0bdf293.webp" alt="Datastar">
    <h2 class="mt-6 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Create a new datastar chat</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
    <div class="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12">
      <form action="/wave/rooms" method="POST" class="space-y-6">

        @csrf
        <div>
          <label for="room_name" class="block text-sm/6 font-medium text-gray-900">Room Name</label>
          <div class="mt-2">
            <input type="text" name="room_name" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-sky-600 sm:text-sm/6">
          </div>
        </div>


        <div>
          <button type="submit" class="cursor-pointer flex w-full justify-center rounded-md bg-sky-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600">Create & Join a Room</button>
        </div>
      </form>

      <div class="relative mt-10">
          <div class="absolute inset-0 flex items-center" aria-hidden="true">
            <div class="w-full border-t border-gray-200"></div>
          </div>
          <div class="relative flex justify-center text-sm/6 font-medium">
            <span class="bg-white px-6 text-gray-900">See the video and code at:</span>
          </div>
        </div>

        <div class="mt-6 grid grid-cols-2 gap-4">
          <a href="#" class="flex w-full items-center justify-center gap-3 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:ring-transparent">
            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" viewBox="0 0 461.001 461.001" xml:space="preserve">
            <g>
                <path style="fill:#F61C0D;" d="M365.257,67.393H95.744C42.866,67.393,0,110.259,0,163.137v134.728   c0,52.878,42.866,95.744,95.744,95.744h269.513c52.878,0,95.744-42.866,95.744-95.744V163.137   C461.001,110.259,418.135,67.393,365.257,67.393z M300.506,237.056l-126.06,60.123c-3.359,1.602-7.239-0.847-7.239-4.568V168.607   c0-3.774,3.982-6.22,7.348-4.514l126.06,63.881C304.363,229.873,304.298,235.248,300.506,237.056z"/>
            </g>
            </svg>
            <span class="text-sm/6 font-semibold">Youtube</span>
          </a>

          <a href="https://github.com/tonsoflaz2/hypecp/commit/e80e3eb0e0b102c7a8541fdd7233224ed59048f8" class="flex w-full items-center justify-center gap-3 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:ring-transparent">
            <svg class="size-5 fill-[#24292F]" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
              <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-sm/6 font-semibold">GitHub</span>
          </a>
        </div>

    </div>

    <p class="mt-10 text-center text-sm/6 text-gray-500">
      Powered by
      <a href="https://data-star.dev" class="font-semibold text-sky-600 hover:text-sky-500">Datastar</a><br>
      Presented by
      <a href="https://hypecp.com" class="font-semibold text-sky-600 hover:text-sky-500">hypecp.com</a>
    </p>

  </div>
</div>


@endsection