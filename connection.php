<?php

$servername = "localhost";
$username = "root";
$password = "root";
$database = "mauction";

$connection = mysqli_connect($servername,$username,$password,$database) 
    or die('Error connecting to MySQL server.' . mysqli_error());
?>

