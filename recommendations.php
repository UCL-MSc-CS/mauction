<?php include 'connection.php'; ?>
<?php include ("header.php") ?>
<?php require("utilities.php") ?>

<div class="container">

  <h2 class="my-3">Recommendations For You</h2>

  <?php
  $userName = $_SESSION['username'];
  $bidQuery = "SELECT Auction.saleItemID, MAX(bidAmount) as maxBid, COUNT(bidID) as countBid FROM Auction, Bid WHERE Auction.saleItemID = Bid.saleItemID GROUP BY Auction.saleItemID ORDER BY itemName ASC";
  $bidResult = mysqli_query($connection, $bidQuery) or die('Error making select users query' . mysqli_error());
  $bidQueryRes = mysqli_num_rows($bidResult);
  $arr = array();
  while ($bidRow = mysqli_fetch_assoc($bidResult)) {
    $arr . array_push($arr, $bidRow);
  }
  $query = "SELECT * FROM Bid WHERE userName = '$userName'";
  $result = mysqli_query($connection, $query) or die('Error making select users query' . mysqli_error());
  $queryRes = mysqli_num_rows($result);
  $title = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $title . array_push($title, $row['saleItemID']);
  }
  $title2 = array();
  for ($x = 0; $x <= count($title) - 1; $x++) {
    $query2 = "SELECT itemName FROM Auction WHERE Auction.saleItemID = '$title[$x]'";
    $result2 = mysqli_query($connection, $query2) or die('Error making select users query' . mysqli_error());
    $queryRes2 = mysqli_num_rows($result2);
    while ($row2 = mysqli_fetch_assoc($result2)) {
      $title2 . array_push($title2, $row2['itemName']);
    }
  }
  $noResults = array();
  for ($x = 0; $x <= count($title2) - 1; $x++) {
    $chopped = substr($title2[$x], 0, 3);
    $query3 = "SELECT userName, saleItemID, itemName, description, startPrice, endDate FROM Auction WHERE userName <> '$userName' AND itemName LIKE '%$chopped%'";
    $result3 = mysqli_query($connection, $query3) or die('Error making select users query' . mysqli_error());
    $queryRes3 = mysqli_num_rows($result3);
    if ($queryRes3 == 0) {
      $noResults . array_push($noResults, "0");
    } else {
      $noResults . array_push($noResults, "1");
      while ($row3 = mysqli_fetch_assoc($result3)) {
        $item_id = $row3['userName'];
        $saleItemID = $row3['saleItemID'];
        $title3 = $row3['itemName'];
        $description = $row3['description'];
        $current_price = $row3['startPrice'];
        $num_bids = 0;
        $end_date = $row3['endDate'];
        for ($y = 0; $y <= count($arr) - 1; $y++) {
          if ($saleItemID == $arr[$y]['saleItemID']) {
            $current_price = $arr[$y]['maxBid'];
            $num_bids = $arr[$y]['countBid'];
          }
        }
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