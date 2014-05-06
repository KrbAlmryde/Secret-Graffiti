// Update location and heading

var loc = {}
var heading = 10
setLocation = function(location) {
    loc = location;
    console.log(loc);
    // $("<p>" + loc.coords.latitude + "," + loc.coords.latitude + "," + loc.coords.heading + "</p>").appendTo("body");
}
navigator.geolocation.watchPosition( setLocation, null, {maximumAge: 0, enableHighAccuracy: true} )

window.addEventListener('deviceorientation', function(event) {
    // heading = event.compassHeading || event.webkitCompassHeading || 0;
    heading = event.webkitCompassHeading;
    // $("p#heading").text(heading);
}, false);

window.addEventListener('deviceorientation', function(event) {
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


onCreate();
onFrame();


/*******************************************************************************/
/***************************** FUNCTION DEFINITION *****************************/
/*******************************************************************************/

function onCreate() {
    /***************************** SETUP SCENE *****************************/
    // Create the scene
    scene = new THREE.Scene();
    // scene.fog = new THREE.FogExp2( 0xffffff, 0.015 )

    /***************************** SETUP CAMERA *****************************/

    camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 1, 1000);
    camera.lat = Math.random();
    camera.lng = Math.random();
    camera.position.set(0,2,0);
    // camera.lookAt(scene.position);
    // camera.lookAt(new THREE.Vector3(0,2,0));
    // camera.lookAt(new THREE.Vector3(0,0,1));
    // console.log(camera.position)
    scene.add(camera);


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

      for (var i = 0; i < 10; i++) {
          var pos = {x: randCoord(), y:1, z:randCoord()};
          var theta = Math.random();
          initImage('pic1.jpg',pos, theta );
      };

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
    // window.addEventListener('keydown', checkKey, false);
    // window.addEventListener( 'resize', onWindowResize, false );

    container.append(renderer.domElement);

    $(window).load(renderScene);
}

function onFrame() {

    radians = heading * (Math.PI / 180);
    if (! Number.isNaN(radians) ) camera.rotation.y = radians;

    $("p#heading").text(heading);
    $("p#rotation").text(radians);

    camera.updateProjectionMatrix();

    requestAnimationFrame(onFrame);

    // draw!
    renderScene();
}

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
      var img = new THREE.Mesh(new THREE.PlaneGeometry(20, 20), material);
      // img.overdraw = true;
      // img.needsUpdate = true;
      img.position.x = pos.x;
      img.position.y = 10;
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
    // camera.lookAt(camera.position);
    // camera.lookAt(camera.rotation);


}
