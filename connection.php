<?php

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$host = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$database = substr($url["path"], 1);

$connection = mysqli_connect($host,$username,$password,$database) 
    or die('Error connecting to MySQL server.' . mysqli_error());

?>