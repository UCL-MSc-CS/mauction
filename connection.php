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
$db = $_ENV["$db"];
// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);
// Check connection
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>

<!-- https://www.cloudways.com/blog/connect-mysql-with-php/#createdatabase -->