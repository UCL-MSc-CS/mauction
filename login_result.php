<?php include 'connection.php'; ?>
<?php include ("header.php") ?>

<?php

if (isset($_POST['submit'])) {
  $loginusername = mysqli_real_escape_string($connection, $_POST['username']);
  $loginpassword = mysqli_real_escape_string($connection, $_POST['password']);
  $loginstatuscheck = "SELECT accountType FROM User WHERE userName = '$loginusername' AND password = SHA('$loginpassword')";
  $logintype = mysqli_query($connection, $loginstatuscheck) or die('Error...' . mysqli_error());
  $loginaccount_type = mysqli_fetch_array($logintype);

  if ($loginusername != '' && $loginpassword != '') {

    $loginquery = "SELECT * FROM User WHERE userName = '$loginusername' AND password = SHA('$loginpassword')";
    $loginresult = mysqli_query($connection, $loginquery) or die('Error...' . mysqli_error());
    $loginrow = mysqli_fetch_array($loginresult);
    $loginstatus = $loginaccount_type['accountType'];
    if (isset($loginrow)) {
      echo ('<div class="text-center">You are now logged in!</div>');
      $_SESSION['account_type'] = $loginstatus;
    } else {
      echo ('<div class="text-center">Wrong combination of username and password. Please try again.</div>');
      header("refresh:5;url=register.php");
    }
  } else {
    echo ('<div class="text-center">Please enter your username and password to log in</div>');
    header("refresh:5;url=register.php");
  }
}
?>