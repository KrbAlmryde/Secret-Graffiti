<?php

require_once "dropbox-sdk/Dropbox/autoload.php";
use \Dropbox as dbx;

$accessToken = "2pmnCeiQIlgAAAAAAAAERHyC0MgB03sTgSCouSyxj2lKwoH27DLkz7PB9ZpzXset";

$dbxClient = new dbx\Client($accessToken, "secret-graffiti");

if($_GET['getBrick']) {
	echo("getBrick");
	$file = fopen("./pics/brick.jpg", "w");
	$dbxClient->getFile("/brick.jpg", $file);
	fclose($file);
	// echo("<img src='./pics/brick.jpg' />");
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
