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
function OpenCon()
 {
 $host = $_ENV["$host"];
 $user = $_ENV["$user"];
 $password = $_ENV["$password"];
 $db = $_ENV["$db"];
 $conn = new mysqli($host, $user, $password, $db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   
?>

<!-- https://www.cloudways.com/blog/connect-mysql-with-php/#createdatabase -->