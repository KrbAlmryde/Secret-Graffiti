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
        <div id="container"></div>
        <form action="./draw.php" method="post">
            <input name="lat" type="hidden" value="null">
            <input name="lng" type="hidden" value="null">
            <input name="heading" type="hidden" value="null">
            <input type="submit" value="Draw">
        </form>

        <script src="./graffitiScene.js"></script>
    </body>


</html>
