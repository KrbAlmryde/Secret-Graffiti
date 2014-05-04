<!doctype html>
<html>
    <head>
        <title>Secret Graffiti</title>
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <!-- importing three.js and Detector.js libraries -->
        <script src="../js/three.min.js"></script>
        <script src="../js/Detector.js"></script>

    </head>
    <body>
        <h1>Secret Graffiti</h1>
        <div id="container"></div>
        <a href="./draw.php"><button>Draw</button></a>

        <script>
            loc = {}
            heading = {}
            setLocation = function(location) {
                loc = location;
                console.log(loc);
                $("<p>" + loc.coords.latitude + "," + loc.coords.latitude + "," + loc.coords.heading + "</p>").appendTo("body");
            }
            navigator.geolocation.watchPosition( setLocation, null, {maximumAge: 0, enableHighAccuracy: true} )

        window.addEventListener('deviceorientation', function(event) {
            heading = event.compassHeading || event.webkitCompassHeading || 0;
            $("<p>" + heading + "</p>").appendTo("body");
        }, false);

        </script>

        <!-- Running tut1.js code! -->
        <script src="./graffitiScene.js"></script>
    </body>


</html>

