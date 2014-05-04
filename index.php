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
            loc = {}
            setLocation = function(location) {
                loc = location;
                console.log(loc);
                $("<p>" + loc.coords.latitude + "," + loc.coords.latitude + "," + loc.coords.heading + "</p>").appendTo("body");
            }
            navigator.geolocation.watchPosition(setLocation)
        </script>
    </body>
</html>
