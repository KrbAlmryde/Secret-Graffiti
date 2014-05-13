<!doctype html>
<html>
    <head>
        <title>Secret Graffiti</title>
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <!-- importing three.js and Detector.js libraries -->
        <script src="js/three.min.js"></script>
        <script src="js/Detector.js"></script>

    </head>
    <body>
        <!-- <h1>Secret Graffiti</h1>
        <p id="heading">heading goes here</p>
        <p id="rotation">rotation goes here</p>
        <p id="camera">camera goes here</p> -->
        <p id="lat"></p><p id="lng"></p>
        <p id="x"></p><p id="y"></p>
        <div id="container"></div>
        <form action="./draw.php" method="post">
            <input name="lat" type="hidden" value="null">
            <input name="lng" type="hidden" value="null">
            <input name="heading" type="hidden" value="null">
            <input type="submit" value="Draw">
        </form>

        <script>

            // loc = {}
            // heading = {}
            // setLocation = function(location) {
            //     loc = location;
            //     console.log(loc);
            //     // $("<p>" + loc.coords.latitude + "," + loc.coords.latitude + "," + loc.coords.heading + "</p>").appendTo("body");
            // }
            // navigator.geolocation.watchPosition( setLocation, null, {maximumAge: 0, enableHighAccuracy: true} )
            //
            // window.addEventListener('deviceorientation', function(event) {
            //     heading = event.compassHeading || event.webkitCompassHeading || 0;
            //     $("p#heading").text(heading);
            // }, false);

            // var loc = {}
            // var heading = 0
            // var graffitiArray = []
            //
            // locationHandler = function(location) {
            //
            //     $.post("script.php", { getNearby: 1 })
            //         .done(function(result) {
            //             graffitiArray = result;
            //         })
            //
            //     loc = location;
            //     // console.log(loc.coords.latitude);
            //     $("input[name='lat']").val(loc.coords.latitude);
            //     $("input[name='lng']").val(loc.coords.longitude);
            //     // $("<p>" + loc.coords.latitude + "," + loc.coords.latitude + "," + loc.coords.heading + "</p>").appendTo("body");
            // }
            // navigator.geolocation.watchPosition( locationHandler, null, {maximumAge: 0, enableHighAccuracy: true} )
            //
            // window.addEventListener('deviceorientation', function(e) {
            //     // heading = event.compassHeading || event.webkitCompassHeading || 0;
            //     heading = e.webkitCompassHeading;
            //     $("input[name='heading']").val(heading);
            //     // heading = 20
            //     // $("p#heading").text(heading);
            // }, false);

        </script>

        <script src="./graffitiScene.js"></script>
    </body>


</html>
