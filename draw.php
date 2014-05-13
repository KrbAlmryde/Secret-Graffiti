<!doctype html>
<html>
    <head>
        <title>Secret Graffiti</title>
        <script src="http://code.jquery.com/jquery-latest.js"></script>

        <script src="js/sketch.js"></script>
        <link type="text/css" rel="stylesheet" href="draw.css" />
		<link type="text/css" rel="stylesheet" href="mmenu/jquery.mmenu.css" />
		<script type="text/javascript" src="mmenu/jquery.mmenu.js"></script>
		<script type="text/javascript">
			$(function() {
				$('nav#menu').mmenu();
			});
		</script>
        <style type='text/css'>
            html, body {
                overflow: hidden;
				height:100%;
				width:100%;
            }

            simple_sketch {
                background: #04B4AE;
            }
            #canvas {
                display: block;
            }

			#menu-list a {
				border:1px solid #E0E0E0;
				margin-left:6px;
				margin-right:0px;
				margin-top:6px;
				height: 50px;
				line-height: 50px;
				padding: 0px 10px;
				vertical-align: middle;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				color: black;
				color:#555555;
				font-family:arial;
				font-size:15px;
				font-weight:bold;
				font-style:normal;
			}



    </style>


    </head>
    <body>
		<div style="height:100% width:100%">
			<div id="header" style="overflow: auto">

				<button class="saveButton"id="save" onclick="save" style="float:right">Save</button>
				<a href="#menu"></a>


			</div>
			<nav id="menu">
				<ul id="menu-list">
					<a href="#colors_sketch" data-tool="eraser" class="saveButton" style="margin-left:125px; background:#FFFFFF; width:54px ">Eraser</a>
					<a href="#colors_sketch" data-tool="marker" class="saveButton" style="margin-left:15px; background: #FFFFFF; width:54px">Pen</a>
					<p>
					<a href='#colors_sketch' data-color='#FFFFFF' style='width: 30px; background:#FFFFFF;'></a>
					<a href='#colors_sketch' data-color='#FBC701' style='width: 30px; background:#FBC701;'></a>
					<a href='#colors_sketch' data-color='#F99F00' style='width: 30px; background:#F99F00;'></a>
					<a href='#colors_sketch' data-color='#D98000' style='width: 30px; background:#D98000;'></a>
					<a href='#colors_sketch' data-color='#F88601' style='width: 30px; background:#F88601;'></a>
					<a href='#colors_sketch' data-color='#F43101' style='width: 30px; background:#F43101;'></a>
					<a href='#colors_sketch' data-color='#EC0500' style='width: 30px; background:#EC0500;'></a>


					<a href='#colors_sketch' data-color='#F6D4AF' style='width: 30px; background:#F6D4AF;'></a>
					<a href='#colors_sketch' data-color='#FB9D91' style='width: 30px; background:#FB9D91;'></a>
					<a href='#colors_sketch' data-color='#F96887' style='width: 30px; background:#F96887;'></a>
					<a href='#colors_sketch' data-color='#F51877' style='width: 30px; background:#F51877;'></a>
					<a href='#colors_sketch' data-color='#DB0B6B' style='width: 30px; background:#DB0B6B;'></a>
					<a href='#colors_sketch' data-color='#C78DDA' style='width: 30px; background:#C78DDA;'></a>
					<a href='#colors_sketch' data-color='#710237' style='width: 30px; background:#710237;'></a>


					<a href='#colors_sketch' data-color='#185700' style='width: 30px; background:#185700;'></a>

					<a href='#colors_sketch' data-color='#2B826F' style='width: 30px; background:#2B826F;'></a>
					<a href='#colors_sketch' data-color='#259525' style='width: 30px; background:#259525;'></a>
					<a href='#colors_sketch' data-color='#75DF9D' style='width: 30px; background:#75DF9D;'></a>
					<a href='#colors_sketch' data-color='#011F53' style='width: 30px; background:#011F53;'></a>

					<a href='#colors_sketch' data-color='#37034B' style='width: 30px; background:#37034B;'></a>
					<a href='#colors_sketch' data-color='#289173' style='width: 30px; background:#289173;'></a>
					<a href='#colors_sketch' data-color='#A7E7D7' style='width: 30px; background:#A7E7D7;'></a>
					<a href='#colors_sketch' data-color='#6BC4E6' style='width: 30px; background:#6BC4E6;'></a>
					<a href='#colors_sketch' data-color='#2A8ECC' style='width: 30px; background:#2A8ECC;'></a>
					<a href='#colors_sketch' data-color='#2267A8' style='width: 30px; background:#2267A8;'></a>

					<a href='#colors_sketch' data-color='#011A81' style='width: 30px; background:#011A81;'></a>
					<a href='#colors_sketch' data-color='#000000' style='width: 30px; background:#000000;'></a>
					</p>
					<p>
					<a href='#colors_sketch' data-size='5' style='width: 30px; background:#FFFFFF;'>5</a>
					<a href='#colors_sketch' data-size='10' style='width: 30px; background:#FFFFFF;'>10</a>
					<a href='#colors_sketch' data-size='15' style='width: 30px; background:#FFFFFF;'>15</a>
					<a href='#colors_sketch' data-size='20' style='width: 30px; background:#FFFFFF;'>20</a>
					<a href='#colors_sketch' data-size='25' style='width: 30px; background:#FFFFFF;'>25</a>
					<a href='#colors_sketch' data-size='30' style='width: 30px; background:#FFFFFF;'>30</a>
					<a href='#colors_sketch' data-size='35' style='width: 30px; background:#FFFFFF;'>35</a>
					<a href='#colors_sketch' data-size='40' style='width: 30px; background:#FFFFFF;'>40</a>
					<a href='#colors_sketch' data-size='45' style='width: 30px; background:#FFFFFF;'>45</a>

					</p>


				</ul>
			</nav>

		<!--
        <div class='tools'>
            <button id="save" onclick="save" style="float: right; width: 100px; height:50px">Save</button>
         </div>
		-->
        <div style="display: none;" data-lat="<?php echo $_POST['lat'] ?>" data-lng="<?php echo $_POST['lng'] ?>" data-heading="<?php echo $_POST['heading'] ?>" ></div>
        <div class='demo'>
<!--           <canvas id='colors_sketch' width='auto' height='auto' style="background: url(./pics/brick.jpg) no-repeat center center;"></canvas> -->
		  <script type='text/javascript'>

            // Write the brick.jpg file
            $.get("script.php?getBrick=1").done(function() {
                // $("<img src='./pics/brick.jpg' id='brick' />").appendTo("body");
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
                            imgBase64: dataURL,
                            lat: <?php echo $_POST['lat'] ? $_POST['lat'] : 0 ?>,
                            lng: <?php echo $_POST['lng'] ? $_POST['lng'] : 0 ?>,
                            heading: <?php echo $_POST['heading'] ? $_POST['heading'] : 0 ?>
                        }
                    ).done(function(o) {
                        console.log('saved');
                        console.info(o);
                        window.location.assign("index.php");
                    });
                }

                $('button#save').first().click(save);

            })
          </script>

        </div>
		</div>

    </body>
</html>
