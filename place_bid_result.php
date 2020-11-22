<?php
include 'connection.php';
?>

<?php include_once("header.php")?>

<div class="container my-5">

<?php
	
// This function takes the form data from place_bid.php and adds it to the database.
// Still need to get it to submit the userName. 
            
if (isset($_POST['submit'])) {
            $bidAmount = mysqli_real_escape_string($connection, $_POST['bidAmount']);
            // $bidTime = date("Y-m-d H:i:s");
	          //$userID = mysqli_query($connection, "SELECT 'userID' FROM users WHERE userName = '$loginusername' ") or die('Error...' . mysqli_error());
            $item_id = $_GET['item_id'];
            $userName = $_SESSION['username'];
            

            if (empty($bidAmount)) {
                        echo "Please provide a bid amount";
                    }  //Matt 01/11: this checks that something is in bidAmount
            $query = "SELECT MAX(bidAmount) FROM bid WHERE saleItemID = '$item_id' ";
            $max_bid = mysqli_query($connection,$query) or die('Error making maxBid query' . mysqli_error($connection));
            $queryResult = mysqli_num_rows($max_bid);
            if ($bidAmount <= $queryResult) {
                echo "Please enter an amount above the current leading bid";}
            else {
                        echo '<div class="text-center">Bid placed successfully! <a href=index.php>Back to browse.</a></div>';
                        $query = "INSERT INTO bid (userName, saleItemID, bidAmount) VALUES('$userName','$item_id','$bidAmount')"; 
		        if (!mysqli_query($connection, $query)) {
				die('Error: ' . mysqli_error($connection));}
            } }
?>

</div>

<?php include_once("footer.php") ?>
