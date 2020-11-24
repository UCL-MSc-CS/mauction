<?php include_once("header.php") ?>
<?php
include 'connection.php';
?>
<?php require("utilities.php") ?>

<div class="container">

  <h2 class="my-3">My bids</h2>

  <?php
  // This page is for showing a user the auctions they've bid on.
  // It will be pretty similar to browse.php, except there is no search bar.
  // This can be started after browse.php is working with a database.
  // Feel free to extract out useful functions from browse.php and put them in
  // the shared "utilities.php" where they can be shared by multiple files.

  // session_start();
  $bidssusername = $_SESSION['username'];
  if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    $bidquery = "SELECT auction.saleItemID, auction.itemName, auction.category, auction.description, auction.endDate, 
    auction.userName AS seller, MAX(bidAmount) as maxBid, COUNT(bidID) as countBid
    FROM auction, bid
    WHERE auction.saleItemID IN (SELECT saleItemID FROM bid WHERE auction.userName = '$bidssusername') 
        AND auction.saleItemID = bid.saleItemID
    GROUP BY auction.saleItemID";
    $bidresult = mysqli_query($connection, $bidquery) or die('Error selecting user query' . mysqli_error());
    if (empty($bidresult)) {
      echo "Your bid history is empty.";
    }
    
      while ($bidrow = mysqli_fetch_assoc($bidresult)) {
      // $bidid = $bidrow['bidID'];
      // $biduser_id = $bidrow['userName'];
      $biditem_id = $bidrow['saleItemID'];
      // $bidamount = $bidrow['bidAmount'];
      $biditem_name = $bidrow['itemName'];
      $biddescription = $bidrow['description'];
      $bidcurrent_price = $bidrow['maxBid'];
      $num_bids = $bidrow['countBid'];
      $bidend_date = $bidrow['endDate'];
      print_listing_li($biditem_id, $biditem_name, $biddescription, $bidcurrent_price, $num_bids, $bidend_date);
    }
    
  } 
  else {
    echo 'Please log in before you check your bid history.';
    echo '<button type="button" class="btn nav-link" data-toggle="modal" data-target="#loginModal">Login</button>';
  }

  ?>

  <?php include_once("footer.php") ?>