<html>
<body>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <h1>Secret Graffiti</h1>
    <script>
        console.log("hello dudes.")
        $.getJSON(
            "script.php",
            { foo: "Hello from JavaScript. Blah blah." }
        )
        .done(function(data) {
            console.info("Success.")
            console.log(data)
        })
        .fail(function() {
            console.info("AJAX didn't work.")
        })
    </script>
</body>
</html>
