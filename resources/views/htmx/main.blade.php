<div class="p-6 md:p-12 text-gray-500 max-w-full bg-white min-h-screen">

	@php
		$htmxcdn = "<script src='https://unpkg.com/htmx.org@2.0.4'></script>";
	@endphp

	<p class="mb-8 text-sm p-2 px-4 italic bg-blue-50 rounded-lg">
		NOTE: If you don't know what htmx is, you should check out <a class="text-blue-500 font-bold" target="_blank" href="https://htmx.org">htmx.org</a> first!
	</p>

	<div id="htmx-requests"
		 class="font-black text-gray-700 text-3xl pb-4 border-b-4">
		HTMX ESSENTIALS
	</div>

	

	<p class="p-4">
		Before you get started, be sure to include the htmx cdn at the top of your page:
	</p>

	<div class="lg:flex w-full overflow-hidden">
		<div class="w-full code-block relative overflow-x-auto">
		<pre><code class="hljs language-html rounded-xl">{!! htmlentities($htmxcdn) !!}</code></pre>
		</div>
	</div>

	

	<div class="p-4">
		There are 4 primary attributes that you will need to do 80% (more like 99%) of your work on your htmx sites. They are: 
		<ol class="list-decimal m-4 ml-8">
			<li><b>hx-get</b> - This creates a simple GET ajax request to the url you specify. i.e. <i>hx-get="/examples/1/details"</i></li>
			<li><b>hx-trigger</b> - This decides how to trigger the ajax request in <i>hx-get</i>. i.e. <i>hx-trigger="click"</i></li>
			<li><b>hx-target</b> - This uses a css selector to decide where in the dom you will place the returned html from the <i>hx-get</i>. i.e. <i>hx-target="#target-div"</i></li>
			<li><b>hx-swap</b> - This decides <i>how</i> you will swap the html into the dom, i.e. <i>hx-swap="outerHTML"</i></li>
		</ol>
		Using these 4 attributes allows you to trigger requests and place data from your server anywhere into your page.

		<div class="my-4 bg-blue-50 p-4 rounded-lg italic">
			Goal: You need to click a specific div on the page to load dynamic data from the server into another div on the page.
		</div>


		This next section of examples will build on each of these 4 essential htmx attributes to get to accomplish that goal.
	</div>

	<div id="htmx-hx-get"
		 class="mt-8 text-xl font-bold text-black">
		1. hx-get
	</div>


	<x-htmx-example>
		<x-slot:title>
			Click a button to load html
		</x-slot>

		<x-slot:attributes>
			hx-get
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
		<x-slot:route>
			/htmx/time
		</x-slot>
	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			Click a div to load html
		</x-slot>

		<x-slot:attributes>
			hx-get
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
		<x-slot:route>
			/htmx/time
		</x-slot>
	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			Click to load html (showing defaults)
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
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
		<x-slot:route>
			/htmx/time
		</x-slot>
	</x-htmx-example>

	

	<x-htmx-example>
		<x-slot:title>
			Click to load html: setting the target
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
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
		<x-slot:route>
			/htmx/time
		</x-slot>
	</x-htmx-example>


<x-htmx-example>
		<x-slot:title>
			Hover to load html: setting the trigger
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
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
		<x-slot:route>
			/htmx/time
		</x-slot>
	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			Click to load html: setting the swap
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
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
		<x-slot:route>
			/htmx/time
		</x-slot>
	</x-htmx-example>



	<x-htmx-example>
		<x-slot:title>
			Click to load html to any dom target
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
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
		<x-slot:route>
			/htmx/time
		</x-slot>
	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			Click to load an html form
		</x-slot>

		<x-slot:attributes>
			hx-get
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
				<div class="text-sm italic bg-blue-50 p-4 rounded-lg"> Check out the following examples for a few ways to fix this form example.</div>
			</p>
		</x-slot>
		<x-slot:route>
			/htmx/form
		</x-slot>
	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			Click to load an html form *** FIX 1 ***
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
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
		<x-slot:route>
			/htmx/form
		</x-slot>
	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			Click to load an html form *** FIX 2 ***
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
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
		<x-slot:route>
			/htmx/form
		</x-slot>
	</x-htmx-example>

	

	<div id="htmx-hx-trigger"
		 class="mt-8 text-xl font-bold text-black">
		2. hx-trigger
	</div>

	<x-htmx-example>
		<x-slot:title>
			Load html with "click" trigger
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
			<b>hx-trigger="click"</b>
		</x-slot>

		<x-slot:code>
