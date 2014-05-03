<?php

// Just a utility file to make sure everything's cool

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
echo("</table>")
