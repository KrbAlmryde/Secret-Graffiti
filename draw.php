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
			.tools { margin-bottom: 10px; }
			.tools a {
				border:1px solid #E0E0E0; height: 25px; line-height: 25px; padding: 0 10px; vertical-align: middle; text-align: center; text-decoration: none; display: inline-block; color: black;
			}
			
    </style>

    </head>
    <body>
		
		
        <div class='tools'>
            <button onclick="save" style="float: right; width: 100px;">Download</button>
         </div>
          <script>
			function save() {
				var canvas = document.getElementById('colors_sketch');
				var dataURL = canvas.toDataURL();
				$.ajax({
					type: "POST",
					url: "script.php",
					data: { 
						imgBase64: dataURL
					}
				}).done(function(o) {
					console.log('saved'); 
				});
			}
		</script>
          
        <div class='demo'>
          <canvas id='colors_sketch' width='auto' height='auto'></canvas>
          <script type='text/javascript'>
            var canvas = document.getElementById('colors_sketch');

            // resize the canvas to fill browser window dynamically
            window.addEventListener('resize', resizeCanvas, false);

            function resizeCanvas() {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
                $('#colors_sketch').sketch();
            }
            resizeCanvas();
            $('#colors_sketch').sketch();
          </script>
		  <script type='text/javascript'>
            $(function() {
              $.each(['#424F5F', '#017B90', '#CAC6C3', '#96BD3C', '#C4D525', '#FFC90B', '#FF8730', '#FA031E', '#A43C3D', '#DA4F6E', '#593C50', '#B88B52', '#FFFFFF', '#000000'], function() {
                $('.tools').append("<a href='#colors_sketch' data-color='" + this + "' style='width: 3px; background: " + this + ";'></a> ");
              });
              $.each([3, 5, 10, 15], function() {
                $('.tools').append("<a href='#colors_sketch' data-size='" + this + "' style='background: #E0E0E0'; width: 3px>" + this + "</a> ");
              });
              $('#colors_sketch').sketch();
            });
          </script>

        </div>
    </body>
</html>