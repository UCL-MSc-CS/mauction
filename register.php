<?php include 'connection.php'; ?>
<?php include_once("header.php") ?>
<?php
// https://www.w3schools.com/php/php_form_required.asp (reference)
$usernameError = "";
$firstNameError = "";
$lastNameError = "";
$emailError = "";
$passwordError = "";
$confirmpasswordError = "";
$addressLine1Error = "";
$cityError = "";
$countryError = "";
$postcodeError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["userName"])) {
		$usernameError = ": Username is required";
	}
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["firstName"])) {
		$firstNameError = ": First name is required";
	}
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["lastName"])) {
		$lastNameError = ": Last name is required";
	}
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["email"])) {
		$emailError = ": Email is required";
	}
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["password"])) {
		$passwordError = ": Password is required";
	}
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["confirmpassword"])) {
		$confirmpasswordError = ": Password confirmation is required";
	}
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["addressLine1"])) {
		$addressLine1Error = ": Address Line 1 is required";
	}
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["city"])) {
		$cityError = ": City is required";
	}
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["country"])) {
		$countryError = ": Country is required";
	}
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["postcode"])) {
		$postcodeError = ": Postcode is required";
	}
}
?>
<div class="container">
	<div style="max-width: 1000px; margin: 10px auto">
		<h2 class="my-3">Register New Account</h2>
		<div class="card">
			<div class="card-body">

				<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<div class="form-group row">
						<label for="accountType" class="col-sm-2 col-form-label text-right">Registering as a:</label>
						<div class="col-sm-10">
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="accountType" id="accountBuyer" value="buyer" checked>
								<label class="form-check-label" for="accountBuyer">Buyer</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="accountType" id="accountSeller" value="seller">
								<label class="form-check-label" for="accountSeller">Seller</label>
							</div>
							<small id="accountTypeHelp" class="form-text-inline text-muted"><span class="text-danger">* Required.</span></small>
						</div>
					</div>
					<div class="form-group row">
						<label for="userName" class="col-sm-2 col-form-label text-right">Username</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="userName" name="userName" placeholder="Enter Your username" />
							<small id="usernameHelp" name="userName" class="form-text text-muted"></small>
							<span class="text-danger">*Required<?php echo $usernameError; ?></span>
						</div>
					</div>
					<div class="form-group row">
						<label for="firstName" class="col-sm-2 col-form-label text-right">First Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter Your First Name" />
							<small id="firstNameHelp" name="firstName" class="form-text text-muted"></small>
							<span class="text-danger">* Required<?php echo $firstNameError; ?></span>
						</div>
					</div>
					<div class="form-group row">
						<label for="lastName" class="col-sm-2 col-form-label text-right">Last Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter Your Last Name" />
							<small id="lastNameHelp" name="lastName" class="form-text text-muted"></small>
							<span class="text-danger">* Required<?php echo $lastNameError; ?></span>
						</div>
					</div>
					<div class="form-group row">
						<label for="email" class="col-sm-2 col-form-label text-right">Email</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="email" name="email" placeholder="Enter Your email" />
							<small id="emailHelp" name="email" class="form-text text-muted"></small>
							<span class="text-danger">* Required<?php echo $emailError; ?></span>
						</div>
					</div>
					<div class="form-group row">
						<label for="password" class="col-sm-2 col-form-label text-right">Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" id="password" name="password" placeholder="Enter Your password" />
							<small id="passwordHelp" name="password" class="form-text text-muted"></small>
							<span class="text-danger">* Required<?php echo $passwordError; ?></span>
						</div>
					</div>
					<div class="form-group row">
						<label for="confirmpassword" class="col-sm-2 col-form-label text-right">Confirm Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Your password" />
							<small id="confirmpasswordHelp" name="confirmpassword" class="form-text text-muted"></small>
							<span class="text-danger">* Required<?php echo $confirmpasswordError; ?></span>
						</div>
					</div>
					<div class="form-group row">
						<label for="addressLine1" class="col-sm-2 col-form-label text-right">Address Line 1</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="addressLine1" name="addressLine1" placeholder="Enter Your Address" />
							<small id="addressLine1dHelp" name="addressLine1" class="form-text text-muted"></small>
							<span class="text-danger">* Required<?php echo $addressLine1Error; ?></span>
						</div>
					</div>
					<div class="form-group row">
						<label for="addressLine2" class="col-sm-2 col-form-label text-right">Address Line 2</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="password" name="addressLine2" placeholder="Address Line 2" />
							<small id="addressLine2Help" name="addressLine2" class="form-text text-muted"></small>
						</div>
					</div>
					<div class="form-group row">
						<label for="city" class="col-sm-2 col-form-label text-right">City</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="city" name="city" placeholder="City" />
							<small id="cityHelp" name="city" class="form-text text-muted"></small>
							<span class="text-danger">* Required<?php echo $cityError; ?></span>
						</div>
					</div>
					<div class="form-group row">
						<label for="principality" class="col-sm-2 col-form-label text-right">Principality</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="principality" name="principality" placeholder="Enter Your principality" />
							<small id="principalityHelp" name="principality" class="form-text text-muted"></small>
						</div>
					</div>
					<div class="form-group row">
						<label for="country" class="col-sm-2 col-form-label text-right">Country</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="country" name="country" placeholder="Enter Your country" />
							<small id="countryHelp" name="country" class="form-text text-muted"></small>
							<span class="text-danger">* Required<?php echo $countryError; ?></span>
						</div>
					</div>
					<div class="form-group row">
						<label for="postcode" class="col-sm-2 col-form-label text-right">Postcode</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="postcode" name="postcode" placeholder="Enter Your postcode" />
							<small id="postcodeHelp" name="postcode" class="form-text text-muted"></small>
							<span class="text-danger">* Required<?php echo $postcodeError; ?></span>
						</div>
					</div>

					<div class="form-group row">
						<input id="show-btn" type="submit" name="submit" class="btn btn-primary form-control" value="Register" />
					</div>
				</form>
			</div>
			<?php
			if (isset($_POST['submit'])) {
				$accountType = mysqli_real_escape_string($connection, $_POST['accountType']);
				$userName = mysqli_real_escape_string($connection, $_POST['userName']);
				$firstName = mysqli_real_escape_string($connection, $_POST['firstName']);
				$lastName = mysqli_real_escape_string($connection, $_POST['lastName']);
				$email = mysqli_real_escape_string($connection, $_POST['email']);
				$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
				$password = mysqli_real_escape_string($connection, $_POST['password']);
				$confirmpassword = mysqli_real_escape_string($connection, $_POST['confirmpassword']);
				$addressLine1 = mysqli_real_escape_string($connection, $_POST['addressLine1']);
				$addressLine2 = mysqli_real_escape_string($connection, $_POST['addressLine2']);
				$city = mysqli_real_escape_string($connection, $_POST['city']);
				$principality = mysqli_real_escape_string($connection, $_POST['principality']);
				$country = mysqli_real_escape_string($connection, $_POST['country']);
				$postcode = mysqli_real_escape_string($connection, $_POST['postcode']);


				$query = "SELECT userName FROM User WHERE userName='$userName'";
				$result = mysqli_query($connection, $query) or die('Error making select users query' . mysqli_error($connection));
				if (mysqli_num_rows($result) != 0) {
					die("Sorry, this username is already taken, please try again");
				}


				if ($_POST['password'] !== $_POST['confirmpassword']) {
					die("Passwords do not match! Please try again.");
				}
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					echo "' $email ' is not a valid email address. Please try again.";
				} else {

					$query = "INSERT INTO User (userName, email, firstName, lastName, country, principality, city, addressLine1, 
	  addressLine2, postcode, password, accountType) 
                VALUES ('$userName', '$email', '$firstName', '$lastName', '$country', '$principality', '$city', '$addressLine1', '$addressLine2', '$postcode', SHA('$password'), '$accountType')";
					if (!mysqli_query($connection, $query)) {
						die('Error: Error making insert user query' . mysqli_error($connection));
					} else {
						echo "<script type='text/javascript'> window.location = 'process_registration.php'; </script>";
					}
				}
			}
			?>
			<?php include_once("footer.php") ?>