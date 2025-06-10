<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/png" href="/images/zdate-icon.png">
	<link rel="stylesheet" type="text/css" href="/css/output.css">

	<script src="https://unpkg.com/htmx.org@2.0.4"></script>
	<script src="//unpkg.com/alpinejs" defer></script>

	<title></title>
</head>
<body class="bg-slate-50">
	

	<div class="max-w-lg mx-auto">

		<div class="flex items-end text-xs text-blue-400">
			<div class="w-3/10 px-4 py-1 text-gray-700">
				<b>With htmx</b>
			</div>
			<img class="w-4/10" src="/images/zdate-logo.png" />
			<div class="w-3/10 text-right px-4 py-1">
				<a href="/demos/html-validation">Pure html</a>
			</div>
		</div>


		@include('demos.htmx-validation.form')

	</div>

</body>
</html>