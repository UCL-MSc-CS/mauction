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
$servername = 'localhost';
$username = 'root';
$password = 'root';
$database = 'mauction';
// Create connection
$connection = mysqli_connect($servername,$username,$password,$database) 
    or die('Error connecting to MySQL server.' . mysql_error());
?>

<!-- https://www.cloudways.com/blog/connect-mysql-with-php/#createdatabase -->