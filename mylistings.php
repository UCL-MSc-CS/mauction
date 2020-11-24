<?php include 'header.php'?>
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

$listingsusername = $_SESSION['username'];
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    // $listingquery = "SELECT userName, saleItemID, itemName, description, startPrice, endDate FROM auction WHERE userName = '$listingsusername' ORDER BY itemName ASC";
    $listingquery = "SELECT auction.saleItemID, auction.itemName, auction.category, auction.description, auction.endDate, 
    auction.userName AS seller, MAX(bidAmount) as maxBid, COUNT(bidID) as countBid
    FROM auction, bid
    WHERE auction.saleItemID IN (SELECT saleItemID FROM bid WHERE auction.userName = '$listingsusername') 
        AND auction.saleItemID = bid.saleItemID
    GROUP BY auction.saleItemID";
    $listresult = mysqli_query($connection, $listingquery) or die('Error selecting user query' . mysqli_error());
    if (empty($listresult)){
      echo 'You do not have any listings at this point.';
    }
    else{
    while ($listrow2 = mysqli_fetch_assoc($listresult)) {
      $listitem_id = $listrow2['saleItemID'];
      $listtitle = $listrow2['itemName'];
      $listdescription = $listrow2['description'];
      $listcurrent_price = $listrow2['maxBid'];
      $listnum_bids = $listrow2['countBid'];
      // $listnum_bids = $listrow['commission'];
      $listend_date = $listrow2['endDate'];
      print_listing_li($listitem_id, $listtitle, $listdescription, $listcurrent_price, $listnum_bids, $listend_date);
    }
  }
}

else {
  echo 'Please log in before checking your listings.';
  echo '<button type="button" class="btn nav-link" data-toggle="modal" data-target="#loginModal">Login</button>';
}
  
?>


<?php include_once("footer.php")?>