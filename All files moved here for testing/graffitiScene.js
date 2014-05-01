// create a WebGL renderer, camera and a scene
var renderer; 
var camera;
var scene;
var plane;

onCreate();
onFrame();

function onCreate() {
    /***************************** SETUP SCENE *****************************/
    // Create the scene
    scene = new THREE.Scene();

    /***************************** SETUP CAMERA *****************************/

    camera = new THREE.PerspectiveCamera(  45, window.innerWidth / window.innerHeight, 1, 10000 );
    camera.position.set(0,0,1000)
    // camera.lookAt(scene.position);
    scene.add(camera);


    /**************************** SETUP PLANE ****************************/
    plane = new THREE.Mesh(new THREE.PlaneGeometry( 1000, 1000 ),
                           new THREE.MeshBasicMaterial( 
                                {color: 0x808080, 
                                 side: THREE.DoubleSide} )
                           );
    plane.rotation.x = -1;
    scene.add( plane );

    /***************************** SETUP SPHERE *****************************/
    // create the sphere's material
    var sphereMaterial = new THREE.MeshLambertMaterial( { color: 0xCC0000 } );

    // set up the sphere vars
    var radius = 50, segments = 16, rings = 16;

    // create a new mesh with sphere geometry -
    // we will cover the sphereMaterial next!
    var sphere = new THREE.Mesh(new THREE.SphereGeometry(radius, segments, rings),sphereMaterial);
    sphere.position.x = 0;
    scene.add(sphere);

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
    container.keydown(checkKey);
    container.append(renderer.domElement);

    renderScene();
}


function onFrame() {

    // plane.rotation.x += 0.01;
    // plane.rotation.z += 0.01;
    camera.rotation.z += 0.01;
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

    if (e.keyCode == '38') {
        console.log("pushed up arrow");
    }
    else if (e.keyCode == '40') {
        console.log("pushed down arrow");
    }
    else if (e.keyCode == '37') {
        console.log("pushed left arrow");
    }
    else if (e.keyCode == '39') {
        console.log("pushed right arrow");
    }
}

// var camera;
// var scene;
// var renderer;
// var mesh;
 
// init();
// animate();
 
// function init() {
 
//     scene = new THREE.Scene();
//     camera = new THREE.PerspectiveCamera( 70, window.innerWidth / window.innerHeight, 1, 1000);
 
//     var light = new THREE.DirectionalLight( 0xffffff );
//     light.position.set( 0, 1, 1 ).normalize();
//     scene.add(light);
 
//     var geometry = new THREE.CubeGeometry( 10, 10, 10);
//     var material = new THREE.MeshPhongMaterial( { ambient: 0x050505, color: 0x0033ff, specular: 0x555555, shininess: 30 } );
 
//     mesh = new THREE.Mesh(geometry, material );
//     mesh.position.z = -50;
//     scene.add( mesh );
 
//     renderer = new THREE.WebGLRenderer();
//     renderer.setSize( window.innerWidth, window.innerHeight );
//     document.body.appendChild( renderer.domElement );
 
//     window.addEventListener( 'resize', onWindowResize, false );
 
//     render();
// }
 
// function animate() {
//     mesh.rotation.x += .04;
//     mesh.rotation.y += .02;
 
//     render();
//     requestAnimationFrame( animate );
// }
 
// function render() {
//     renderer.render( scene, camera );
// }
 
// function onWindowResize() {
//     camera.aspect = window.innerWidth / window.innerHeight;
//     camera.updateProjectionMatrix();
//     renderer.setSize( window.innerWidth, window.innerHeight );
//     render();
// }