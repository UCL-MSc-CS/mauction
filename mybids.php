<?php include_once("header.php") ?>
<?php
include 'connection.php';
?>
<?php require("utilities.php") ?>

<div class="container">

  <h2 class="my-3">My Bids</h2>

  <?php
  $bidssusername = $_SESSION['username'];
  if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    $bidquery = "SELECT Auction.saleItemID, Auction.itemName, Auction.category, Auction.description, Auction.endDate, 
    Auction.userName AS seller, MAX(bidAmount) as maxBid, COUNT(bidID) as countBid
    FROM Auction, Bid
    WHERE Auction.saleItemID IN (SELECT saleItemID FROM Bid WHERE userName = '$bidssusername') 
        AND Auction.saleItemID = Bid.saleItemID
    GROUP BY Auction.saleItemID";
    $bidresult = mysqli_query($connection, $bidquery) or die('Error selecting user query' . mysqli_error());
    // empty() only works on Windows
    if (empty($bidresult)) {
      echo "Your bid history is empty.";
    }

    while ($bidrow = mysqli_fetch_assoc($bidresult)) {
      $biditem_id = $bidrow['saleItemID'];
      $biditem_name = $bidrow['itemName'];
      $biddescription = $bidrow['description'];
      $bidcurrent_price = $bidrow['maxBid'];
      $num_bids = $bidrow['countBid'];
      $bidend_date = $bidrow['endDate'];
      print_listing_li($biditem_id, $biditem_name, $biddescription, $bidcurrent_price, $num_bids, $bidend_date);
    }
  } else {
    echo 'Please log in before you check your bid history.';
    echo '<button type="button" class="btn nav-link" data-toggle="modal" data-target="#loginModal">Login</button>';
  }

  ?>

  <?php include_once("footer.php") ?>