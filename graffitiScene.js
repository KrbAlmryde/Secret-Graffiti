// Update location and heading

var loc = {}
var heading = 0
var graffitiArray = []
var initFlag = 0

locationHandler = function(location) {

    loc = location;

    $.getJSON("script.php", { getNearby: 1 })
        .done(function(result) {
            // console.log("done");
            graffitiArray = result;
            // console.info(graffitiArray);
            if (initFlag === 0) {
                initFlag = 1;
                onCreate();
            }
        })

    $("input[name='lat']").val(loc.coords.latitude);
    $("input[name='lng']").val(loc.coords.longitude);

    // console.log(loc.coords.latitude);

    // $("<p>" + loc.coords.latitude + "," + loc.coords.latitude + "," + loc.coords.heading + "</p>").appendTo("body");
}

navigator.geolocation.watchPosition( locationHandler, null, {maximumAge: 0, enableHighAccuracy: true} )

window.addEventListener('deviceorientation', function(e) {
    // heading = event.compassHeading || event.webkitCompassHeading || 0;
    heading = e.webkitCompassHeading;
    $("input[name='heading']").val(heading);
    // $("p#heading").text(heading);
}, false);

// create a WebGL renderer, camera and a scene
var renderer;
var camera;
var scene;
var plane;
var image;
var images; // This is in anticipation for an array of images

var colors = [0xFF0000, 0x00FF00, 0x0000FF, 0x00FFFF, 0xFF0000, 0x00FF00, 0x0000FF, 0x00FFFF, 0x808080];
var radians;

/*******************************************************************************/
/***************************** FUNCTION DEFINITION *****************************/
/*******************************************************************************/

// onCreate();
// onFrame();

function onCreate() {
    /***************************** SETUP SCENE *****************************/
    // Create the scene
    scene = new THREE.Scene();
    // scene.fog = new THREE.FogExp2( 0xffffff, 0.015 )

    /***************************** SETUP CAMERA *****************************/

    scene.rotation.y = 20 * Math.PI / 180;

    camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 1, 1000);

    camera.position.set(0,0,0);
    camera.lookAt(new THREE.Vector3(0,0,1))

    // camera.lookAt(scene.position);
    // camera.lookAt(new THREE.Vector3(0,2,0));
    // camera.lookAt(new THREE.Vector3(0,0,1));
    // console.log(camera.position)
    scene.add(camera);

    // scene.rotation.y = 10 * Math.PI / 180;


    /**************************** SETUP PLANE ****************************/
    // var positions = [{x:0, y:0, z:100},
    //                  {x:100, y:0, z:100},
    //                  {x:-100, y:0, z:100},
    //
    //                  {x:0, y:0, z:0},
    //                  {x:100, y:0, z:0},
    //                  {x:-100, y:0, z:0},
    //
    //                  {x:0, y:0, z:-100},
    //                  {x:100, y:0, z:-100},
    //                  {x:-100, y:0, z:-100}];
    //
    // for (var i = 0; i < 9; i++) {
    //     var aPlane = new THREE.Mesh(new THREE.PlaneGeometry( 100, 100 ),
    //                            new THREE.MeshBasicMaterial(
    //                                 {color: colors[i],
    //                                  side: THREE.DoubleSide} )
    //                            );
    //     aPlane.position.set(
    //                             positions[i].x,
    //                             positions[i].y,
    //                             positions[i].z
    //                         );
    //     aPlane.rotation.x = Math.PI/2; //angles[i];
    //     scene.add( aPlane );
    // }

    /***************************** SETUP IMAGE(S) *****************************/
      // material
      THREE.ImageUtils.crossOrigin = "anonymous";

    //   for (var i = 0; i < 10; i++) {
    //     //   var x = loc.coords.longitude -
    //       var pos = {x: randCoord(), y: 1, z: randCoord()};
    //       var theta = Math.random();
    //       initImage('pic1.jpg', pos, theta );
    //   };

    graffitiArray.forEach(function(graffiti) {
        var pos = {
            x: (loc.coords.longitude - parseFloat(graffiti.lng)) * 10000,
            y: 0,
            z: (loc.coords.latitude - parseFloat(graffiti.lat)) * 10000};
        var theta = Math.random();
        console.log(pos, theta);
        var name = './pics/' + graffiti.id + ".jpg"
        initImage(name, pos, theta );
    })

    /***************************** SETUP PointLight *****************************/
    var pointLight = new THREE.PointLight( 0xFFFFFF );

    // set its position
    pointLight.position.x = 0;
    pointLight.position.y = 100;
    pointLight.position.z = 0;
    scene.add(pointLight);

    /***************************** SETUP RENDERER *****************************/
    // Check whether the browser supports WebGL

    // if(Detector.webgl){
    //     renderer = new THREE.WebGLRenderer({antialias:true});
    //     // alert("In WebGL mode!!");
    // // If its not supported, instantiate the canvas renderer to support all non WebGL browsers
    // } else {
    //     renderer = new THREE.CanvasRenderer();
    //     // alert("In Canvas mode!!");
    // }
    renderer = new THREE.CanvasRenderer();

    // Set the background color of the renderer to black, with full opacity
    renderer.setClearColor(0x000000, 1);

    // start the renderer
    renderer.setSize(window.innerWidth, window.innerHeight);

    // get the DOM element to attach to - assume we've got jQuery to handle this
    var container = $('#container');

    // attach the render-supplied DOM element
    window.addEventListener('keydown', checkKey, false);
    window.addEventListener( 'resize', onWindowResize, false );

    container.append(renderer.domElement);

    $(window).load(renderScene);

    onFrame();
    // onFrame();
}

