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
 $host = $_ENV["$host"];
 $user = $_ENV["$user"];
 $password = $_ENV["$password"];
 $db = $_ENV["$db"];

$connection = mysqli_connect($host,$user,$password,$db)or die('Error connecting to MySQL server.' . mysql_error());
?>
