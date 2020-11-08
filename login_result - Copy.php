<?php 
include 'connection.php';
?>
<?php
include 'header.php';
?>

<?php
if(isset($_POST['submit'])){
    // $username = mysqli_real_escape_string($connection, $_POST['username']); // Why does it always say undefined index....AHHHHHHH
    // $password = mysqli_real_escape_string($connection, $_POST['password']); // Why does it always say undefined index....AHHHHHHH
    $username = $_POST['username'];
    $password = $_POST['password'];
    if($username != '' && $password != ''){
        
        $query = "SELECT * FROM users WHERE userName = '$username' AND password = '$password'";
        $result = mysqli_query($connection,$query) or die('Eroor...' . mysqli_error());
        $row = mysqli_fetch_array($result);
        
        if (isset($row)){
            // $um = mysqli_query($connection, "SELECT 'username' FROM users WHERE username = '$username' AND password = '$password'") or die('Error' . mysqli_error);
            // $accounttype = mysqli_query($connection, "SELECT 'accounttype' FROM users WHERE username = '$username' AND password = '$password'")

            echo('<div class="text-center">You are now logged in! You will be redirected shortly.</div>');
            
            session_start();
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['account_type'] = "buyer";
        
            // Redirect to browse after 5 seconds. 
            header("refresh:5;url=browse.php");
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
