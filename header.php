<?php
session_start();
?>

<div class="modal fade" id="loginModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Login</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="login_result.php">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name = "username" class="form-control" id="username" placeholder="username">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name= "password" class="form-control" id="password" placeholder="Password">
          </div>
          <button type="submit" name = "submit" class="btn btn-primary form-control">Sign In</button>
        </form>
        <div class="text-center">or <a href="register.php">Create an Account</a></div>
      </div>
    </div>
  </div>
</div> 

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/custom.css">
  <title>mAuction</title>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light mx-2">
  <h3 class="my-3"><a class="navbar-brand" href="browse.php">mAuction</a></h3>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">

<?php

if(isset($_POST['submit'])){
    $loginusername = mysqli_real_escape_string($connection, $_POST['username']);
    $loginpassword = mysqli_real_escape_string($connection, $_POST['password']); 
    $loginstatuscheck = "SELECT accountType FROM User WHERE userName = '$loginusername' AND password = SHA('$loginpassword')";
    $logintype = mysqli_query($connection, $loginstatuscheck) or die('Error...' . mysqli_error());
    $loginaccount_type = mysqli_fetch_array($logintype);
    $loginstatus = $loginaccount_type['accountType'];

    if($loginusername != '' && $loginpassword != ''){
        
        $loginquery = "SELECT * FROM User WHERE userName = '$loginusername' AND password = SHA('$loginpassword')";
        $loginresult = mysqli_query($connection,$loginquery) or die('Error...' . mysqli_error());
        $loginrow = mysqli_fetch_array($loginresult);
        
        if (isset($loginrow)){
          $loginuser = $loginrow['userName'];
          $_SESSION['logged_in'] = true;
          $_SESSION['username'] = $loginuser;
          $_SESSION['account_type'] = $loginstatus;
        }  
    }
    
}

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    echo '<a class="nav-link" href="logout.php">Logout</a>';
}
else {
  echo '<button type="button" class="btn nav-link" data-toggle="modal" data-target="#loginModal">Login</button>';
}

?>

    </li>
  </ul>
</nav>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <ul class="navbar-nav align-middle">
	<li class="nav-item mx-1">
      <a class="nav-link" href="browse.php">Browse</a>
    </li>

<?php
if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'buyer') {
  echo('
	<li class="nav-item mx-1">
      <a class="nav-link" href="mybids.php">My Bids</a>
    </li>
	<li class="nav-item mx-1">
      <a class="nav-link" href="recommendations.php">Recommended</a>
    </li>
    <li class="nav-item mx-1">
      <a class="nav-link" href="watchlist.php">Watchlist</a>
    </li>');
  }
  if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'seller') {
  echo('
	<li class="nav-item mx-1">
      <a class="nav-link" href="mylistings.php">My Listings</a>
    </li>
	<li class="nav-item ml-3">
      <a class="nav-link btn border-light" href="create_auction.php">+ Create auction</a>
    </li>');
  }
?>
  </ul>
</nav>