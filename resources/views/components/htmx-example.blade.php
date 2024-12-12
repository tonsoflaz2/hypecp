<hr class="my-8">

<div class="font-bold my-2 text-black">
	# &nbsp;{{ $title }}
</div>

<div class="example ml-3">
	<div class="lg:flex w-full">
		<div class="w-full lg:w-3/5 code-block relative">
		<pre><code class="hljs language-html rounded-t-xl lg:rounded-tr-none lg:rounded-l-xl">{!! htmlentities($code) !!}</code></pre>
		</div>

		<div class="w-full border working-example lg:w-2/5 p-4 rounded-b-xl lg:rounded-bl-none lg:rounded-r-xl text-blue-500 shadow">
			{{ $code }}
		</div>
	</div>

	<div class="flex">
		
		<div class="w-2/3 lg:w-3/5">
			{{ $description }}
			
		</div>
		<div class="w-1/3 lg:w-2/5 p-4 text-sm">
			<b class="block text-gray-400 uppercase text-xs border-b w-full pb-2 mb-2">Attributes</b>
			{{ $attributes }}
		</div>
	</div>
</div>