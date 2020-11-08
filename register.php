<?php // Added additional fields
// TODO: add password confirmation. Make it look better?!
?>

<?php include 'connection.php'; ?>

<?php include_once("header.php")?>


<div class="container">
<div style="max-width: 900px; margin: 10px auto">
<h2 class="my-3">Register new account</h2>
  <div class="card">
    <div class="card-body">
	
<form method="POST" action="process_registration.php">
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
	<label for="username" class="col-sm-2 col-form-label text-right">Username</label>
		<div class="col-sm-10">
		<input type="text" class="form-control" id="username" name="username" placeholder="Enter Your username"/>
	<small id="usernameHelp" name="username" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
	</div>
</div>
<div class="form-group row">
	<label for="firstName" class="col-sm-2 col-form-label text-right">First Name</label>
		<div class="col-sm-10">
		<input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter Your First Name"/>
	<small id="firstNameHelp" name="firstName" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
	</div>
</div>
<div class="form-group row">
	<label for="lastName" class="col-sm-2 col-form-label text-right">Last Name</label>
		<div class="col-sm-10">
		<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter Your Last Name"/>
	<small id="lastNameHelp" name="lastName" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
	</div>
</div>
<div class="form-group row">
	<label for="email" class="col-sm-2 col-form-label text-right">Email</label>
		<div class="col-sm-10">
		<input type="text" class="form-control" id="email" name="email" placeholder="Enter Your email"/>
	<small id="emailHelp" name="email" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
	</div>
</div>
<div class="form-group row">
	<label for="password" class="col-sm-2 col-form-label text-right">Password</label>
		<div class="col-sm-10">
		<input type="password" class="form-control" id="password" name="password" placeholder="Enter Your password"/>
	<small id="passwordHelp" name="password" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
	</div>
</div>
<div class="form-group row">
	<label for="confirmpassword" class="col-sm-2 col-form-label text-right">Confirm Password</label>
		<div class="col-sm-10">
		<input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Your password"/>
	<small id="confirmpasswordHelp" name="confirmpassword" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
	</div>
</div>
<div class="form-group row">
	<label for="addressLine1" class="col-sm-2 col-form-label text-right">Address Line 1</label>
		<div class="col-sm-10">
		<input type="text" class="form-control" id="addressLine1" name="addressLine1" placeholder="Enter Your Address"/>
	<small id="addressLine1dHelp" name="addressLine1" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
	</div>
</div>
<div class="form-group row">
	<label for="addressLine2" class="col-sm-2 col-form-label text-right">Address Line 2</label>
		<div class="col-sm-10">
		<input type="text" class="form-control" id="password" name="addressLine2" placeholder="Address Line 2"/>
	<small id="addressLine2Help" name="addressLine2" class="form-text text-muted"></small>
	</div>
</div>
<div class="form-group row">
	<label for="city" class="col-sm-2 col-form-label text-right">City</label>
		<div class="col-sm-10">
		<input type="text" class="form-control" id="city" name="city" placeholder="City"/>
	<small id="cityHelp" name="city" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
	</div>
</div>
<div class="form-group row">
	<label for="principality" class="col-sm-2 col-form-label text-right">Principality</label>
		<div class="col-sm-10">
		<input type="text" class="form-control" id="principality" name="principality" placeholder="Enter Your principality"/>
	<small id="principalityHelp" name="principality" class="form-text text-muted"></small>
	</div>
</div>
<div class="form-group row">
	<label for="country" class="col-sm-2 col-form-label text-right">Country</label>
		<div class="col-sm-10">
		<input type="text" class="form-control" id="country" name="country" placeholder="Enter Your country"/>
	<small id="countryHelp" name="country" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
	</div>
</div>
<div class="form-group row">
	<label for="postcode" class="col-sm-2 col-form-label text-right">Postcode</label>
		<div class="col-sm-10">
		<input type="text" class="form-control" id="postcode" name="postcode" placeholder="Enter Your postcode"/>
	<small id="postcodeHelp" name="postcode" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
	</div>
</div>
<div class="form-group row">
	<input id="show-btn" type="submit" name="submit" class="btn btn-primary form-control" value="Register"/>
</div>
</form>

<div class="text-center">Already have an account? <a href="" data-toggle="modal" data-target="#loginModal">Login</a>

  
</div>

<?php include_once("footer.php")?>