<div hx-get="/htmx/time"
	 hx-trigger="click">
	Click me to load html
</div>
		</x-slot>

		<x-slot:description>
			<p>
				Put description here
			</p>
		</x-slot>
		<x-slot:route>
			/htmx/time
		</x-slot>
	</x-htmx-example>


	<x-htmx-example>
		<x-slot:title>
			Load html on click but only once 
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
			<b>hx-trigger="click once"</b>
		</x-slot>

		<x-slot:code>
<div hx-get="/htmx/time"
	 hx-trigger="click once">
	This will load just once
</div>
		</x-slot>

		<x-slot:description>
			<p>
				Loads when input changed
			</p>
		</x-slot>
		<x-slot:route>
			/htmx/time
		</x-slot>
	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			Load html when input is changed 
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
			<b>hx-trigger="changed"</b>
		</x-slot>

		<x-slot:code>
<div id="select-target">
	Load the html when the input is changed
</div>
<select hx-get="/htmx/time"
	    hx-trigger="change"
	    hx-target="#select-target">
	<option value="">None</option>
	<option value="1">One</option>
	<option value="2">Two</option>
</select>
		</x-slot>

		<x-slot:description>
			<p>
				Loads html when the select changes.
			</p>
		</x-slot>
		<x-slot:route>
			/htmx/time
		</x-slot>
	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			Load html when the div is revealed
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
			<b>hx-trigger="revealed"</b>
		</x-slot>

		<x-slot:code>
<div hx-get="/htmx/time"
	 hx-trigger="revealed">
	 When this gets to the to right place on the page, it will be replaced.
</div>
		</x-slot>

		<x-slot:description>
			<p>
				Loads html when the select changes.
			</p>
		</x-slot>
		<x-slot:route>
			/htmx/time
		</x-slot>
	</x-htmx-example>


	<x-htmx-example>
		<x-slot:title>
			Load html when the mouse goes over it
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
			<b>hx-trigger="mouseenter"</b>
		</x-slot>

		<x-slot:code>
<div hx-get="/htmx/time"
	 hx-trigger="mouseenter">
	 This will be replaced when the mouse goes over it
</div>
		</x-slot>

		<x-slot:description>
			<p>
				Loads html when the select changes.
			</p>
		</x-slot>
		<x-slot:route>
			/htmx/time
		</x-slot>
	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			Load html when the mouse leaves a div
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
			<b>hx-trigger="mouseleave"</b>
		</x-slot>

		<x-slot:code>
<div hx-get="/htmx/time"
	 hx-trigger="mouseleave">
	 This will be replaced when the mouse leaves the div
</div>
		</x-slot>

		<x-slot:description>
			<p>
				Mouse leave
			</p>
		</x-slot>
		<x-slot:route>
			/htmx/time
		</x-slot>
	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			Load html when any key is pressed on an input
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
			<b>hx-trigger="keyup"</b>
		</x-slot>

		<x-slot:code>
<input hx-get="/htmx/time"
	   hx-trigger="keyup"
	   hx-target="#input-keyup-div" />
<div id="input-keyup-div">
	This will get replaced
</div>
		</x-slot>

		<x-slot:description>
			<p>
				When key pressed
			</p>
		</x-slot>
		<x-slot:route>
			/htmx/time
		</x-slot>
	</x-htmx-example>

	 

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
		<x-slot:route>
			/htmx/time
		</x-slot>
	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			Load html with the "every" trigger (aka polling)
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
			<b>hx-trigger="every 5s"</b>
		</x-slot>

		<x-slot:code>
<div hx-get="/htmx/time"
	 hx-trigger="every 5s">
	Polling every 5 seconds
</div>
		</x-slot>

		<x-slot:description>
			<p>
				Put description here
			</p>
		</x-slot>
		<x-slot:route>
			/htmx/time
		</x-slot>
	</x-htmx-example>

	<div id="htmx-hx-target"
		 class="mt-8 text-xl font-bold text-black">
		3. hx-target
	</div>

	<x-htmx-example>
		<x-slot:title>
			Put html into a target with an id on a click
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
			hx-target
		</x-slot:attributes>

		<x-slot:code>
<button hx-get="/htmx/time"
		hx-target="#time-target-click">
	Click me
</button>
<div id="time-target-click">
	Replace this target on click
</div>
		</x-slot>

		<x-slot:description>
		</x-slot>
		<x-slot:route>
			/htmx/time
		</x-slot:route>
	</x-htmx-example>


	<x-htmx-example>
		<x-slot:title>
			Put html into a target with a class on a click
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
			hx-target
		</x-slot:attributes>

		<x-slot:code>
