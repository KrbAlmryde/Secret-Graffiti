<!doctype html>
<html>
    <head>
        <title>Secret Graffiti</title>
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="js/sketch.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>

        <style type='text/css'>
            html, body {
                overflow: hidden;
            }

            simple_sketch {
                background: #04B4AE;
            }
            #canvas {
                display: block;
            }
    </style>

    </head>
    <body>
        <div class='demo'>
          <canvas id='simple_sketch' width='auto' height='auto'></canvas>
          <script type='text/javascript'>
            var canvas = document.getElementById('simple_sketch');

            // resize the canvas to fill browser window dynamically
            window.addEventListener('resize', resizeCanvas, false);

            function resizeCanvas() {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
                $('#simple_sketch').sketch();
            }
            resizeCanvas();
            $('#simple_sketch').sketch();
          </script>

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
