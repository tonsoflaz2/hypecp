<!DOCTYPE html>
<html>
<head>

    <script type="module" src="https://cdn.jsdelivr.net/gh/starfederation/datastar@main/bundles/datastar.js"></script>
    
</head>
<body>
    <div id="datastar-one-demo" 
         data-on-load="@get('/demos/datastar-one/stream')">
        <label>Foo: 
            <input type="text" name="foo" data-bind-foo>
        </label>
        <div id="foo">Foo: </div>
        <div id="now">Now: </div> 
    </div> 
</body>