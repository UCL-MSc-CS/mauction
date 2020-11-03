<?php

// Ari: Added post variables and insert query for additional fields. Added password hashing. 
// TODO: error messages still not quite right. Add password confirmation to compare to original password entered

?>

<?php
  include 'connection.php'?>

<?php include_once("header.php")?>
<?php  
  
  

  if (isset($_POST['submit'])) {
	$accountType = mysqli_real_escape_string($connection, $_POST['accountType']);
	$username = mysqli_real_escape_string($connection, $_POST['username']);
    $firstName = mysqli_real_escape_string($connection, $_POST['firstName']);
	$lastName = mysqli_real_escape_string($connection, $_POST['lastName']);
	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$password = mysqli_real_escape_string($connection, $_POST['password']);
	
	$passhash = password_hash($password, PASSWORD_DEFAULT);
	
	$addressLine1 = mysqli_real_escape_string($connection, $_POST['addressLine1']);
	$addressLine2 = mysqli_real_escape_string($connection, $_POST['addressLine2']);
	$city = mysqli_real_escape_string($connection, $_POST['city']);
	$principality = mysqli_real_escape_string($connection, $_POST['principality']);
	$country = mysqli_real_escape_string($connection, $_POST['country']);
	$postcode = mysqli_real_escape_string($connection, $_POST['postcode']);

	
	// if ($username == '' || $firstName == '' || $lastName == '' || $email == '' || $password == '') {
	// $error = "You have left one of the fields empty!";
	// echo $error;
	// header("Location: index.php?error=" . urlencode($error));
	// exit();
     // }
	    
     // else {

      $query = "INSERT INTO users (accountType, username, firstName, lastName, email, password, addressLine1, 
	  addressLine2, city, principality, country, postcode) 
                VALUES ('$accountType', '$username', '$firstName', '$lastName', '$email', '$passhash', '$addressLine1', 
				'$addressLine2', '$city', '$principality', '$country', '$postcode')";
      if (!mysqli_query($connection, $query)) {
        die('Error: ' . mysqli_error($connection));
		      }
	 }
  	 
	else {
	header('Location: index.php');
	exit();
}
 
?>
<?php include_once("footer.php")?>
