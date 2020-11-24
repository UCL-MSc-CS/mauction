<?php

// $dbconfig = parse_ini_file(".env");

// $servername = $dbconfig["host"];
// $username = $dbconfig["user"];
// $password = $dbconfig["password"];
// $database = $dbconfig["db"];

$servername = "localhost";
$username = "root";
$password = "root";
$database = "mauction";

// Create connection
$connection = mysqli_connect($servername,$username,$password,$database) 
    or die('Error connecting to MySQL server.' . mysqli_error());
?>

