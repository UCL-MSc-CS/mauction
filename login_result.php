<?php

// TODO: Extract $_POST variables, check they're OK, and attempt to login.
// Notify user of success/failure and redirect/give navigation options.

//Matt 01/11: this is going to be a bunch of $variable = $_POST[" "] and if..!isset.. echo: statements

// For now, I will just set session variables and redirect.

session_start();
$_SESSION['logged_in'] = true;
$_SESSION['username'] = "test";
$_SESSION['account_type'] = "buyer";

echo('<div class="text-center">You are now logged in! You will be redirected shortly.</div>');

// Redirect to index after 5 seconds. //Matt 01/11: the index is currently just the homepage. 
header("refresh:5;url=index.php");

?>
