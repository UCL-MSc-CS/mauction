<?php
include 'connection.php';
?>
<?php include_once("header.php") ?>
<?php require("utilities.php") ?>

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
  $title = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $title.array_push($title,$row['itemName']);
  }
  print_r($title);
    $query2 = "SELECT userID, itemName, description, startPrice, commission, endDate FROM auctions WHERE itemName LIKE '$title'";
    $result2 = mysqli_query($connection, $query) or die('Error making select users query' . mysql_error());
    $queryRes2 = mysqli_num_rows($result);
    if ($queryRes2 == 0) {
      echo ('<div class="error" style="color: red">Sorry, no results.</div>');
    } else {
      // TODO: Loop through results and print them out as list items.
      while ($row2 = mysqli_fetch_assoc($result2)) {
        $item_id = $row2['userID'];
        $title2 = $row2['itemName'];
        $description = $row2['description'];
        $current_price = $row2['startPrice'];
        $num_bids = $row2['commission'];
        $end_date = $row2['endDate'];
        // This uses a function defined in utilities.php
        print_listing_li($item_id, $title2, $description, $current_price, $num_bids, $end_date);
      }
    }
  ?>