<button hx-get="/htmx/time"
		hx-target=".time-target-click">
	Click me
</button>
<div class="time-target-click">
	Replace this target on click
</div>
		</x-slot>

		<x-slot:description>
		</x-slot>
		<x-slot:route>
			/htmx/time
		</x-slot:route>
	</x-htmx-example>


	<x-htmx-example>
		<x-slot:title>
			Put html into a target with the 'closest' css selector
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
			hx-target
		</x-slot:attributes>

		<x-slot:code>
<div>
	Replace this target on click
	<button hx-get="/htmx/time"
			hx-target="closest div">
		Click me
	</button>
</div>
		</x-slot>

		<x-slot:description>
		</x-slot>
		<x-slot:route>
			/htmx/time
		</x-slot:route>
	</x-htmx-example>


	<div id="htmx-hx-swap"
		 class="mt-8 text-xl font-bold text-black">
		4. hx-swap
	</div>

	<x-htmx-example>
		<x-slot:title>
			Swap data to replace the innerHTML
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
			hx-target<br>
			hx-swap="innerHTML"
		</x-slot:attributes>

		<x-slot:code>
<button hx-get="/htmx/time"
		hx-target="#swap-target">
	Click to replace html			
</button>
<div id="swap-target">
	This will be replaced
</div>
		</x-slot>

		<x-slot:description>
			
		</x-slot>
		<x-slot:route>
			/htmx/time
		</x-slot:route>
	</x-htmx-example>



	<x-htmx-example>
		<x-slot:title>
			Swap data to replace the outerHTML
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
			hx-target<br>
			hx-swap="outerHTML"
		</x-slot:attributes>

		<x-slot:code>
<button hx-get="/htmx/time"
		hx-target="#swap-target"
		hx-swap="outerHTML">
	Click to replace html		
</button>
<div id="swap-target">
	This will be replaced
</div>
		</x-slot>

		<x-slot:description>
			Because we are using hx-swap outerHTML, the #swap-target no longer exists after it has loaded once.
		</x-slot:description>
		<x-slot:route>
			/htmx/time
		</x-slot:route>
	</x-htmx-example>


	<x-htmx-example>
		<x-slot:title>
			Swap data to the target using beforebegin
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
			hx-target<br>
			hx-swap="beforebegin"
		</x-slot:attributes>

		<x-slot:code>
<button hx-get="/htmx/time"
		hx-target="#swap-target-list"
		hx-swap="beforebegin">
	Click to place the new html before the list		
</button>
<ul id="swap-target-list" style="border: 2px solid gray; padding: 5px;">
	<li>Item 1</li>
	<li>Item 2</li>
	<li>Item 3</li>
</ul>
		</x-slot>

		<x-slot:description>
			Because we are using hx-swap outerHTML, the #swap-target no longer exists after it has loaded once.
		</x-slot:description>
		<x-slot:route>
			/htmx/time
		</x-slot:route>
	</x-htmx-example>


	<x-htmx-example>
		<x-slot:title>
			Swap data to the target using afterbegin
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
			hx-target<br>
			hx-swap="afterbegin"
		</x-slot:attributes>

		<x-slot:code>
<button hx-get="/htmx/time"
		hx-target="#swap-target-list-after"
		hx-swap="afterbegin">
	Click to place the new html at the top of the list	
</button>
<ul id="swap-target-list-after" style="border: 2px solid gray; padding: 5px;">
	<li>Item 1</li>
	<li>Item 2</li>
	<li>Item 3</li>
</ul>
		</x-slot>

		<x-slot:description>
			Because we are using hx-swap outerHTML, the #swap-target no longer exists after it has loaded once.
		</x-slot:description>
		<x-slot:route>
			/htmx/time
		</x-slot:route>
	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			Swap data to the target using beforeend
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
			hx-target<br>
			hx-swap="beforeend"
		</x-slot:attributes>

		<x-slot:code>
<button hx-get="/htmx/time"
		hx-target="#swap-target-list-bottom"
		hx-swap="beforeend">
	Click to place the new html at the bottom of the list	
</button>
<ul id="swap-target-list-bottom" style="border: 2px solid gray; padding: 5px;">
	<li>Item 1</li>
	<li>Item 2</li>
	<li>Item 3</li>