function onFrame() {
    requestAnimationFrame(onFrame)

    radians = heading * (Math.PI / 180)

    if (! isNaN(radians) ) camera.rotation.y = radians

    var material = new THREE.LineBasicMaterial({
        color: 0x0000ff
    });
    var matb = new THREE.LineBasicMaterial({
        color: 0xff0000
    });
    // Red is x, blue is Z
    var geometry = new THREE.Geometry();
    geometry.vertices.push(new THREE.Vector3(0, -1, 0));
    geometry.vertices.push(new THREE.Vector3(10, -1, 0));
    var line = new THREE.Line(geometry, matb);
    scene.add(line);

    geo = new THREE.Geometry();
    geo.vertices.push(new THREE.Vector3(0, -1, 0));
    geo.vertices.push(new THREE.Vector3(0, -1, 10));
    var lineB = new THREE.Line(geo, material);
    scene.add(lineB);

    renderScene();

    // renderer.render(scene, camera);
}

// function onFrame() {
//     heading = Math.random() * 360;
//     radians = heading * (Math.PI / 180);
//     if (! Number.isNaN(radians) ) camera.rotation.y = radians;
//
//     $("p#heading").text("does this work")
//     // $("p#heading").text(heading);
//     $("p#rotation").text(radians);
//
//     camera.updateProjectionMatrix();
//
//     // window.requestAnimationFrame(onFrame);
//
//     // draw!
//     renderScene();
// }

function renderScene() {
    renderer.render(scene, camera);
}

function randCoord() {
  return Math.floor(Math.random() * (100 - -100 + 1)) + -100;
}

function initImage(fname, pos, theta){
      var material = new THREE.MeshBasicMaterial({
                                map: THREE.ImageUtils.loadTexture(fname),
                                side: THREE.DoubleSide});

      // image
      var img = new THREE.Mesh(new THREE.PlaneGeometry(1, 1), material);
      // img.overdraw = true;
      // img.needsUpdate = true;
      img.position.x = pos.x;
      img.position.y = pos.y;
      img.position.z = pos.z;
      img.rotation.y = theta;
      scene.add(img);

}


function onWindowResize() {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize( window.innerWidth, window.innerHeight );
    renderScene();
}

function checkKey(event) {

    event = event || window.event;

    switch(event.keyCode){
        case 104:
            camera.position.z -= 1;
            console.log("8/camera.position.z: ",camera.position.z);
            // camera.lookAt(camera.position);
            break;
        case 101:
            camera.position.z += 1;
            console.log("5/camera.position.z: ",camera.position.z);
            // camera.lookAt(camera.position);
            break;
        case 100:
            camera.position.x -= 1;
            console.log("4/camera.position.x: ",camera.position.x);
            // camera.lookAt(camera.position);
            break;
        case 102:
            camera.position.x += 1;
            console.log("6/camera.position.x: ",camera.position.x);
            // camera.lookAt(camera.position);
            break;

        case 107:
            camera.position.y -= 1;
            console.log("+/camera.position.y: ",camera.position.y);
            // camera.lookAt(camera.position);
            break;
        case 109:
            camera.position.y += 1;
            console.log("-/camera.position.y: ",camera.position.y);
            // camera.lookAt(camera.position);
            break;

        case 69:
            heading -= 2;
            // console.log("7/camera.rotation.y: ",camera.rotation.y);
            // camera.lookAt(camera.rotation);
            break;

        case 81:
            heading += 2;
            // console.log("9/camera.rotation.y: ",camera.rotation.y);
            // camera.lookAt(camera.rotation);
            break;


        case 97:
            camera.rotation.z += 0.01;
            console.log("0/camera.rotation.z: ",camera.rotation.z);
            // camera.lookAt(camera.rotation);
            break;

        case 99:
            camera.rotation.z -= 0.01;
            console.log("2/camera.rotation.z: ",camera.rotation.z);
            // camera.lookAt(camera.rotation);
            break;

        case 103:
            camera.rotation.y += 0.01;
            console.log("7/camera.rotation.y: ",camera.rotation.y);
            // camera.lookAt(camera.rotation);
            break;

        case 105:
            camera.rotation.y -= 0.01;
            console.log("9/camera.rotation.y: ",camera.rotation.y);
            // camera.lookAt(camera.rotation);
            break;

        case 96:
            camera.rotation.x += 0.01;
            console.log("0/camera.rotation.x: ",camera.rotation.x);
            // camera.lookAt(camera.rotation);
            break;

        case 98:
            camera.rotation.x -= 0.01;
            console.log("2/camera.rotation.x: ",camera.rotation.x);
            // camera.lookAt(camera.rotation);
            break;

        case 82:
            console.log("\nResetting Camera rotation and location");
            camera.position.x = 0;
            camera.position.y = 0;
            camera.position.z = 0;

            camera.rotation.x = 0;
            camera.rotation.y = 0;
            camera.rotation.z = 0;

        case 32:
            console.log("\ncamera.position.x: ",camera.position.x);
            console.log("camera.position.y: ",camera.position.y);
            console.log("camera.position.z: ",camera.position.z);
            console.log("\ncamera.rotation.x: ",camera.rotation.x);
            console.log("camera.rotation.y: ",camera.rotation.y);
            console.log("camera.rotation.z: ",camera.rotation.z);
            console.log("\nscene.position.x: ",scene.position.x);
            console.log("scene.position.z: ",scene.position.z);
            console.log("scene.position.y: ",scene.position.y);
            console.log("\n");
            break;

        default:
            console.log("");
            break;
    }
    console.log("heading: " + heading)
    // camera.lookAt(camera.position);
    // camera.lookAt(camera.rotation);


}
