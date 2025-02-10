<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Wave Checklist</title>

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
				'What was Google Wave?',
				'Chat Demo',
				'Routes & Database Schema',
				'Views and Datastar Setup',
				'Creating Rooms and Members',
				'Post Comment with Datastar',
				'Background Updating While(true)',
				'Execute Javascript using Datastar',
				'Recap'
			];

			$count = 0;

			if (request('count')) {
				$count = request('count');
			}
		@endphp


		<div id="main" class="w-full h-screen bg-gradient-to-r to-sky-800 from-slate-800 text-4xl font-bold text-gray-200 p-16 pt-24">
			<div class="text-center text-5xl">
				<!-- <span class="text-4xl pb-2">hypecp.com</span><br> -->
				Real-time Chat<br>
				<div class="text-gray-400 text-4xl pt-2">Datastar Demo 2025</div>
			</div>
			<div class="mt-16 mx-auto max-w-2xl">
				@foreach ($items as $item)

					<div id="item_{{ $loop->iteration }}" class="m-8 smooth
								@if ($loop->iteration == $count)
									text-white
								@elseif ($loop->iteration < $count)
									text-gray-400
								@else
									text-gray-900
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
					
				</div>

			<div hx-get=""
				 hx-trigger="keyup[key=='d'] from:body"
				 hx-target="#main"
				 hx-swap="outerHTML"
				 hx-select="#main"
				 hx-vals='{"count":"{{ $count+1 }}"}'
				 >

			</div>

			<div hx-get=""
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