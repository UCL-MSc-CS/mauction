<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "mauction";

// Create connection
$connection = mysqli_connect($servername,$username,$password,$database);

if (mysqli_connect_error()) {
    echo"'Failed to connect to MySQL server.'";
    exit();
}
    echo "Connection established!";
?>
