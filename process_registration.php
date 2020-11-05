<?php

// Ari: 5/11/20
// added password hashing. Added error checking for empty fields. Added message to say account registratiom successful.
// added header and footer. Text to access login Modal. Checks if email in valid form.
//TO DO: password confirmation. Make it look less shit. 

?>

<?php
  include 'connection.php'?>

<?php include_once("header.php")?>
<?php  
  
  

  if (isset($_POST['submit'])) { // if submit clicked, assign post variables
	$accountType = mysqli_real_escape_string($connection, $_POST['accountType']);
	$username = mysqli_real_escape_string($connection, $_POST['username']);
    $firstName = mysqli_real_escape_string($connection, $_POST['firstName']);
	$lastName = mysqli_real_escape_string($connection, $_POST['lastName']);
	$email = mysqli_real_escape_string($connection, $_POST['email']);
	
	$password = mysqli_real_escape_string($connection, $_POST['password']);
	$passhash = password_hash($password, PASSWORD_DEFAULT); // hashes password
	
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
		elseif (empty($password)) {
		    echo "Please enter your password";}
 	    elseif (empty($addressLine1)) {
		    echo "Please enter your address";}
	    elseif (empty($city)) {
		    echo "Please enter your city";}
		elseif (empty($country)) {
		    echo "Please enter your country";}
		elseif (empty($postcode)) {
		    echo "Please enter your postcode";}
			
	$email = filter_var ($_POST['email'], FILTER_SANITIZE_EMAIL);
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // checks email in valid form
		echo "$email is not a valid email address.";
	}

	    
  } else { // inserts data from form

      $query = "INSERT INTO users (accountType, username, firstName, lastName, email, password, addressLine1, 
	  addressLine2, city, principality, country, postcode) 
                VALUES ('$accountType', '$username', '$firstName', '$lastName', '$email', '$passhash', '$addressLine1', 
				'$addressLine2', '$city', '$principality', '$country', '$postcode')";
      if (!mysqli_query($connection, $query)) {
        die('Error: ' . mysqli_error($connection));
		      }
		echo 'Your registration was successful, please login!';
}


?>


<div class="text-center">Already have an account? <a href="" data-toggle="modal" data-target="#loginModal">Login</a>
</div>


<?php include_once("footer.php")?>
