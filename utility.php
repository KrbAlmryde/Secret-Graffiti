<?php

// Just a utility file to make sure everything's cool

require_once "dropbox-sdk/Dropbox/autoload.php";
use \Dropbox as dbx;

$accessToken = "2pmnCeiQIlgAAAAAAAAERHyC0MgB03sTgSCouSyxj2lKwoH27DLkz7PB9ZpzXset";

$dbxClient = new dbx\Client($accessToken, "secret-graffiti");
// $accountInfo = $dbxClient->getAccountInfo();
// print_r($accountInfo);

// $appInfo = dbx\AppInfo::loadFromJsonFile("dropbox-app.json");

function pg_connection_string() {
	return "dbname=d2ffcrdlj7m0dp host=ec2-54-197-246-197.compute-1.amazonaws.com port=5432 user=ihtxpbixayjwqp password=lk0N0phG-frjKVxCYIEUi4U-I6 sslmode=require";
}

$db = pg_connect(pg_connection_string());
if (!$db) echo("Couldn't connect to remote database.<br>");

$result = pg_query($db, "SELECT * FROM graffiti");
$rows = pg_fetch_all($result);

print_r($rows);

echo("<table>");

// foreach ($rows as $row) {
//
// }
echo("</table>");

echo("Utility foob");

// $file = fopen("./pics/me.jpg", "rb");
// var_dump($file);
//
// $result = $dbxClient->uploadFile("/test.jpg", dbx\WriteMode::force(), $file);
//
// fclose($file);
// print_r($result);
//
$folderMetadata = $dbxClient->getMetadataWithChildren("/");
print_r($folderMetadata);

function saveFile($name) {

}

if($_GET['saveTest']) {
	echo("savetest");
	$file = fopen("./pics/savetest.jpg", "w");
	$dbxClient->getFile("/test.jpg", $file);
	fclose($file);
}

if($_GET['getBrick']) {
	echo("getBrick");
	$file = fopen("./pics/brick.jpg", "w");
	$dbxClient->getFile("/brick.jpg", $file);
	fclose($file);
	// echo("<img src='./pics/brick.jpg' />");
}

if($_GET['writeBrick']) {
	echo("writeBrick");
	$file = fopen("./pics/brick.jpg", "rb");
	$dbxClient->uploadFile("/brick.jpg", dbx\WriteMode::force(), $file);
}

//
// echo ($dbxClient->appendFilePath( "foo/", string $path )

// echo("<img src='./pics/me.jpg'>");
