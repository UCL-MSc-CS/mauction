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
    $bidquery = "SELECT auction.*, MAX(bidAmount) as maxBid, COUNT(bidID) as countBid FROM auction, bid 
                       WHERE bid.saleItemID = auction.saleItemID GROUP BY auction.saleItemID, auction.itemName, auction.userName, auction.category, auction.startPrice, auction.description, auction.reservePrice, auction.endDate, auction.delivery, auction.itemCondtion"; //fixed the uerID reference issue (undefined variable)
    $bidresult = mysqli_query($connection, $bidquery) or die('Error selecting user query' . mysqli_error());
    if (empty($bidrow)) {
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
  } else {
    echo '<button type="button" class="btn nav-link" data-toggle="modal" data-target="#loginModal">Login</button>';
  }

  ?>

  <?php include_once("footer.php") ?>