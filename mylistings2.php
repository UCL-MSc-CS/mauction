<?php include_once("header.php")?>
<?php 
include 'connection.php';
?>

<?php require("utilities.php")?>

<div class="container">

<h2 class="my-3">My listings</h2>

<?php
  // This page is for showing a user the auction listings they've made.
  // It will be pretty similar to browse.php, except there is no search bar.
  // This can be started after browse.php is working with a database.
  // Feel free to extract out useful functions from browse.php and put them in
  // the shared "utilities.php" where they can be shared by multiple files.
    // $listusername = mysqli_real_escape_string($connection, $_POST['username']);
    // $listpassword = mysqli_real_escape_string($connection, $_POST['password']);
	
	
	// this is only to show how to adjust the query to make it pull the right data
	// query needs to include things from the bids table
	// add in SELECT MAX(bidAmount), COUNT(bidID) FROM bids
	// add auctions.item_id= '1' and bids.item_id= '1' -- this is hardcoded just now but 
	// needs to change to bring up all of them but I don't know how for this page!
	// change to      $listcurrent_price = $listrow['MAX(bidAmount)'];
    // change to		$listnum_bids = $listrow['COUNT(bidID)']; 
	// In utilities:
	// need to update the timings lines 47-57 (use Ari's, I can't remember exactly what I changed)
	// also your database may need to only have a single endDate column as DATETIME type, rather than split into 2, but we can look at this on Sunday :) :) :)
	
	
    $listingquery = "SELECT MAX(bidAmount), COUNT(bidID), auction.*
	  FROM auction, bid WHERE auction.saleItemID= '1' and bid.saleItemID= '1' ORDER BY itemName ASC"; // need to add WHERE userID IN (SELECT userID WHERE userName = '$listusername' AND password = '$listpassword'FROM users)
    $listresult = mysqli_query($connection, $listingquery) or die('Error selecting user query' . mysqli_error());
    $listqueryRes = mysqli_num_rows($listresult);
    while ($listrow = mysqli_fetch_assoc($listresult)) {
      $listitem_id = $listrow['saleItemID'];
      $listtitle = $listrow['itemName'];
      $listdescription = $listrow['description'];
      $listcurrent_price = $listrow['MAX(bidAmount)'];
      $listnum_bids = $listrow['COUNT(bidID)']; 
      $listend_date = $listrow['endDate'];
    }
    print_listing_li($listitem_id, $listtitle, $listdescription, $listcurrent_price, $listnum_bids, $listend_date);
  
?>

<?php include_once("footer.php")?>