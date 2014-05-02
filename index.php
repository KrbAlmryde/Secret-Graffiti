<!doctype html>
<html>
    <head>
        <title>Secret Graffiti</title>
        <script src="http://code.jquery.com/jquery-latest.js"></script>

    </head>
    <body>
        <h1>Secret Graffiti</h1>
        <a href="./draw.php"><button>Draw</button></a>

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
        </div>
    </body>
</html>
