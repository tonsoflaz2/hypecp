<div class="p-12 text-gray-500">
	<div id="htmx-requests"
		 class="font-black text-gray-700 text-3xl border-b-8 pb-4">
		REQUESTS
	</div>

	<div id="htmx-hx-get"
		 class="mt-8 text-xl font-bold text-black">
		hx-get
	</div>


	<x-htmx-example>
		<x-slot:title>
			Click a button to load html
		</x-slot>

		<x-slot:attributes>
			<b>hx-get</b>
		</x-slot>

		<x-slot:code>
<button hx-get="/htmx/time">
	Click to get server time
</button>
		</x-slot>

		<x-slot:description>
			<p>
				This is the most basic htmx example. We set up a route called <i>/htmx/time</i> that returns the current server time. Then, we have a button that can be clicked to load the route with <b>hx-get</b>. 
			</p>
			<p>
				It assumes a default trigger action of "click", and a default target to place the html return from the get into whichever div was clicked.
			</p>
		</x-slot>

	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			Click a div to load html
		</x-slot>

		<x-slot:attributes>
			<b>hx-get</b>
		</x-slot>

		<x-slot:code>
<div hx-get="/htmx/time">
	Click to get server time
</div>
		</x-slot>

		<x-slot:description>
			<p>
				This is the exact same example as above, but we show that *any* element can be used as a hypermedia control. In this case, we are using a <i>&lt;div&gt;</i> instead of a <i>&lt;button&gt;</i>. 
			</p>
			<p>
				It assumes a default trigger action of "click", and a default target to place the html return from the get into whichever div was clicked.
			</p>
		</x-slot>

	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			Click to load html (showing defaults)
		</x-slot>

		<x-slot:attributes>
			<b>hx-get</b><br>
			hx-trigger<br>
			hx-target<br>
			hx-swap
		</x-slot>

		<x-slot:code>
<div hx-get="/htmx/time"
	 hx-trigger="click"
	 hx-target="this"
	 hx-swap="innerHTML">
	Click to get server time
</div>
		</x-slot>

		<x-slot:description>
			<p>
				This does exactly the same thing as the examples above. But here we explicitly set the <b>hx-trigger</b>, the <b>hx-target</b>, and the <b>hx-swap</b> method to the exact same as the defaults. 
			</p>
			<p>
				This is just to illustrate that htmx assumes certain default values. In this case, the <b>hx-get</b> on a div assumes a default trigger of <i>click</i>, a default target of <i>this</i> (the same div that is clicked), and a default swap method of <i>innerHTML</i>.
			</p>
			<p>
				The next several examples will demonstrate what happens when you change these defaults.
			</p>
		</x-slot>
	</x-htmx-example>

	

	<x-htmx-example>
		<x-slot:title>
			Click to load html: setting the target
		</x-slot>

		<x-slot:attributes>
			<b>hx-get</b><br>
			hx-target
		</x-slot>

		<x-slot:code>
<div hx-get="/htmx/time"
	 hx-target="#hx-get-target">
	 Click this to update target
