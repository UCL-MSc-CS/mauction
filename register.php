<!-- // Ari 31/10/20: modified form and submit button. Added connection (change to Caroline's function)
// This version only works with modified database tables
// TO DO: add additional fields. Conceal password.  -->

<?php include 'connection.php'; ?>

<?php include_once("header.php")?>

<div class="container">
<div style="max-width: 800px; margin: 10px auto">
<h2 class="my-3">Register new account</h2>

<form method="POST" action="process_registration.php">
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
	<label for="password" class="col-sm-2 col-form-label text-right">password</label>
		<div class="col-sm-10">
		<input type="text" class="form-control" id="password" name="password" placeholder="Enter Your password"/>
	<small id="passwordHelp" name="password" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
	</div>
</div>
<div class="form-group row">
	<input id="show-btn" type="submit" name="submit" class="btn btn-primary form-control" value="Register"/>
</div>
</form>

<div class="text-center">Already have an account? <a href="" data-toggle="modal" data-target="#loginModal">Login</a>

</div>
<?php include_once("footer.php")?>