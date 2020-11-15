<?php 
include 'connection.php';
?>
<?php
include 'header.php';
?>

<?php

if(isset($_POST['submit'])){
  $loginusername = mysqli_real_escape_string($connection, $_POST['username']);
  $loginpassword = mysqli_real_escape_string($connection, $_POST['password']); 
  $loginstatuscheck = "SELECT status FROM users WHERE userName = '$loginusername' AND password = '$loginpassword'";
  $logintype = mysqli_query($connection, $loginstatuscheck) or die('Error...' . mysqli_error());
  $loginaccount_type = mysqli_fetch_array($logintype);

  if($loginusername != '' && $loginpassword != ''){
      
      $loginquery = "SELECT * FROM users WHERE userName = '$loginusername' AND password = '$loginpassword'";
      $loginresult = mysqli_query($connection,$loginquery) or die('Error...' . mysqli_error());
      $loginrow = mysqli_fetch_array($loginresult);
      $loginstatus = $loginaccount_type['status'];
      if (isset($loginrow)){       
        echo('<div class="text-center">You are now logged in!</div>');
        $_SESSION['account_type'] = $loginstatus;
        if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'buyer') {
          echo('
          <li class="nav-item mx-1">
              <a class="nav-link" href="mybids.php">My Bids</a>
            </li>
          <li class="nav-item mx-1">
              <a class="nav-link" href="recommendations.php">Recommended</a>
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
      }

      else{
        echo('<div class="text-center">Wrong combination of username and password. Please try again.</div>');
        header("refresh:5;url=register.php");
      }

  }
else{
  echo('<div class="text-center">Please enter your email address and password to log in</div>');
  header("refresh:5;url=register.php");
  }


  
}
?>