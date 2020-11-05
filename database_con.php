// connects to database
// change to Carolines function

<?php

$servername = 'localhost';
  $username = 'root';            
  $password = '';
  $database = 'mauction';   

  //tries to create connection:
  $connection = mysqli_connect($servername,$username,$password,$database)
    or die('Error connecting to MySQL server.' . mysql_error());

?>
