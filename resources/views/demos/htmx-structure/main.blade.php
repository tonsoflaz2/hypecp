<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HTMX Structure</title>

	<script src='https://unpkg.com/htmx.org@2.0.4'></script>
	<link rel="shortcut icon" type="image/png" href="/favicon.png">
	<link rel="stylesheet" href="/css/htmx-structure.css">

	<script>
		function setBodyClass(className) {
		    document.body.classList.remove('structure', 'standard');
		    document.body.classList.add(className);
		    localStorage.setItem('bodyClass', className);
		}
	</script>

</head>
<body class="standard">

	<div id="structure_toggle">
		<a href="?" onclick="setBodyClass('standard'); return false;">Standard</a> |
		<a href="?" onclick="setBodyClass('structure'); return false;">Structure</a>
	</div>

	<div class="mx-auto max-w-2xl px-6 lg:max-w-7xl lg:px-8 relative min-h-[24rem] w-full grow [container-type:inline-size] max-lg:mx-auto max-lg:max-w-sm rounded-xl overflow-hidden mt-12 inset-px">
  		
		  <iframe class="rounded-3xl" width="100%" height="600" src="https://www.youtube.com/embed/csPFLpm8OYI?si=d1Qdc8IqjStxnGwy" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

	</div>

	<div id="app" class="layout">
		<div class="layout">
			<span>SITE NAVIGATION</span>
			<ul id="navigation">
				<li>
					<img class="hide-structure" src="/images/portblaster-light.png"/>
				</li>
				<li class="active">Process Emails</li>
				<li>People</li>
				<li>Tags</li>
				<li>Campaigns</li>
			</ul>
		</div>

		<div id="content" class="layout">
			<span>PAGE CONTENT</span>
			<ul id="filters" class="layout">
				<span>FILTERS</span>
				<li><a href="?">All</a></li>
				<li><a href="?status=active">🔵 Active</a></li>
				<li><a href="?status=complete">✅ Completed</a></li>
				<li>
					<input type="text" name="query" placeholder="Search"
						   hx-get=""
						   hx-select="#emails"
						   hx-trigger="keyup delay:300ms"
						   hx-target="#emails" 
						   hx-swap="outerHTML"
						   hx-vals='{"status":"{{ request('status') }}"'
						   />
				</li>
			</ul>

			<div id="emails" class="layout">
				<span>LIST</span>
				<table>
					@foreach ($emails as $email)
						@include('demos.htmx-structure.row')
					@endforeach
				</table>
			</div>
		</div>
	</div>



</body>
</html>