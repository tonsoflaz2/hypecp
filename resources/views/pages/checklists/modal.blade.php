<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Modal Checklist</title>

		<script src="https://cdn.tailwindcss.com"></script>
		<script src="https://unpkg.com/htmx.org@2.0.0" defer></script>
		<!-- <meta http-equiv="refresh" content="5" /> -->
		<style>
			.smooth {
			  transition: all .3s ease-in;
			}
		</style>
	</head>
	<body>

		@php
			$items = [
				'Setup',
				'Button',
				'Open and Close Dialog',
				'Vanilla CSS Styling',
				'Tailwind Styling',
				'Loading Content with Htmx',
				'Next time: Updating Data, Reusing your modal!',
			];

			$count = 0;

			if (request('count')) {
				$count = request('count');
			}
		@endphp


		<div id="main" class="w-full h-screen bg-gray-800 text-4xl font-bold text-gray-200 p-16 pt-32">
			<div class="text-center text-5xl">
				<!-- <span class="text-4xl pb-2">hypecp.com</span><br> -->
				Htmx Dynamic Modal<br>
				<!-- <div class="text-gray-400 text-2xl pt-2">August 26th, 2024</div> -->
			</div>
			<div class="mt-16">
				@foreach ($items as $item)

					<div id="item_{{ $loop->iteration }}" class="m-8 smooth
								@if ($loop->iteration == $count)
									text-white
								@elseif ($loop->iteration < $count)
									text-gray-400
								@else
									text-gray-600
								@endif
								">
						{{ $loop->iteration }}. {{ $item }}
					</div>

				@endforeach
			</div>

			<div id="thank_you" class="m-12 text-center smooth
							@if ($count == count($items) + 1)
								text-white
							@else
								text-gray-800
							@endif
							">
					That's all, thank you!
				</div>

			<div hx-get="/checklists/modal"
				 hx-trigger="keyup[key=='d'] from:body"
				 hx-target="#main"
				 hx-swap="outerHTML"
				 hx-select="#main"
				 hx-vals='{"count":"{{ $count+1 }}"}'
				 >

			</div>

			<div hx-get="/checklists/modal"
				 hx-trigger="keyup[key=='e'] from:body"
				 hx-target="#main"
				 hx-swap="outerHTML"
				 hx-select="#main"
				 hx-vals='{"count":"{{ $count-1 }}"}'
				 >

			</div>

		</div>


	</body>
</html>