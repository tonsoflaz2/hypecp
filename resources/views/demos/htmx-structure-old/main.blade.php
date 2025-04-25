<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<script src='https://unpkg.com/htmx.org@2.0.4'></script>

	<link rel="shortcut icon" type="image/png" href="/favicon.png">

	<link rel="stylesheet" href="/css/htmx-structure.css">

	<script>
		function setBodyClass(className) {
		    document.body.classList.remove('structure', 'standard');
		    document.body.classList.add(className);
		    localStorage.setItem('bodyClass', className);
		}
		document.addEventListener('DOMContentLoaded', function() {
		    const savedClass = localStorage.getItem('bodyClass');
		    if (savedClass) {
		        setBodyClass(savedClass);
		    }
		});

		document.addEventListener('DOMContentLoaded', function() {
			document.querySelectorAll('#filters a[href]').forEach(link => {
		        link.addEventListener('click', function(e) {

		            const currentClass = document.body.classList.contains('structure') ? 'structure' :
		                                 document.body.classList.contains('standard') ? 'standard' : null;

		            if (!currentClass) return; // no class to apply

		            const url = new URL(link.href, window.location.origin);
		            url.searchParams.set('view', currentClass);
		            link.href = url.toString();
		        });
		    });
		});
	</script>

</head>
<body class="{{ request('view') }}">

	@php
		$emails_query = \App\Models\Structure\Email::latest();
		
		if (request('status') == 'active' || request('status') == 'complete') {
			$emails_query->where('status', request('status'));
		}

		if (request('query')) {
			$emails_query->where(function($sub) {
				return $sub->where('subject', 'LIKE', '%'.request('query').'%')
						   ->orWhere('full_text', 'LIKE', '%'.request('query').'%');
			});
		}

		$emails = $emails_query->take(50)->get();
		$tags = \App\Models\Structure\Tag::all()->sortBy('name');
		$campaigns = \App\Models\Structure\Campaign::all()->sortBy('name');
	
	@endphp
	
	<div id="structure_toggle">
		<a href="?" onclick="setBodyClass('standard'); return false;">Standard</a> |
		<a href="?" onclick="setBodyClass('structure'); return false;">Structure</a>
	</div>

	<div id="app" class="layout">
		<div class="layout">
			<span>SITE NAVIGATION</span>
			<ul id="navigation">
				<li style="padding: 0;">
					<img class="hide-structure" src="/images/portblaster-light.png"/>
					<img class="show-structure" src="/images/portblaster-dark.png"/>
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
				<span>PAGE FILTERS</span>
				<li @if(request('status') != 'active' && request('status') != 'complete')
						class="active"
					@endif 
					>
					<a href="?">All</a></li>
				<li @if(request('status') == 'active')
						class="active"
					@endif 
					><a href="?status=active">🔵 Active</a></li>
				<li @if(request('status') == 'complete')
						class="active"
					@endif 
					><a href="?status=complete">✅ Completed</a></li>
				<li>
					<input name="query"
						   hx-get="/demos/htmx-structure/emails/search"
						   hx-trigger="keyup delay:300ms"
						   hx-target="#emails" 
						   hx-select="#emails"
						   hx-swap="outerHTML"
						   hx-vals='{"status":"{{ request('status') }}"}'
						   type="text" placeholder="Search">
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