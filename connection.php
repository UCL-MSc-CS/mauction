<!-- $link = mysqli_init();
$success = mysqli_real_connect(
   $link,
   $host,
   $user,
   $password,
   $db,
   $port
); -->

<?php
$servername = $_ENV["$host"];
$username = $_ENV["$user"];
$password = $_ENV["$password"];
$database = $_ENV["$db"];

// Create connection
$connection = mysqli_connect($servername,$username,$password,$database) 
    or die('Error connecting to MySQL server.' . mysql_error());
?>

<!-- https://www.cloudways.com/blog/connect-mysql-with-php/#createdatabase -->