</ul>
		</x-slot>

		<x-slot:description>
			Because we are using hx-swap outerHTML, the #swap-target no longer exists after it has loaded once.
		</x-slot:description>
		<x-slot:route>
			/htmx/time
		</x-slot:route>
	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			Swap data to the target using afterend
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
			hx-target<br>
			hx-swap="afterend"
		</x-slot:attributes>

		<x-slot:code>
<button hx-get="/htmx/time"
		hx-target="#swap-target-list-under"
		hx-swap="afterend">
	Click to place the new html underneath the list	
</button>
<ul id="swap-target-list-under" style="border: 2px solid gray; padding: 5px;">
	<li>Item 1</li>
	<li>Item 2</li>
	<li>Item 3</li>
</ul>
		</x-slot>

		<x-slot:description>
			Because we are using hx-swap outerHTML, the #swap-target no longer exists after it has loaded once.
		</x-slot:description>
		<x-slot:route>
			/htmx/time
		</x-slot:route>
	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			Delete a targeted item after loading
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
			hx-target<br>
			hx-swap="delete"
		</x-slot:attributes>

		<x-slot:code>
<button hx-get="/htmx/time"
		hx-target="#swap-target-list-delete"
		hx-swap="delete">
	Click to delete the list after the html loads
</button>
<ul id="swap-target-list-delete" style="border: 2px solid gray; padding: 5px;">
	<li>Item 1</li>
	<li>Item 2</li>
	<li>Item 3</li>
</ul>
		</x-slot>

		<x-slot:description>
			Because we are using hx-swap outerHTML, the #swap-target no longer exists after it has loaded once.
		</x-slot:description>
		<x-slot:route>
			/htmx/time
		</x-slot:route>
	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			Do nothing on the swap
		</x-slot>

		<x-slot:attributes>
			hx-get<br>
			hx-target<br>
			hx-swap="none"
		</x-slot:attributes>

		<x-slot:code>
<button hx-get="/htmx/time"
		hx-target="#swap-target-list-none"
		hx-swap="none">
	Click to not change the the list after the html loads
</button>
<ul id="swap-target-list-none" style="border: 2px solid gray; padding: 5px;">
	<li>Item 1</li>
	<li>Item 2</li>
	<li>Item 3</li>
</ul>
		</x-slot>

		<x-slot:description>
			Because we are using hx-swap outerHTML, the #swap-target no longer exists after it has loaded once.
		</x-slot:description>
		<x-slot:route>
			/htmx/time
		</x-slot:route>
	</x-htmx-example>

	<div id="htmx-hx-essentials-examples"
		 class="mt-8 text-xl font-bold text-black">
		Essentials examples
	</div>

	<x-htmx-example>
		<x-slot:title>
			Dynamic Modal
		</x-slot>

		<x-slot:code>
<style>
    dialog {
        display: flex;
        opacity: 0;
        pointer-events: none;
        transform: scale(0.9);
    }
    dialog[open] {
        display: flex;
        opacity: 1;
        transform: scale(1);
        pointer-events: inherit;
        transition: opacity 0.1s ease-in,
         			transform 0.1s ease-in;
    }
    dialog::backdrop {
        background: rgba(0,0,0,0.3);
        backdrop-filter: blur(3px);
    }
</style>

<button hx-get="/examples/modal-form"
        hx-trigger="mouseenter"
        hx-target="#modal-content"
        onclick="window.my_modal.showModal()">
    Open Modal
</button>

<dialog id="my_modal" 
		class="rounded-lg shadow-lg w-3/4">
    <div class="w-full">
        <div class="font-bold text-black text-lg border-b p-4">
            <div class="float-right cursor-pointer text-gray-400 hover:text-gray-600 transition" 
            	 onclick="window.my_modal.close()">
                <svg xmlns="http://www.w3.org/2000/svg" 
                	 fill="none" 
                	 viewBox="0 0 24 24" 
                	 stroke-width="1.5" 
                	 stroke="currentColor" 
                	 class="size-6">
                  	<path stroke-linecap="round" 
                  		  stroke-linejoin="round"d="M6 18 18 6M6 6l12 12" />
                </svg>
            </div>
            Dynamic Modal Example
        </div>

        <div id="modal-content">
            <div class="p-8 text-center text-xl text-gray-400">
                Loading....
            </div>
        </div>
    </div>
