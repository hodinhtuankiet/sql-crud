<?php
include_once("./helper.php");
db_connect();
$sql = "delete from todos where todoid = :todoid";
$params = [
    'todoid' => input_value("todoid")
];

if (db_execute($sql, $params)) {

    header("location: /index.php");
}
db_disconnect();
