<?php
include 'connection.php';
?>

<?php include_once("header.php")?>

<div class="container my-5">

<?php
	
// This function takes the form data from place_bid.php and adds it to the database.
            
if (isset($_POST['submit'])) {
            $bidAmount = mysqli_real_escape_string($connection, $_POST['bidAmount']);
            $bidTime = date("Y-m-d H:i:s")
	          //$userID = mysqli_query($connection, "SELECT 'userID' FROM users WHERE userName = '$loginusername' ") or die('Error...' . mysqli_error());
            
            
            if (empty($bidAmount)) {
                        echo "Please provide an auction title";}  //Matt 01/11: this checks that something is in bidAmount
	

            else {
                        echo '<div class="text-center">Auction successfully created! <a href="FIXME">View your new listing.</a></div>';
                        $query = "INSERT INTO bids (bidAmount, bidTime) VALUES('$bidAmount','$bidTime')"; 
		        if (!mysqli_query($connection, $query)) {die('Error: ' . mysqli_error($connection));}
            } }
?>

</div>

<?php include_once("footer.php") ?>
