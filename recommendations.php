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
  $userID = 2;
  $query = "SELECT * FROM bids WHERE userID = '$userID'";
  $result = mysqli_query($connection, $query) or die('Error making select users query' . mysql_error());
  $queryRes = mysqli_num_rows($result);
  $title = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $title . array_push($title, $row['saleItemID']);
  }
  $title2 = array();
  for ($x = 0; $x <= count($title) - 1; $x++) {
    $query2 = "SELECT itemName FROM auctions a WHERE a.saleItemID = '$title[$x]'";
    $result2 = mysqli_query($connection, $query2) or die('Error making select users query' . mysql_error());
    $queryRes2 = mysqli_num_rows($result2);
    while ($row2 = mysqli_fetch_assoc($result2)) {
      $title2 . array_push($title2, $row2['itemName']);
    }
  }
  $noResults = array();
  for ($x = 0; $x <= count($title2) - 1; $x++) {
    $query3 = "SELECT userID, saleItemID, itemName, description, startPrice, commission, endDate FROM auctions WHERE userID <> '$userID' AND itemName LIKE '$title2[$x]'";
    $result3 = mysqli_query($connection, $query3) or die('Error making select users query' . mysql_error());
    $queryRes3 = mysqli_num_rows($result3);
    if ($queryRes3 == 0) {
      $noResults . array_push($noResults, "0");
    } else {
      $noResults . array_push($noResults, "1");
      // TODO: Loop through results and print them out as list items.
      while ($row3 = mysqli_fetch_assoc($result3)) {
        $item_id = $row3['userID'];
        $saleItemID = $row3['saleItemID'];
        $title3 = $row3['itemName'];
        $description = $row3['description'];
        $current_price = $row3['startPrice'];
        $num_bids = $row3['commission'];
        $end_date = $row3['endDate'];
        // This uses a function defined in utilities.php
        if (!in_array("$saleItemID", $title)) {
          print_listing_li($item_id, $title3, $description, $current_price, $num_bids, $end_date);
        }
      }
    }
  }
  $final = false;
  for ($x = 0; $x <= count($noResults) - 1; $x++) {
    if ($noResults[$x] == "1") {
      $final = true;
      break;
    }
  }
  if ($final == true) {
    echo "";
  } else {
    echo ('<div class="error" style="color: red">Sorry, we have no recommendations for you.</div>');
  }
  ?>