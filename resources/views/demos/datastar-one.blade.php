<!DOCTYPE html>
<html>
<head>

    <script type="module" src="https://cdn.jsdelivr.net/gh/starfederation/datastar@main/bundles/datastar.js"></script>

    <style>
        .opacity-0 {
            opacity: 0;
        }
        .opacity-1 {
            opacity: 1;
        }
    </style>
    
</head>
<body>
    <h1>data-indicator bug on text/html response</h1>
    <p>
        It seems the data-indicator is never sent the "false" setting when the reponse is not event/stream
    </p>

<h2>Code</h2>

    <pre>
    &#x3C;button id=&#x22;datastar-one-demo&#x22; 
         data-on-click=&#x22;@get(&#x27;/demos/datastar-one/long-request&#x27;)&#x22;
         data-indicator-fetching
         data-attr-disabled=&#x22;$fetching&#x22;&#x3E;
         Click me to load for 3 seconds
         &#x3C;div class=&#x22;opacity-0&#x22; data-class-opacity-1=&#x22;$fetching&#x22;&#x3E;
            LOADING
        &#x3C;/div&#x3E;
    &#x3C;/button&#x3E; 
</pre>

<h2>Non-working example</h2>
<button id="datastar-one-demo" 
         data-on-click="@get('/demos/datastar-one/long-request')"
         data-indicator-fetching
         data-attr-disabled="$fetching">
         Click me to load for 3 seconds
         <div class="opacity-0" data-class-opacity-1="$fetching">
            LOADING
        </div>
    </button> 
</body>

<h2>What should happen:</h2>
    <ul>
        <li>LOADING should appear when click starts @get (class opacity-1 added), then disappear when response returned.</li>
        <li>Button should be disabled during request, then go back to normal.</li>
    </ul>
    
<h2>What currently happens:</h2>

<ul>
    <li>LOADING does not disappear</li>
    <li>Button stays disabled</li>
</ul>

<h2>Solution</h2>
This works fine when the response is event/stream format. So the indicator is being set to true on a test/html, but never set back to false.
</body>