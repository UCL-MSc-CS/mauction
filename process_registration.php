<?php
include 'connection.php';
?>
<?php

// TODO: Extract $_POST variables, check they're OK, and attempt to create
// an account. Notify user of success/failure and redirect/give navigation 
// options.
if (isset($_POST['submit'])) {
	$username = mysqli_real_escape_string($connection, $_POST['username']);
    $firstName = mysqli_real_escape_string($connection, $_POST['firstName']);
	$lastName = mysqli_real_escape_string($connection, $_POST['lastName']);
	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$password = mysqli_real_escape_string($connection, $_POST['password']);

	// if (!isset($username) || $username == '' || !isset($firstName) || $firstName == '' 
		// || !isset($lastName) || $lastName == '' || !isset($email) || $email == '' || !isset($password) || $password == '') {
	// $error = "Please fill in your name and a message";
	// header("Location: test.php?error=" . urlencode($error));
	// exit();
     // }
	    // }
     // else {

      $query = "INSERT INTO users (username, firstName, lastName, email, password) 
                VALUES ('$username', '$firstName', '$lastName', '$email', '$password')";
      if (!mysqli_query($connection, $query)) {
        die('Error: ' . mysqli_error($connection));
		      }
			  
	// else {
	// header('Location: test.php');
	// exit();
// }
 }

?>