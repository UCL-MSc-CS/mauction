<?php

// $url = getenv('JAWSDB_URL');
$url = "mysql://ws494eubbq802b0a:wsizews6ods2yal4@x40p5pp7n9rowyv6.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/y3gvomlvkviknzgs";
$dbparts = parse_url($url);

$hostname = $dbparts['host'];
$username = $dbparts['user'];
$password = $dbparts['password'];
$database = ltrim($dbparts['path'],'/');

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// 


// $servername = "localhost";
// $username = "root";
// $password = "root";
// $database = "mauction";

// // Create connection
// $connection = mysqli_connect($servername,$username,$password,$database) 
//     or die('Error connecting to MySQL server.' . mysqli_error());
// ?>
