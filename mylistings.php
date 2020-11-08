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
    $listingquery = "SELECT userID, itemName, description, startPrice, commission, endDate FROM auctions WHERE userID = '1' ORDER BY itemName ASC"; // need to add WHERE userID IN (SELECT userID WHERE userName = '$listusername' AND password = '$listpassword'FROM users)
    $listresult = mysqli_query($connection, $listingquery) or die('Error selecting user query' . mysqli_error());
    $listqueryRes = mysqli_num_rows($listresult);
    while ($listrow = mysqli_fetch_assoc($listresult)) {
      $listitem_id = $listrow['userID'];
      $listtitle = $listrow['itemName'];
      $listdescription = $listrow['description'];
      $listcurrent_price = $listrow['startPrice'];
      $listnum_bids = $listrow['commission'];
      $listend_date = $listrow['endDate'];
    }
    print_listing_li($listitem_id, $listtitle, $listdescription, $listcurrent_price, $listnum_bids, $listend_date);
  // TODO: Check user's credentials (cookie/session).
  
  // TODO: Perform a query to pull up their auctions. 95%DONE
  
  // TODO: Loop through results and print them out as list items. DONE
  
?>

<?php include_once("footer.php")?>