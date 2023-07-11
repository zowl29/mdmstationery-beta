<?php

$serverName = "localhost";
$dbUsername = "root";
$dbPssword = "";
$dbName = "mdmstationery_db";

$conn = mysqli_connect($serverName, $dbUsername, $dbPssword, $dbName);

//if connection failed
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}