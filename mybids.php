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
      $bidquery = "SELECT auctions.*, bids.* 
                       FROM auctions, bids 
                       WHERE bids.saleItemID = auctions.saleItemID AND bids.userID = '2' ORDER BY bidAmount ASC";//fixed the uerID reference issue (undefined variable)
      $bidresult = mysqli_query($connection, $bidquery) or die('Error selecting user query' . mysqli_error());
      while ($bidrow = mysqli_fetch_assoc($bidresult)) {
        $bidid = $bidrow['bidID'];
        $biduser_id = $bidrow['userID'];
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

  // Matt 01/11: This is going to be a pretty standard make connection -> pull data from query -> print it out -> close connection script
  
  // TODO: Check user's credentials (cookie/session).
  
  // TODO: Perform a query to pull up the auctions they've bidded on.
  
  // TODO: Loop through results and print them out as list items.
  
?>

<?php include_once("footer.php")?>
