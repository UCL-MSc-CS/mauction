<?php
include 'connection.php';
include 'create_auction.php';                   
?>

<?php include_once("header.php")?>

<div class="container my-5">

<?php

// This function takes the form data and adds the new auction to the database.

/* TODO #1: Connect to MySQL database (perhaps by requiring a file that
            already does this). */
//Matt 01/11: this is done by the include connection statement that caroline made at the top


/* TODO #2: Extract form data into variables. Because the form was a 'post'
            form, its data can be accessed via $POST['auctionTitle'], 
            $POST['auctionDetails'], etc. Perform checking on the data to
            make sure it can be inserted into the database. If there is an
            issue, give some semi-helpful feedback to user. */

// $auctionTitle = $_POST['auctionTitle'];
// $startPrice = $_POST['auctionStartPrice];
            
if (!isset($_POST['auctionTitle'])) {
            echo "HOW WERE YOU GOING TO CREATE AN AUCTION WITHOUT AN AUCTION TITLE smh";}  //Matt 01/11: this checks that something is in auctionTitle
          
if (!is_numeric($_POST['auctionStartPrice'])) {
            echo "Wrong input format for auction starting price. Please input a number.";}  //Why is this not appearing as the right colour? 

/* TODO #3: If everything looks good, make the appropriate call to insert
            data into the database.  If all is successful, let user know. */

else {
            echo '<div class="text-center">Auction successfully created! <a href="FIXME">View your new listing.</a></div>';}

$query = "INSERT INTO auctions (itemName, startPrice) VALUES('$auctionTitle','$startPrice'); 



?>

</div>


<?php include_once "footer.php" ?>
