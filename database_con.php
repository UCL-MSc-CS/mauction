<?php

$servername = 'localhost';
  $username = 'root';            // Should set up a root password but idk how lol
  $password = '';
  $database = 'mauction';   //change to whatever your db name is

  //tries to create connection:
  $connection = mysqli_connect($servername,$username,$password,$database)
    or die('Error connecting to MySQL server.' . mysql_error());

?>