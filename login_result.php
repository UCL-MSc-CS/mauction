<?php 
include 'connection.php';
?>
<?php
include_once('header.php');
?>

<?php

if(isset($_POST['submit'])){
    $loginusername = mysqli_real_escape_string($connection, $_POST['username']);
    $loginpassword = mysqli_real_escape_string($connection, $_POST['password']); 
    $logintype = mysqli_query($connection, "SELECT 'status' FROM users WHERE userName = '$loginusername' AND password = '$loginpassword'") or die('Error...' . mysqli_error());
    $loginaccount_type = mysqli_fetch_array($logintype);

    if($loginusername != '' && $loginpassword != ''){
        
        $loginquery = "SELECT * FROM users WHERE userName = '$loginusername' AND password = '$loginpassword'";
        $loginresult = mysqli_query($connection,$loginquery) or die('Eroor...' . mysqli_error());
        $loginrow = mysqli_fetch_array($loginresult);
        
        if (isset($loginrow)){


            echo('<div class="text-center">You are now logged in! You will be redirected shortly.</div>');
            session_start();
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $loginusername;
            $_SESSION['account_type'] = $loginaccount_type;

        
            // Redirect to browse after 5 seconds. 
            header("refresh:5;url=mylistings.php");
        }
        else{
            echo('<div class="text-center">Wrong combination of username and password. Please try again.</div>');
            session_start();
            $_SESSION['logged_in'] = False;
            
            // Redirect to register page to open the modal for log in after 5 seconds. 
            header("refresh:5;url=register.php");

        }

    }
else{
    echo('<div class="text-center">Please enter your email address and Password to log in</div>');
        session_start();
        $_SESSION['logged_in'] = False;
        // Redirect to register page to open the modal for log in after 5 seconds. 
        header("refresh:5;url=register.php"); ;

    }


    
}


// TODO: Extract $_POST variables, check they're OK, and attempt to login.
// Notify user of success/failure and redirect/give navigation options.

//Matt 01/11: this is going to be a bunch of $variable = $_POST[" "] and if..!isset.. echo: statements

// For now, I will just set session variables and redirect.





?>

<?php
  // Displays either login or logout on the right, depending on user's
  // current status (session).

?>
