<?php

require_once "dropbox-sdk/Dropbox/autoload.php";
use \Dropbox as dbx;
$accessToken = "2pmnCeiQIlgAAAAAAAAERHyC0MgB03sTgSCouSyxj2lKwoH27DLkz7PB9ZpzXset";
$dbxClient = new dbx\Client($accessToken, "secret-graffiti");

function pg_connection_string() {
	return "dbname=d2ffcrdlj7m0dp host=ec2-54-197-246-197.compute-1.amazonaws.com port=5432 user=ihtxpbixayjwqp password=lk0N0phG-frjKVxCYIEUi4U-I6 sslmode=require";
}

$db = pg_connect(pg_connection_string());
if (!$db) echo("Couldn't connect to remote database.<br>");

function downloadThumbById($id, $dbxClient, $size) {
	$fileName = "./pics/" . $id . ".jpg";
	if ( ! file_exists($fileName) ) {
		$file = fopen($fileName, "w");
		// $result = $dbxClient->getFile("/" . $id . ".jpg", $file);
		list($meta, $data) = $dbxClient->getThumbnail("/" . $id . ".jpg", "jpeg", $size);
		fwrite($file, $data);
		fclose($file);
	}
}

function saveGraffiti($db, $data64, $dbxClient) {

	$lat = $_POST['lat'];
	$lng = $_POST['lng'];
	$alpha = $_POST['heading'];

	pg_query($db, "INSERT INTO graffiti (lat, lng, alpha) VALUES ($lat, $lng, $alpha);");

	$data64 = str_replace('data:image/jpeg;base64,', '', $data64);
	$data64 = str_replace(' ','+',$data64);
	$data = base64_decode($data64);

	$result = pg_query($db, "SELECT id FROM graffiti ORDER BY id DESC LIMIT 1;");
	$maxId = pg_fetch_result($result, "id");
	// $newId = $maxId + 1;
	$newId = $maxId;

	file_put_contents("./pics/" . $newId . ".jpg", $data);

	$writeMode = \Dropbox\WriteMode::force();

	$result = $dbxClient->uploadFileFromString("/" . $newId . ".jpg", $writeMode, $data);

	// $dbxClient->uploadFile("5.jpg", $writeMode, $file);

	// $result = $dbxClient->uploadFile("5" . ".jpg", dbx\WriteMode::force(), $file);
	// $result = $dbxClient->uploadFileFromString("10", dbx\WriteMode::force(), $data);

	// fclose($file);

	// $folderMetadata = $dbxClient->getMetadataWithChildren("/");

	// $file = fopen("./pics/" . $newId . ".jpg", "rb");
	// $file = fopen("./pics/brick.jpg", "rb");

	// $dbxClient->uploadFile("5.jpg", dbx\WriteMode::force(), $file);
	// $dbxClient->uploadFileFromString("/foo.jpg", $writeMode, "foo.jpg");

	// fclose($file);

	// print_r($folderMetadata);

	// $result =

	// echo($writeMode);

	//
	// $dbxClient->uploadFile($newId . ".jpg", dbx\WriteMode::force(), $data);

	echo($result);
}

$data64 = $_POST['imgBase64'];

if ($data64) {
	// Save the image
	saveGraffiti($db, $data64, $dbxClient);

	// pg_query($db, "SELECT id FROM graffiti ORDER BY id DESC LIMIT 1;");
}

if($_GET['getNearby']) {
	$result = pg_query($db, "SELECT * FROM graffiti;");
	$rows = pg_fetch_all($result);

	foreach ($rows as $row) {
		$id = $row["id"];
		downloadThumbById($id, $dbxClient, "m");
	}

	echo json_encode($rows);
	// echo json_encode("test");
}

// saveGraffiti($db);

if($_GET['getBrick']) {
	downloadThumbById("brick", $dbxClient, "xl");
}
// error_reporting(E_ALL);

// if($_GET['bar']) {
// 	$result = array(
// 		"GET variable bar" => $_GET['bar'],
// 		"PHP Replies" => "Hello from PHP"
// 	);
// 	echo json_encode($result);
// }

// if($_GET['foo']) {
// 	$result = array(
// 		"GET variable Foo" => $_GET['foo'],
// 		"PHP Replies" => "Hello from PHP",
// 		"img" => "me.jpg"
// 	);
// 	echo json_encode($result);
// }

// function pg_connection_string() {
// 	return "dbname=d2ffcrdlj7m0dp host=ec2-54-197-246-197.compute-1.amazonaws.com port=5432 user=ihtxpbixayjwqp password=lk0N0phG-frjKVxCYIEUi4U-I6 sslmode=require";
// }
//
// $db = pg_connect(pg_connection_string());
// if (!$db) echo("Couldn't connect to remote database!<br>");
//
// $create_table = "CREATE TABLE IF NOT EXISTS graffiti (
// 	id bigserial primary key,
// 	lat real NOT NULL,
// 	lng real NOT NULL
// );";
// pg_query($db, $create_table);

// pg_query($db, "INSERT INTO graffiti (lat, lng) VALUES (55, 66);");
// pg_query($db, "UPDATE graffiti SET lng = 77 WHERE id = 2;");
//
// $result = pg_query($db, "SELECT * FROM graffiti;");
// $arr = pg_fetch_all($result);
// print_r($arr);

// $result = pg_query($db, "SELECT table_name FROM information_schema.tables WHERE table_schema = 'public';");
// $arr = pg_fetch_all($result);
// print_r($arr);

// pg_query($db, "ALTER TABLE graffiti DROP COLUMN date_added;");
// $result = pg_query($db, "SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = 'graffiti';");
// $arr = pg_fetch_all($result);
// print_r($arr);

// echo("Hello world.<br>");
