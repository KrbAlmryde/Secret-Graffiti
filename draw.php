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
				border:1px solid #E0E0E0; height: 50px; line-height: 50px; padding: 0 10px; vertical-align: middle; text-align: center; text-decoration: none; display: inline-block; color: black;
			}

    </style>

    </head>
    <body>


        <div class='tools'>
            <button id="save" onclick="save" style="float: right; width: 100px; height:50px">Save</button>
         </div>

        <div class='demo'>
<!--           <canvas id='colors_sketch' width='auto' height='auto' style="background: url(./pics/brick.jpg) no-repeat center center;"></canvas> -->
		  <script type='text/javascript'>

            // Write the brick.jpg file
            $.get("script.php?getBrick=1").done(function() {
                $("<img src='./pics/brick.jpg' id='brick' />").appendTo("body");
                // $('div.demo').append("<canvas id='colors_sketch' width='auto' height='auto' style='background: url(./pics/brick.jpg) center center;'></canvas>");
                $('div.demo').append("<canvas id='colors_sketch' width='auto' height='auto'></canvas>");

                var canvas = document.getElementById('colors_sketch');

                // var context = $("#colors_sketch")[0].getContext('2d');
                // var image = document.getElementById("brick");
                // context.drawImage(image, 10, 10);

                // resize the canvas to fill browser window dynamically
                window.addEventListener('resize', resizeCanvas, false);

                function resizeCanvas() {
                    canvas.width = window.innerWidth;
                    canvas.height = window.innerHeight;
                    $('#colors_sketch').sketch();
                }
                resizeCanvas();
                $('#colors_sketch').sketch();

                $(function() {
                  $.each(['#424F5F', '#017B90', '#CAC6C3', '#96BD3C', '#C4D525', '#FFC90B', '#FF8730', '#FA031E', '#A43C3D', '#DA4F6E', '#593C50', '#B88B52', '#FFFFFF', '#000000'], function() {
                    $('.tools').append("<a href='#colors_sketch' data-color='" + this + "' style='width: 30px; background: " + this + ";'></a> ");
                  });
                  $('#colors_sketch').sketch();
                });

                console.log($('button#save'));

                save = function() {
                    var canvas = document.getElementById('colors_sketch');
                    var context = canvas.getContext('2d');

                    var w = canvas.width;
                    var h = canvas.height;

                    context.globalCompositeOperation = "destination-over";
                    context.fillStyle = "rgb(256, 256, 256)";
                    context.fillRect(0, 0, w, h);

                    var dataURL = canvas.toDataURL("image/jpeg");
                    $.post("script.php",
                        {
                            imgBase64: dataURL
                        }
                    ).done(function(o) {
                        console.log('saved');
                    });
                }

                $('button#save').first().click(save);

            })
          </script>

        </div>

    </body>
</html>
