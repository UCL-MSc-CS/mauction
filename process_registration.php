<?php

// Ari: 5/11/20
// added password hashing. Added error checking for empty fields. Added message to say account registratiom successful.
// added header and footer. Text to access login Modal. Checks password against password confirmation.
// only enters password into database, not necessary to enter password confirmation.

?>
<?php include 'connection.php'?>
<?php include_once("header.php")?>

<div class="text-center">

<?php  
  
  
  if (isset($_POST['submit'])) { // if submit clicked, assign post variables
	$accountType = mysqli_real_escape_string($connection, $_POST['accountType']);
	$username = mysqli_real_escape_string($connection, $_POST['username']);
    $firstName = mysqli_real_escape_string($connection, $_POST['firstName']);
	$lastName = mysqli_real_escape_string($connection, $_POST['lastName']);
	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$email = filter_var ($_POST['email'], FILTER_SANITIZE_EMAIL);
	
	$password = mysqli_real_escape_string($connection, $_POST['password']);
	$confirmpassword = mysqli_real_escape_string($connection, $_POST['confirmpassword']);
	
	$addressLine1 = mysqli_real_escape_string($connection, $_POST['addressLine1']);
	$addressLine2 = mysqli_real_escape_string($connection, $_POST['addressLine2']);
	$city = mysqli_real_escape_string($connection, $_POST['city']);
	$principality = mysqli_real_escape_string($connection, $_POST['principality']);
	$country = mysqli_real_escape_string($connection, $_POST['country']);
	$postcode = mysqli_real_escape_string($connection, $_POST['postcode']);
	
	    if (empty($username)) {  // checks if fields are empty
            echo "Please enter a username";} 
	    elseif (empty($firstName)) {
		    echo "Please enter your first name";}
 	    elseif (empty($lastName)) {
		    echo "Please enter your last name";}
	    elseif (empty($email)) {
		    echo "Please enter your email address";}
			elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // checks email in valid form
			echo "$email is not a valid email address."; }	
		elseif (empty($password)) {
		    echo "Please enter your password";}
		elseif (empty($confirmpassword)) {
		    echo "Please confirm your password";}
			elseif ($password != $confirmpassword) {	// confirms password and password confirmation match
		echo "Passwords do not match!"; }
 	    elseif (empty($addressLine1)) {
		    echo "Please enter your address";}
	    elseif (empty($city)) {
		    echo "Please enter your city";}
		elseif (empty($country)) {
		    echo "Please enter your country";}
		elseif (empty($postcode)) {
		    echo "Please enter your postcode";}
			
	    
   else { // inserts data from form
   
      $query = "INSERT INTO users (accountType, username, firstName, lastName, email, password, addressLine1, 
	  addressLine2, city, principality, country, postcode) 
                VALUES ('$accountType', '$username', '$firstName', '$lastName', '$email', SHA('$password'), '$addressLine1', 
				'$addressLine2', '$city', '$principality', '$country', '$postcode')";
      if (!mysqli_query($connection, $query)) {
   die('Error: ' . mysqli_error($connection)); }
	else {
		echo '<div class="text-center">Your registration was successful! Please <a href="" data-toggle="modal" data-target="#loginModal">Login</a></div>';
   }}
  }
?>

</div>
<?php include_once("footer.php")?>