<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/png" href="/images/zdate-icon.png">
	<link rel="stylesheet" type="text/css" href="/css/output.css">

	<script src="//unpkg.com/alpinejs" defer></script>

	<script type="module" src="https://cdn.jsdelivr.net/gh/starfederation/datastar@main/bundles/datastar.js"></script>
	

	<title></title>
</head>
<body class="bg-slate-50">
	

	<div class="max-w-lg mx-auto">

		<div class="flex items-end text-xs text-blue-400">
			<div class="w-3/10 px-4 py-1 text-gray-700">
				<b>With Datastar</b>
			</div>
			<img class="w-4/10" src="/images/zdate-logo.png" />
			<div class="w-3/10 text-right px-4 py-1">
				<a href="/demos/html-validation">Pure html</a> |
				<a href="/demos/htmx-validation">With htmx</a>
			</div>
		</div>

		@include('demos.datastar-validation.form')

		<div class="text-center text-sm">
			View the
			<a class="text-blue-500 underline" href="https://www.youtube.com/watch?v=pdbaGOibJkc">
				full video
			</a>
		</div>

	</div>

</body>
</html>