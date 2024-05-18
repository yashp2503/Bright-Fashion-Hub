<?php

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "u112713895_ecommerce";

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$conn) {
    die("Database Connection  fail!".mysqli_connect_error());
}
else{   
   //echo "connection succesfull<br>";
}
?>