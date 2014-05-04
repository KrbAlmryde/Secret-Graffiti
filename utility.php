<?php

// Just a utility file to make sure everything's cool

require_once "dropbox-sdk/Dropbox/autoload.php";
// require_once "script.php";
// use \Dropbox as dbx;

// $accessToken = "2pmnCeiQIlgAAAAAAAAERHyC0MgB03sTgSCouSyxj2lKwoH27DLkz7PB9ZpzXset";

// $dbxClient = new dbx\Client($accessToken, "secret-graffiti");
// $accountInfo = $dbxClient->getAccountInfo();
// print_r($accountInfo);

// $appInfo = dbx\AppInfo::loadFromJsonFile("dropbox-app.json");

function pg_connection_string() {
	return "dbname=d2ffcrdlj7m0dp host=ec2-54-197-246-197.compute-1.amazonaws.com port=5432 user=ihtxpbixayjwqp password=lk0N0phG-frjKVxCYIEUi4U-I6 sslmode=require";
}

$db = pg_connect(pg_connection_string());
if (!$db) echo("Couldn't connect to remote database.<br>");

pg_query($db, "ALTER TABLE graffiti ADD COLUMN alpha real;");
pg_query($db, "UPDATE graffiti SET alpha = 193.76 WHERE id = 1;");
pg_query($db, "UPDATE graffiti SET alpha = 34.6 WHERE id = 2;");
pg_query($db, "UPDATE graffiti SET lat = 54 WHERE id = 1;");

$result = pg_query($db, "SELECT * FROM graffiti");
$rows = pg_fetch_all($result);
$num_fields = array_fill(0, pg_num_fields($result), '0');

// print_r($num_fields);
//
// print_r($rows);

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

echo("<table><thead><tr>");
foreach ($num_fields as $key => $value) {
	echo( "<th>" . pg_field_name($result, $key) . "</th>" );
}
echo("<th>thumbnail</th>");
echo("</tr></thead>");
echo("<tbody>");
foreach ($rows as $row) {
	$id = $row["id"];
	echo("<tr>");
	foreach ($row as $field) {
		echo("<td>" . $field . "</td>");
	}
	downloadThumbById($id, $dbxClient, "m");
	echo("<td><img src='pics/" . $id . ".jpg' /></td>");
	echo("</tr>");
}
echo("</tbody>");
echo("</table>");

// $file = fopen("./pics/me.jpg", "rb");
// var_dump($file);
//
// $result = $dbxClient->uploadFile("/test.jpg", dbx\WriteMode::force(), $file);
//
// fclose($file);
// print_r($result);
//
// $folderMetadata = $dbxClient->getMetadataWithChildren("/");
// print_r($folderMetadata);

// function saveFile($name) {
//
// }

// echo("savetest");
// $file = fopen("./pics/savetest.jpg", "w");
// $dbxClient->getFile("/test.jpg", $file);
// fclose($file);
//
// if($_GET['saveTest']) {
// 	echo("savetest");
// 	$file = fopen("./pics/savetest.jpg", "w");
// 	$dbxClient->getFile("/test.jpg", $file);
// 	fclose($file);
// }
//
// if($_GET['getBrick']) {
// 	echo("getBrick");
// 	$file = fopen("./pics/brick.jpg", "w");
// 	$dbxClient->getFile("/brick.jpg", $file);
// 	fclose($file);
// 	// echo("<img src='./pics/brick.jpg' />");
// }
//
// if($_GET['writeBrick']) {
// 	echo("writeBrick");
// 	$file = fopen("./pics/brick.jpg", "rb");
// 	$dbxClient->uploadFile("/brick.jpg", dbx\WriteMode::force(), $file);
// }
//
// if($_GET['upload']) {
// 	echo("upload");
// 	$file = fopen("./pics/1.jpg", "rb");
// 	$dbxClient->uploadFile("/1.jpg", dbx\WriteMode::force(), $file);
// 	fclose($file);
// 	$file = fopen("./pics/2.jpg", "rb");
// 	$dbxClient->uploadFile("/2.jpg", dbx\WriteMode::force(), $file);
// 	fclose($file);
// }

//
// echo ($dbxClient->appendFilePath( "foo/", string $path )

// echo("<img src='./pics/me.jpg'>");
