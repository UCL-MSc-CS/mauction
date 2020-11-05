<?php 
include 'connection.php';
?>
<?php
include 'header.php';
?>

<?php
if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($connection, $_POST['username']); // Why does it always say undefined index....AHHHHHHH
    $password = mysqli_real_escape_string($connection, $_POST['password']); // Why does it always say undefined index....AHHHHHHH
    
    if($username != '' && $password != ''){
        
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($connection,$query) or die('Eroor...' . mysqli_error());
        $row = mysqli_fetch_array($result);
        
        if (isset($row)){
            $um = mysqli_query($connection, "SELECT 'username' FROM users WHERE username = '$username' AND password = '$password'") or die('Error' . mysqli_error);
            // $accounttype = mysqli_query($connection, "SELECT 'accounttype' FROM users WHERE email = '$email' AND password = '$password'")
            session_start();
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $um;
            $_SESSION['account_type'] = "buyer";
            echo('<div class="text-center">You are now logged in! You will be redirected shortly.</div>');
            // Redirect to index after 5 seconds. 
            header("refresh:5;url=browse.php");
        }
        else{
            echo'Wrong combination of Email address and password.';
        }

    }
else{
    echo 'Please enter your email address and Password to log in';
    }


    
}
// TODO: Extract $_POST variables, check they're OK, and attempt to login.
// Notify user of success/failure and redirect/give navigation options.

//Matt 01/11: this is going to be a bunch of $variable = $_POST[" "] and if..!isset.. echo: statements

// For now, I will just set session variables and redirect.





?>
