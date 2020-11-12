<?php
include 'connection.php';
?>
<?php include_once("header.php")?>
<?php require("utilities.php")?>

<div class="container">

<h2 class="my-3">Recommendations for you</h2>

<?php
  // This page is for showing a buyer recommended items based on their bid 
  // history. It will be pretty similar to browse.php, except there is no 
  // search bar. This can be started after browse.php is working with a database.
  // Feel free to extract out useful functions from browse.php and put them in
  // the shared "utilities.php" where they can be shared by multiple files.

  // TODO: Check user's credentials (cookie/session).
  
  // TODO: Perform a query to pull up auctions they might be interested in.
  $userID = 3;
  $query = "SELECT userID, itemName, description, startPrice, commission, endDate FROM auctions WHERE userID = '$userID'";
  $result = mysqli_query($connection, $query) or die('Error making select users query' . mysql_error());
  $queryRes = mysqli_num_rows($result);
  if ($queryRes == 0) {
    echo ('<div class="error" style="color: red">Sorry, no results.</div>');
  } else {
      // TODO: Loop through results and print them out as list items.
    while ($row = mysqli_fetch_assoc($result)) {
      $item_id = $row['userID'];
      $title = $row['itemName'];
      $description = $row['description'];
      $current_price = $row['startPrice'];
      $num_bids = $row['commission'];
      $end_date = $row['endDate'];
      // This uses a function defined in utilities.php
      print_listing_li($item_id, $title, $description, $current_price, $num_bids, $end_date);
    }
  }
  
?>