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
$db = 'mauction';
// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);
// Check connection
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}
?>

<!-- https://www.cloudways.com/blog/connect-mysql-with-php/#createdatabase -->