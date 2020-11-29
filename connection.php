<?php

// $dbconfig = parse_ini_file(".env");

// $servername = $dbconfig["host"];
// $username = $dbconfig["user"];
// $password = $dbconfig["password"];
// $database = $dbconfig["db"];

$url = getenv('JAWSDB_URL');
$dbparts = parse_url($url);

$hostname = $dbparts['host'];
$username = $dbparts['user'];
$password = $dbparts['pass'];
$database = ltrim($dbparts['path'],'/');

// Create connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connection was successfully established!";

// $connection = mysqli_connect($servername,$username,$password,$database) 
//     or die('Error connecting to MySQL server.' . mysqli_error());
?>

