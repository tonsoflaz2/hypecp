<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Datastar Signals</title>

	<script src="https://cdn.tailwindcss.com"></script>

	<script type="module" src="https://cdn.jsdelivr.net/gh/starfederation/datastar@1.0.0-beta.11/bundles/datastar.js"></script>

</head>
<body data-signals="{'toggle-enabled':false}">

	<div class="bg-gray-50 py-6">
  <div class="mx-auto max-w-2xl px-6 lg:max-w-7xl lg:px-8">
    <h2 class="text-center text-base/7 font-semibold text-indigo-600">
    	Hypermedia tv presents

    	<button data-on-click="$toggle-enabled = !$toggle-enabled" data-class="{'bg-indigo-600': $toggle-enabled}" type="button" class="float-right mt-1 relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent bg-gray-200 transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 bg-gray-200" role="switch" aria-checked="false">
		  <span class="sr-only">Use setting</span>
		  <!-- Enabled: "translate-x-5", Not Enabled: "translate-x-0" -->
		  <span data-class="{'translate-x-5': $toggle-enabled}" aria-hidden="true" class="pointer-events-none inline-block size-5 translate-x-0 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out translate-x-0"></span>
		</button>

    </h2>
    <p class="mx-auto mt-2 max-w-lg text-balance text-center text-4xl font-semibold tracking-tight text-gray-950 sm:text-5xl">Using Datastar <span class="text-indigo-600">Signals</span> for front-end reactivity</p>
    <div class="mt-4 grid gap-4 sm:mt-8 lg:grid-cols-3 lg:grid-rows-2">
      <div class="relative lg:row-span-2">
        <div class="absolute inset-px rounded-lg bg-white lg:rounded-l-[2rem]"></div>

        <!-- ======================> TABS <===================== -->

        <div data-signals-tab="'phone'" class="relative flex h-full flex-col overflow-hidden rounded-[calc(theme(borderRadius.lg)+1px)] lg:rounded-l-[calc(2rem+1px)]">
          <div class="px-8 pb-3 pt-8 sm:px-10 sm:pb-0 sm:pt-10">
            <p class="mt-2 text-lg font-medium tracking-tight text-gray-950 max-lg:text-center">Active Tabs</p>
            <p class="mt-2 max-w-lg text-sm/6 text-gray-600 max-lg:text-center">Set a signal for the active tab name. Then, each tab sets the name that is clicked. The contents show/hide based on the name.</p>
          </div>

          <div>
			  <div class="grid grid-cols-1 ">
		
			  </div>
			  <div class="">
			    <div class="border-b border-gray-200 pl-12">
			      <nav class="-mb-px flex space-x-8" aria-label="Tabs">
			        <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700" -->
			        <a data-on-click="$tab = 'phone'"
			           data-class="{'border-indigo-500 text-indigo-600': $tab == 'phone'}" 
			           class="whitespace-nowrap border-b-2 px-1 py-4 text-sm font-medium text-gray-500 hover:text-gray-700">Some App</a>
			        <a data-on-click="$tab = 'cat'" 
			           data-class="{'border-indigo-500 text-indigo-600': $tab == 'cat'}" 
			           class="whitespace-nowrap border-b-2 px-1 py-4 text-sm font-medium text-gray-500 hover:text-gray-700">Cat</a>
			        <a data-on-click="$tab = 'logo'" 
			           data-class="{'border-indigo-500 text-indigo-600': $tab == 'logo'}" 
			           class="whitespace-nowrap border-b-2 px-1 py-4 text-sm font-medium text-gray-500">Logo</a>
			      </nav>
			    </div>
			  </div>
			</div>
          <div class="relative min-h-[24rem] w-full grow [container-type:inline-size] max-lg:mx-auto max-lg:max-w-sm">

            <div data-show="$tab == 'phone'" class="absolute inset-x-10 bottom-0 top-10 overflow-hidden rounded-t-[12cqw] border-x-[3cqw] border-t-[3cqw] border-gray-700 bg-gray-900 shadow-2xl">
              <img class="size-full object-cover object-top" src="https://tailwindcss.com/plus-assets/img/component-images/bento-03-mobile-friendly.png" alt="">
            </div>

            <div data-show="$tab == 'cat'" class="absolute inset-x-10 bottom-0 top-10 overflow-hidden rounded-t-[12cqw] border-x-[3cqw] border-t-[3cqw] border-gray-700 bg-gray-900 shadow-2xl">
              <img class="size-full object-cover object-top" src="https://placecats.com/400/600" alt="">
            </div>

            <div data-show="$tab == 'logo'" class="absolute inset-x-10 bottom-0 top-10 overflow-hidden rounded-t-[12cqw] border-x-[3cqw] border-t-[3cqw] border-gray-700 bg-gray-900 shadow-2xl">
              <img class="size-full object-cover object-top" src="https://data-star.dev/static/images/rocket-304e710dde0b42b15673e10937623789adf72cae569c0e0defe7ec21c0bdf293.webp" alt="">
            </div>

          </div>
        </div>
        <div class="pointer-events-none absolute inset-px rounded-lg shadow ring-1 ring-black/5 lg:rounded-l-[2rem]"></div>
      </div>

      <!-- ======================> COUNTER <===================== -->


      <div class="relative max-lg:row-start-1">
        <div class="absolute inset-px rounded-lg bg-white max-lg:rounded-t-[2rem]"></div>
        <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(theme(borderRadius.lg)+1px)] max-lg:rounded-t-[calc(2rem+1px)]">
          <div class="px-8 pt-8 sm:px-10 sm:pt-10">
            <p class="mt-2 text-lg font-medium tracking-tight text-gray-950 max-lg:text-center">Local counter</p>
            <p class="mt-2 max-w-lg text-sm/6 text-gray-600 max-lg:text-center">Set a signal for the counter, then show it and add one button to decrease and one button to increase.</p>
          </div>
          <div data-signals-counter="100"
          		class="flex py-1 px-8">
          	<div class="text-indigo-600 text-3xl" data-text="$counter"></div>
          	<div class="ml-auto">
          	<span class="isolate inline-flex rounded-md shadow-sm">
			  <button data-on-click="$counter--" type="button" class="relative inline-flex items-center rounded-l-md bg-white px-2 py-1 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">
			    -
			  </button>
			  <button data-on-click="$counter++" type="button" class="relative -ml-px inline-flex items-center rounded-r-md bg-white px-2 py-1 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">
			    +
			  </button>
			</span>
		</div>

          </div>
          <div class="relative flex flex-1 items-center justify-center px-8 max-lg:pb-4 max-lg:pt-10 sm:px-10 lg:pb-2 max-h-24 overflow-hidden">
            <img class="w-full max-lg:max-w-xs absolute bottom-0 p-8" src="https://tailwindcss.com/plus-assets/img/component-images/bento-03-performance.png" alt="">
          </div>
        </div>
        <div class="pointer-events-none absolute inset-px rounded-lg shadow ring-1 ring-black/5 max-lg:rounded-t-[2rem]"></div>
      </div>

      <!-- ======================> DROP-DOWN <===================== -->


      <div class="relative max-lg:row-start-3 lg:col-start-2 lg:row-start-2">
        <div class="absolute inset-px rounded-lg bg-white"></div>
        <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(theme(borderRadius.lg)+1px)]">

        	<div data-signals-hoverbutton="false" 
        		 data-signals-hovermenu="false" 
        		 class="ml-auto w-100 m-8">
	          	<div class="relative inline-block text-left">
				  <div>
				    <button data-on-mouseover="$hoverbutton = true;" 
				    		data-on-mouseleave="$hoverbutton = false"
				    		type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
				      Options
				      <svg class="-mr-1 size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
				        <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
				      </svg>
				    </button>
				  </div>

				  <!--
				    Dropdown menu, show/hide based on menu state.

				    Entering: "transition ease-out duration-100"
				      From: "transform opacity-0 scale-95"
				      To: "transform opacity-100 scale-100"
				    Leaving: "transition ease-in duration-75"
				      From: "transform opacity-100 scale-100"
				      To: "transform opacity-0 scale-95"
				  -->
				  <div data-show="$hoverbutton || $hovermenu" 
				  	   data-on-mouseover="$hovermenu = true"
				  	   data-on-mouseleave="$hovermenu = false"
				  	   class="absolute right-0 z-10 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
				    <div class="py-1" role="none">
				      <!-- Active: "bg-gray-100 text-gray-900 outline-none", Not Active: "text-gray-700" -->
				      <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-0">Account settings</a>
				      <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-1">Support</a>
				      <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-2">License</a>
				      <form method="POST" action="#" role="none">
				        <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-3">Sign out</button>
				      </form>
				    </div>
				  </div>
				</div>
			</div>

          <div class="px-8 pt-8 sm:px-10 sm:pt-10">
            <p class="mt-2 text-lg font-medium tracking-tight text-gray-950 max-lg:text-center">Drop-down on hover</p>
            <p class="mt-2 max-w-lg text-sm/6 text-gray-600 max-lg:text-center">This uses two signals: <b>hoverbutton</b> and <b>hovermenu</b>. We set them with data-on-mouseover and data-on-mouseleave. If you are hovering over either, show the menu.</p>
          </div>
          <div class="flex flex-1 items-center [container-type:inline-size] max-lg:py-6 lg:pb-2">
          	

          </div>
        </div>
        <div class="pointer-events-none absolute inset-px rounded-lg shadow ring-1 ring-black/5"></div>
      </div>

      <!-- ======================> GLOBAL TOGGLE <===================== -->

      <div class="relative lg:row-span-2">
        <div class="absolute inset-px rounded-lg bg-white max-lg:rounded-b-[2rem] lg:rounded-r-[2rem]"></div>
        <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(theme(borderRadius.lg)+1px)] max-lg:rounded-b-[calc(2rem+1px)] lg:rounded-r-[calc(2rem+1px)]">
          <div class="px-8 pb-3 pt-8 sm:px-10 sm:pb-0 sm:pt-10">


            <p class="mt-2 text-lg font-medium tracking-tight text-gray-950 max-lg:text-center">
            	<!-- Enabled: "bg-indigo-600", Not Enabled: "bg-gray-200" -->
				<button data-on-click="$toggle-enabled = !$toggle-enabled" data-class="{'bg-indigo-600': $toggle-enabled}" type="button" class="float-right mt-1 relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent bg-gray-200 transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 bg-gray-200" role="switch" aria-checked="false">
				  <span class="sr-only">Use setting</span>
				  <!-- Enabled: "translate-x-5", Not Enabled: "translate-x-0" -->
				  <span data-class="{'translate-x-5': $toggle-enabled}" aria-hidden="true" class="pointer-events-none inline-block size-5 translate-x-0 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out translate-x-0"></span>
				</button>
            	Global toggle
            </p>
            <p class="mt-2 max-w-lg text-sm/6 text-gray-600 max-lg:text-center">Signals are global to the entire DOM, so you can control anywhere on the page. In this case two toggles are set to the same signal.</p>
          </div>
          <div class="relative min-h-[30rem] w-full grow">
            <div class="absolute bottom-0 left-10 right-0 top-10 overflow-hidden rounded-tl-xl bg-gray-900 shadow-2xl">
              <div class="flex bg-gray-800/40 ring-1 ring-white/5">
                <div class="-mb-px flex text-sm/6 font-medium text-gray-400">
                  <div class="border-b border-r border-b-white/20 border-r-white/10 bg-white/5 px-4 py-2 text-white">NotificationSetting.jsx</div>
                  <div class="border-r border-gray-600/10 px-4 py-2">App.jsx</div>
                </div>
              </div>
              <div class="px-6 pb-14 pt-6">

              </div>
            </div>
          </div>
        </div>
        <div class="pointer-events-none absolute inset-px rounded-lg shadow ring-1 ring-black/5 max-lg:rounded-b-[2rem] lg:rounded-r-[2rem]"></div>
      </div>
    </div>
  </div>
</div>


</body>
</html>