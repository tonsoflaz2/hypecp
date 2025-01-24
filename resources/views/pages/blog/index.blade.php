@extends('shell')

@section('title')
	HypeCP Blog
@endsection

@section('sidebar')
	<div style="margin: 15px; height: 320px; width: 320px;" class="flex border shadow bg-white rounded-lg items-center text-center" src="/images/logo.png">
		
		<div class="mx-auto transform -rotate-12 text-blue-400 font-black text-8xl">
			hype<br>
			<span class="text-gray-900">cp</span>
		</div>
	</div>
@endsection


@section('main')

<div class="p-8 text-gray-600">
    <h2 class="text-2xl font-bold text-blue-600">
    	<a href="/blog/2024-the-year-of-htmx">
    		# 2024 in review: The Year of Htmx
    	</a>
    </h2>
    <p class="py-3 px-5">
        Client work contracted, personal projects expanded, but one thing was clear: nothing was safe from htmx in 2024. I explore the year of content creation and hypermedia, and look to the future.
    </p>
</div>

@endsection