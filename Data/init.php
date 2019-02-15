<?php
error_reporting(E_ALL);
ini_set("display_errors", "1");
$dbhost = "http://mrober23.istwebclass.org";
$database = "mrober23_michaels";
$username = "testuser";
$password = "testpassword";

$pdoOptions = array(
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);