</div>
<div id="hx-get-target"></div>
		</x-slot>

		<x-slot:description>
			<p>
				We have now changed the <b>hx-target</b> so that we can send the html returned from <b>hx-get</b> to any element on the page. Use a css selector (in this case the id <i>#hx-get-target</i>) to set the target.
			</p>
			<p>
				In this case, we set a small div under the clickable div, so when you click it, the target is filled with the html from the <i>/htmx/time</i> route.
			</p>
		</x-slot>
	</x-htmx-example>


<x-htmx-example>
		<x-slot:title>
			Hover to load html: setting the trigger
		</x-slot>

		<x-slot:attributes>
			<b>hx-get</b><br>
			hx-trigger
		</x-slot>

		<x-slot:code>
<div hx-get="/htmx/time"
	 hx-trigger="mouseenter">
	 Hover over this to get time
</div>
		</x-slot>

		<x-slot:description>
			<p>
				We have now changed the <b>hx-trigger</b> so that we can activate it on a different user event.
			</p>
			<p>
				In this case, we are using <i>mouseenter</i> to let the user trigger the <b>hx-get</b> when they hover over the div.
			</p>
		</x-slot>
	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			Click to load html: setting the swap
		</x-slot>

		<x-slot:attributes>
			<b>hx-get</b><br>
			hx-swap
		</x-slot>

		<x-slot:code>
<div hx-get="/htmx/time"
	 hx-swap="outerHTML">
	 Click to replace with the server time
</div>
		</x-slot>

		<x-slot:description>
			<p>
				We have now changed the <b>hx-swap</b> away from the default of <i>innerHTML</i> to <i>outerHTML</i>.
			</p>
			<p>
				This means that when we get our response, the html completely replaces the element (the div we clicked in this case) with the html from the server.
			</p>
		</x-slot>
	</x-htmx-example>



	<x-htmx-example>
		<x-slot:title>
			Click to load html to any dom target
		</x-slot>

		<x-slot:attributes>
			<b>hx-get</b><br>
			hx-target
		</x-slot>

		<x-slot:code>
<div hx-get="/htmx/time"
	 hx-target="#some-notification-target">
	 Click this to update notifications
</div>
		</x-slot>

		<x-slot:description>
			<p>
				Again, we are using a css selector to set the target, but now we are targeting the element <i>#some-notification-target</i>, which is outside of our original example.
			</p>
			<p>
				You can see when you click to load the server time, it is now placed in the notification target at the top right of the page.
			</p>
		</x-slot>
	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			Click to load an html form
		</x-slot>

		<x-slot:attributes>
			<b>hx-get</b>
		</x-slot>

		<x-slot:code>
<div hx-get="/htmx/form">
	Click to load an html form
</div>
		</x-slot>

		<x-slot:description>
			<p>
				<span class="text-red-500 font-bold">WARNING: DOESN'T WORK!</span>
			</p>
			<p>
				Click to load, then try to enter data in the form to see what's wrong.
			</p>

			<p>
				The reason the form doesn't work is because by default it is loaded into the innerHTML of the div you clicked. The problem is that the div you clicked then wraps the form, and the hx-get attribute on that div will continue to work as expected, and reload the form!
			</p>

			<p>
				<div class="text-sm italic bg-blue-50 p-4 rounded-lg"> Check out the folowing examples for a few ways to fix this form example.</div>
			</p>
		</x-slot>
	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			Click to load an html form *** FIX 1 ***
		</x-slot>

		<x-slot:attributes>
			<b>hx-get</b><br>
			hx-target
		</x-slot>

		<x-slot:code>
<div hx-get="/htmx/form"
	 hx-target="#hx-get-form-target">
	Click to load an html form
</div>
<div id="hx-get-form-target"></div>
		</x-slot>

		<x-slot:description>
			<p>
				Now we should be able to load the form AND use it correctly.
			</p>

			<p>
				The reason this works is because we are now loading the form to a separate element than the one that has the click trigger on it. 
			</p>

			<p>You can click the div again to *reload* the blank form from the server.</p>
		</x-slot>
	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			Click to load an html form *** FIX 2 ***
		</x-slot>

		<x-slot:attributes>
			<b>hx-get</b><br>
			hx-swap="outerHTML"
		</x-slot>

		<x-slot:code>
<div hx-get="/htmx/form"
	 hx-swap="outerHTML">
	Click to load an html form
</div>
		</x-slot>

		<x-slot:description>
			<p>
				Again, we should be able to load the form AND use it correctly now.
			</p>

			<p>
				The reason it works this time is that we have changed the <b>hx-swap</b> default from <i>innerHTML</i> (the default) to <i>outerHTML</i>.
			</p>
			<p><i>hx-swap="outerHTML"</i> will replace the entire target itself, rather than replace the content inside the div as the <i>innerHTML</i> default does.
			</p>
		</x-slot>
	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			
		</x-slot>

		<x-slot:code>

		</x-slot>

		<x-slot:description>
			
		</x-slot>
	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			
		</x-slot>

		<x-slot:code>

		</x-slot>

		<x-slot:description>
			
		</x-slot>
	</x-htmx-example>

	<div id="htmx-hx-trigger"
		 class="mt-8 text-xl font-bold text-black">
		hx-trigger
	</div>

	<x-htmx-example>
		<x-slot:title>
			Lazy-load html with "load" trigger
		</x-slot>

		<x-slot:code>
<div hx-get="/htmx/time"
	 hx-trigger="load">
	You will never see this.
</div>
		</x-slot>

		<x-slot:description>
			<p>
				Now, we are changing the default <b>hx-trigger</b> so that instead of "click", it will trigger the <b>hx-get</b> on "load".
			</p>
			<p>The "load" trigger option is triggered when the page loads. This pattern is commonly called <i>lazy loading</i>. Because it happens immediately on load, you will likely not see the original text in the div.
			</p>
		</x-slot>
	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			
		</x-slot>

		<x-slot:code>

		</x-slot>

		<x-slot:description>
			
		</x-slot>
	</x-htmx-example>


</div>