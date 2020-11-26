<?php include 'connection.php'; ?>
<?php include ("header.php") ?>
<?php require("utilities.php") ?>

<div class="container">

  <h2 class="my-3">My Listings</h2>

  <?php

  $listingsusername = $_SESSION['username'];
  if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    $listingquery = "SELECT Auction.saleItemID, Auction.itemName, Auction.category, Auction.description, Auction.endDate, 
    Auction.userName AS seller, Auction.startPrice, MAX(bidAmount) as maxBid, COUNT(bidID) as countBid
    FROM Auction
    LEFT JOIN Bid
    ON Auction.saleItemID = Bid.saleItemID
    WHERE Auction.userName = '$listingsusername'
    GROUP BY Auction.saleItemID";
    $listresult = mysqli_query($connection, $listingquery) or die('Error selecting user query' . mysqli_error());
    $nobidlist = "SELECT Auction.saleItemID, Auction.itemName, Auction.category, Auction.description, Auction.endDate, Auction.userName";
    if (empty($listresult)) {
      echo 'You do not have any listings at this point.';
    } else {
      while ($listrow2 = mysqli_fetch_assoc($listresult)) {
        if ($listrow2['maxBid'] == null) {
          $listcurrent_price = $listrow2['startPrice'];
        } else {
          $listcurrent_price = $listrow2['maxBid'];
        }
        $listitem_id = $listrow2['saleItemID'];
        $listtitle = $listrow2['itemName'];
        $listdescription = $listrow2['description'];
        $listnum_bids = $listrow2['countBid'];
        $listend_date = $listrow2['endDate'];
        print_listing_li($listitem_id, $listtitle, $listdescription, $listcurrent_price, $listnum_bids, $listend_date);
      }
    }
  } else {
    echo 'Please log in before checking your listings.';
    echo '<button type="button" class="btn nav-link" data-toggle="modal" data-target="#loginModal">Login</button>';
  }

  ?>


  <?php include_once("footer.php") ?>