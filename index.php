<?php

function pg_connection_string() {
    return "dbname=d2ffcrdlj7m0dp host=ec2-54-197-246-197.compute-1.amazonaws.com port=5432 user=ihtxpbixayjwqp password=lk0N0phG-frjKVxCYIEUi4U-I6 sslmode=require";
}

$db = pg_connect(pg_connection_string());
if (!$db) {
    echo("Database connection error.");
}

echo ini_get('display_errors');

echo("hello world.\n");
echo("Hi, I'm Paul");
