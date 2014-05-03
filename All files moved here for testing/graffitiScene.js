// create a WebGL renderer, camera and a scene
var renderer;
var camera;
var scene;
var plane;
var image;
var images; // This is in anticipation for an array of images

onCreate();
onFrame();

function onCreate() {
    /***************************** SETUP SCENE *****************************/
    // Create the scene
    scene = new THREE.Scene();

    /***************************** SETUP CAMERA *****************************/

    camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 0, 1000);
    camera.position.set(0,0,10)
    // camera.rotation.y = -10;
    camera.lookAt(scene.position);
    scene.add(camera);


    /**************************** SETUP PLANE ****************************/
    plane = new THREE.Mesh(new THREE.PlaneGeometry( 500, 500 ),
                           new THREE.MeshBasicMaterial(
                                {color: 0x808080,
                                 side: THREE.DoubleSide} )
                           );
    plane.rotation.x = -1.8;
    scene.add( plane );

    /***************************** SETUP SPHERE *****************************/
    // create the sphere's material
    // var sphereMaterial = new THREE.MeshLambertMaterial( { color: 0xCC0000 } );

    // // set up the sphere vars
    // var radius = 50, segments = 16, rings = 16;

    // // create a new mesh with sphere geometry -
    // // we will cover the sphereMaterial next!
    // var sphere = new THREE.Mesh(new THREE.SphereGeometry(radius, segments, rings),sphereMaterial);
    // sphere.position.x = 0;
    // scene.add(sphere);

    /***************************** SETUP IMAGE(S) *****************************/
      // material
      THREE.ImageUtils.crossOrigin = "anonymous";
      // var material = new THREE.MeshLambertMaterial({
      //   map: THREE.ImageUtils.loadTexture('pic1.jpg'),
      //   side: THREE.DoubleSide
      // });

      // // image
      // image = new THREE.Mesh(new THREE.PlaneGeometry(200, 200), material);
      // // image.overdraw = true;
      // // image.needsUpdate = true;
      // image.position.x = 100;
      // image.position.y = 100;
      // image.rotation.x = 0;
      // scene.add(image);
      for (var i = 0; i < 10; i++) {
          var pos = {x: i*20, y:10, z:i*10};
          var theta = 0;
          initImage('pic1.jpg',pos, theta );
      };

    // var imgTexture = new THREE.ImageUtils.loadTexture("crate.jpg");
    // var imgGeometry = new THREE.PlaneGeometry( 216, 216 );
    // var imgMaterial = new THREE.MeshBasicMaterial( { map: imgTexture, side: THREE.DoubleSide } );
    // var imgMesh = new THREE.Mesh(imgGeometry, imgMaterial);
    // imgMesh.position.x = 50;
    // // img.map.needsUpdate = true; //ADDED
    // scene.add( imgMesh );

    /***************************** SETUP PointLight *****************************/
    var pointLight = new THREE.PointLight( 0xFFFFFF );

    // set its position
    pointLight.position.x = 10;
    pointLight.position.y = 50;
    pointLight.position.z = 130;
    scene.add(pointLight);

    /***************************** SETUP RENDERER *****************************/
    // Check whether the browser supports WebGL
    if(Detector.webgl){
        renderer = new THREE.WebGLRenderer({antialias:true});
    // If its not supported, instantiate the canvas renderer to support all non WebGL browsers
    } else {
        renderer = new THREE.CanvasRenderer();
    }

    // Set the background color of the renderer to black, with full opacity
    renderer.setClearColor(0x000000, 1);

    // start the renderer
    renderer.setSize(window.innerWidth, window.innerHeight);

    // get the DOM element to attach to - assume we've got jQuery to handle this
    var container = $('#container');

    // attach the render-supplied DOM element
    // container.keydown(checkKey);
    window.addEventListener('keydown', checkKey, false);

    container.append(renderer.domElement);

    $(window).load(renderScene);
}

function initImage(fname, pos, theta){
      var material = new THREE.MeshLambertMaterial({
                        map: THREE.ImageUtils.loadTexture(fname),
                        side: THREE.DoubleSide
                    });

      // image
      var img = new THREE.Mesh(new THREE.PlaneGeometry(20, 20), material);
      // img.overdraw = true;
      // img.needsUpdate = true;
      img.position.x = pos.x;
      img.position.y = pos.y;
      img.rotation.x = theta;
      scene.add(img);

}

function onFrame() {

    // plane.rotation.x += 0.01;
    // image.rotation.x += 0.01;
    // // plane.rotation.z += 0.02;
    // console.log("camera.rotation.z: ", camera.rotation.z);
    // console.log("\tcamera.rotation.x: ", camera.rotation.x);
    // console.log("\t\tcamera.rotation.y: ", camera.rotation.y);
    // camera.rotation.y += 0.01;
    camera.updateProjectionMatrix();
    // if (camera.position.z > 1000 || camera.position.z < 0)
    //     moveForward = !moveForward;

    // if (maveForward) {
    //     camera.position.z += 1;
    // } else{
    //     camera.position.z -= 1;
    // };

    requestAnimationFrame(onFrame);
    // draw!
    renderScene();
}

function renderScene() {
    renderer.render(scene, camera);
}


function checkKey(e) {

    e = e || window.event;

    if (e.keyCode == '104') {
        console.log("8/camera.position.z: ",camera.position.z);
        camera.position.z += 1;
    }
    else if (e.keyCode == '101') {
        console.log("5/camera.position.z: ",camera.position.z);
        camera.position.z -= 1;
    }
    else if (e.keyCode == '100') {
        console.log("4/camera.position.x: ",camera.position.x);
        camera.position.x -= 1;
    }
    else if (e.keyCode == '102') {
        console.log("6/camera.position.x: ",camera.position.x);
        camera.position.x += 1;
    }

    else if (e.keyCode == '107') {
        console.log("+/camera.position.y: ",camera.position.y);
        camera.position.y += 1;
    }
    else if (e.keyCode == '109') {
        console.log("-/camera.position.y: ",camera.position.y);
        camera.position.y -= 1;
    }






    else if (e.keyCode == '97') {
        console.log("0/camera.rotation.z: ",camera.rotation.z);
        camera.rotation.z -= 0.01;
    }
    else if (e.keyCode == '99') {
        console.log("2/camera.rotation.z: ",camera.rotation.z);
        camera.rotation.z += 0.01;
    }

    else if (e.keyCode == '103') {
        console.log("7/camera.rotation.y: ",camera.rotation.y);
        camera.rotation.y -= 0.01;
    }
    else if (e.keyCode == '105') {
        console.log("9/camera.rotation.y: ",camera.rotation.y);
        camera.rotation.y += 0.01;
    }
    else if (e.keyCode == '96') {
        console.log("0/camera.rotation.x: ",camera.rotation.x);
        camera.rotation.x -= 0.01;
    }
    else if (e.keyCode == '98') {
        console.log("2/camera.rotation.x: ",camera.rotation.x);
        camera.rotation.x += 0.01;
    }

    else if (e.keyCode == '32') {
        console.log("\ncamera.position.y: ",camera.position.y);
        console.log("camera.position.x: ",camera.position.x);
        console.log("camera.position.z: ",camera.position.z);
        console.log("camera.rotation.y: ",camera.rotation.y);
        console.log("camera.rotation.x: ",camera.rotation.x);
        console.log("camera.rotation.z: ",camera.rotation.z);
        console.log("\n");

    }

}