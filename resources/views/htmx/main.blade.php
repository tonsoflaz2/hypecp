<div class="p-12">
	<div id="htmx-requests"
		 class="font-black text-gray-700 text-3xl border-b-8 pb-4">
		REQUESTS
	</div>

	<div id="htmx-hx-get"
		 class="mt-8 text-xl font-bold">
		hx-get
	</div>

	<div class="font-bold mt-4">
		Click to Load
	</div>

	<pre><code class="language-html rounded-lg">&lt;div hx-get="/htmx/time"
	 hx-trigger="click"&gt;
	Click me to get current time
&lt;/div&gt;</code></pre>

	<div hx-get="/htmx/time"
		 hx-trigger="click">
		Click me to get current time
	</div>
</div>