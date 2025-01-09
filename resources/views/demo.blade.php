<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta http-equiv="refresh" content="5">

	<script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">

	<title></title>
</head>
<body class="bg-gray-200">
	<h1>Hypermedia hot reload</h1>

	How can we tell if its refreshing?

	@for ($i=0; $i<200; $i++)
		<div class="bg-white rounded-lg m-8 p-8">
			{{ $i }}
			<pre>
				<code class="hljs language-html">
&lt;tag&gt;
	Showing a code sample here
	Notice how it moves a little bit
	That's the jank!!!
	(Jank is bad)
	It is moving on the refresh
	But its not even consistent.... 
&lt;/tag&gt;
				</code>
			</pre>
		</div>
	@endfor

	<script>hljs.highlightAll();</script>
</body>
</html>