</dialog>
		</x-slot>

		<x-slot:description>
			
		</x-slot>
	</x-htmx-example>

	<div id="htmx-extensions"
		 class="mt-8 text-xl font-bold text-black">
		EXTENSIONS
	</div>

	<p class="p-4">
		HTMX extensions add additional functionality to the core library. Extensions are loaded via CDN or npm and enabled using the <i>hx-ext</i> attribute. They can enhance HTMX with features like head tag support, client-side templates, and more.
	</p>

	<div id="htmx-head-support"
		 class="mt-8 text-xl font-bold text-black">
		head-support
	</div>

	<p class="p-4">
		To use the head-support extension, first include the script and enable it on your page:
	</p>

	<div class="lg:flex w-full overflow-hidden">
		<div class="w-full code-block relative overflow-x-auto">
		<pre><code class="hljs language-html rounded-xl">{!! htmlentities('<script src="https://cdn.jsdelivr.net/npm/htmx-ext-head-support@2.0.2"></script>

<body hx-ext="head-support">') !!}</code></pre>
		</div>
	</div>

	<p class="p-4">
		The server responses contain complete HTML documents with updated titles:
	</p>

	<div class="lg:flex w-full gap-4">
		<div class="w-1/2 code-block relative overflow-x-auto">
			<pre><code class="hljs language-html rounded-xl">{!! htmlentities('<html>
<head>
    <title hx-head="re-eval">🟢 Active - hype cp | Hypermedia Copy & Paste</title>
</head>
</html>') !!}</code></pre>
		</div>
		<div class="w-1/2 code-block relative overflow-x-auto">
			<pre><code class="hljs language-html rounded-xl">{!! htmlentities('<html>
<head>
    <title hx-head="re-eval">🔴 Inactive - hype cp | Hypermedia Copy & Paste</title>
</head>
</html>') !!}</code></pre>
		</div>
	</div>

	<x-htmx-example>
		<x-slot:title>
			Updating the page title
		</x-slot>

		<x-slot:attributes>
			hx-ext="head-support"<br>
			hx-get<br>
			hx-swap="none"<br>
			hx-head="re-eval"
		</x-slot:attributes>

		<x-slot:code>
<button hx-get="/htmx/head-support/title-active"
        hx-swap="none">
    Set Active Title
</button>

<button hx-get="/htmx/head-support/title-inactive"
        hx-swap="none">
    Set Inactive Title
</button>
		</x-slot>

		<x-slot:description>
			<p>
				The <b>head-support</b> extension allows HTMX to process &lt;head&gt; tags in responses, enabling dynamic updates to the page title, meta tags, CSS, and other head elements.
			</p>
			<p>
				In this example, clicking the buttons sends requests that return only a &lt;head&gt; tag with a new &lt;title&gt;. The <i>hx-head="re-eval"</i> attribute on the title tag tells the extension to replace the existing title with the new one.
			</p>
			<p>
				Using <i>hx-swap="none"</i> prevents any content changes while the head-support extension processes the &lt;head&gt; tag and updates only the page title.
			</p>
		</x-slot>
		<x-slot:route>
			/htmx/head-support/title-active<br>
			/htmx/head-support/title-inactive
		</x-slot:route>
	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			Updating CSS styles
		</x-slot>

		<x-slot:attributes>
			hx-ext="head-support"<br>
			hx-get<br>
			hx-swap="none"<br>
			hx-head="re-eval"
		</x-slot:attributes>

		<x-slot:code>
<button hx-get="/htmx/head-support/css-blue"
        hx-swap="none">
    Blue Theme
</button>

<button hx-get="/htmx/head-support/css-red"
        hx-swap="none">
    Red Theme
</button>

<div id="css-demo" class="p-4 border rounded">
    <h3>CSS Demo</h3>
    <p>Click the buttons above to change the head tag for the CSS of this box.</p>
</div>
		</x-slot>

		<x-slot:description>
			<p>
				This example demonstrates how to dynamically update CSS styles using the head-support extension.
			</p>
			<p>
				The responses contain &lt;style&gt; tags with <i>hx-head="re-eval"</i> that replace existing styles with the same ID. The extension processes the &lt;head&gt; tag and updates the page's CSS.
			</p>
			<p>
				Using <i>hx-swap="none"</i> prevents any content changes while only the styling gets updated.
			</p>
		</x-slot>
		<x-slot:route>
			/htmx/head-support/css-blue<br>
			/htmx/head-support/css-red
		</x-slot:route>
	</x-htmx-example>

	<p class="p-4">
		The server responses contain style tags with the same ID for replacement:
	</p>

	<div class="lg:flex w-full gap-4">
		<div class="w-1/2 code-block relative overflow-x-auto">
			<pre><code class="hljs language-html rounded-xl">{!! htmlentities('<html>
<head>
    <style id="demo-styles" hx-head="re-eval">
        #css-demo {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: 3px solid #4c51bf;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }
        #css-demo h3 {
            color: #e6fffa;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
    </style>
</head>
</html>') !!}</code></pre>
		</div>
		<div class="w-1/2 code-block relative overflow-x-auto">
			<pre><code class="hljs language-html rounded-xl">{!! htmlentities('<html>
<head>
    <style id="demo-styles" hx-head="re-eval">
        #css-demo {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            border: 3px solid #e53e3e;
            box-shadow: 0 10px 25px rgba(245, 87, 108, 0.3);
        }
        #css-demo h3 {
            color: #fed7d7;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
    </style>
</head>
</html>') !!}</code></pre>
		</div>
	</div>

	<div id="htmx-preload"
		 class="mt-8 text-xl font-bold text-black">
		preload
	</div>

	<p class="p-4">
		The preload extension allows you to load HTML fragments into your browser's cache before they are requested by the user, making pages appear to load nearly instantaneously. It's enabled by default on this page.
	</p>

	<x-htmx-example>
		<x-slot:title>
			Preloading content on mousedown
		</x-slot>

		<x-slot:attributes>
			preload<br>
			hx-get<br>
			hx-target
		</x-slot:attributes>

		<x-slot:code>
<button hx-get="/htmx/preload/content" 
        hx-target="#preload-demo"
        preload>
    Hover and click me (content preloads on mousedown)
</button>

<div id="preload-demo" class="p-4 border rounded mt-4">
    <p class="text-gray-500">Content will load here...</p>
</div>
		</x-slot>

		<x-slot:description>
			<p>
				The <b>preload</b> extension begins loading content when the user starts clicking (mousedown event). This gives your server a 100-200ms head start, making the response appear nearly instantaneous.
			</p>
			<p>
				Simply add the <i>preload</i> attribute to any <i>hx-get</i> element or <i>&lt;a href&gt;</i> link. The extension automatically handles the preloading in the background.
			</p>
			<p>
				<strong>Note:</strong> Preloading only works with GET requests. POST, PUT, and DELETE requests cannot be preloaded for security reasons.
			</p>
		</x-slot>
		<x-slot:route>
			/htmx/preload/content
		</x-slot:route>
	</x-htmx-example>

	<x-htmx-example>
		<x-slot:title>
			Preloading form responses
		</x-slot>

		<x-slot:attributes>
			preload<br>
			hx-get<br>
			hx-target<br>
			form elements
		</x-slot:attributes>

		<x-slot:code>
<form hx-get="/htmx/preload/form-response" 
      hx-target="#form-demo"
      preload>
    
    <div class="mb-4">
        <label class="block text-sm font-medium mb-2">Select Plan:</label>
        <input type="radio" name="plan" value="basic" class="mr-2"> Basic
        <input type="radio" name="plan" value="pro" class="mr-2"> Pro
        <input type="radio" name="plan" value="enterprise" class="mr-2"> Enterprise
    </div>
    
    <div class="mb-4">
        <label class="block text-sm font-medium mb-2">Features:</label>
        <input type="checkbox" name="features[]" value="video" class="mr-2"> Video
        <input type="checkbox" name="features[]" value="audio" class="mr-2"> Audio
        <input type="checkbox" name="features[]" value="support" class="mr-2"> Support
    </div>
    
    <div class="mb-4">
        <label class="block text-sm font-medium mb-2">Region:</label>
        <select name="region" class="border rounded px-3 py-2">
            <option value="us">United States</option>
            <option value="eu">Europe</option>
            <option value="asia">Asia</option>
        </select>
    </div>
    
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Submit Form (Content Preloaded!)
    </button>
</form>

<div id="form-demo" class="p-4 border rounded mt-4">
    <p class="text-gray-500">Form responses will appear here...</p>
</div>
		</x-slot>

		<x-slot:description>
			<p>
				The <b>preload</b> extension can preload form responses when users interact with form elements like radio buttons, checkboxes, and select dropdowns.
			</p>
			<p>
				When you hover over or interact with form elements, the extension preloads the server response as if the form was submitted with those values. This makes form interactions appear nearly instantaneous.
			</p>
			<p>
				<strong>Try it:</strong> Hover over different radio buttons, checkboxes, or change the select dropdown to see responses preload in the background.
			</p>
		</x-slot>
		<x-slot:route>
			/htmx/preload/form-response
		</x-slot:route>
	</x-htmx-example>

</div>