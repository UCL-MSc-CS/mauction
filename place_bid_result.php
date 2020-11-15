<?php
include 'connection.php';
?>

<?php include_once("header.php")?>

<div class="container my-5">

<?php
	
// This function takes the form data from place_bid.php and adds it to the database.
// Still need to work out ways to get the saleItemID and userID. 
            
if (isset($_POST['submit'])) {
            $bidAmount = mysqli_real_escape_string($connection, $_POST['bidAmount']);
            $bidTime = date("Y-m-d H:i:s");
	          //$userID = mysqli_query($connection, "SELECT 'userID' FROM users WHERE userName = '$loginusername' ") or die('Error...' . mysqli_error());
            
            
            if (empty($bidAmount)) {
                        echo "Please provide a bid amount";}  //Matt 01/11: this checks that something is in bidAmount

            else {
                        echo '<div class="text-center">Bid placed successfully! <a href=index.php>Back to browse.</a></div>';
                        $query = "INSERT INTO bid (bidAmount, bidTime) VALUES('$bidAmount','$bidTime')"; 
		        if (!mysqli_query($connection, $query)) {
				die('Error: ' . mysqli_error($connection));}
            } }
?>

</div>

<?php include_once("footer.php") ?>
