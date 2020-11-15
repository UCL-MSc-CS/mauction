<?php include_once("header.php")?>
<?php 
include 'connection.php';
?>
<?php require("utilities.php")?>

<div class="container">

<h2 class="my-3">My bids</h2>

<?php
  // This page is for showing a user the auctions they've bid on.
  // It will be pretty similar to browse.php, except there is no search bar.
  // This can be started after browse.php is working with a database.
  // Feel free to extract out useful functions from browse.php and put them in
  // the shared "utilities.php" where they can be shared by multiple files.

  session_start();
  if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
      echo '<a class="nav-link" href="logout.php">Logout</a>';
      $bidquery = "SELECT auction.*, bid.* 
                       FROM auction, bid 
                       WHERE bid.saleItemID = auction.saleItemID AND bid.userName = 'erinuclkwon' ORDER BY bidAmount ASC";//fixed the uerID reference issue (undefined variable)
      $bidresult = mysqli_query($connection, $bidquery) or die('Error selecting user query' . mysqli_error());
      while ($bidrow = mysqli_fetch_assoc($bidresult)) {
        $bidid = $bidrow['bidID'];
        $biduser_id = $bidrow['userName'];
        $biditem_id = $bidrow['saleItemID'];
        $bidamount = $bidrow['bidAmount'];
        $biditem_name = $bidrow['itemName'];
        $biddescription = $bidrow['description'];
        $bidcurrent_price = $bidrow['startPrice'];
        $bidend_date = $bidrow['endDate'];
        print_listing_li($bidid, $biduser_id, $biditem_id, $bidamount, $biditem_name, $biddescription, $bidcurrent_price, $bidend_date);
      }
  }
  
  else {
    echo '<button type="button" class="btn nav-link" data-toggle="modal" data-target="#loginModal">Login</button>';
  }
  
?>

<?php include_once("footer.php")?>
