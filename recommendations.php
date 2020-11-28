<?php include 'connection.php'; ?>
<?php include("header.php") ?>
<?php require("utilities.php") ?>

<div class="container">

  <h2 class="my-3">Recommendations For You</h2>

  <?php
  $userName = $_SESSION['username'];
  $query = "SELECT au.saleItemID, au.itemName, au.description, au.endDate, maxBid, countBid FROM Auction au INNER JOIN (SELECT DISTINCT d.saleItemID, MAX(d.bidAmount) as maxBid, COUNT(DISTINCT d.bidID) as countBid FROM (SELECT a.userName as myUserName, Bid.bidAmount, Bid.bidID, Bid.userName as otherUserName, a.saleItemID FROM (SELECT * FROM Bid WHERE Bid.userName = '$userName') a INNER JOIN Bid ON a.saleItemID = Bid.saleItemID WHERE Bid.userName <> '$userName') c LEFT JOIN Bid d ON c.otherUserName = d.userName WHERE d.saleItemID NOT IN (SELECT saleItemID FROM Bid WHERE Bid.userName = '$userName') GROUP BY d.saleItemID) e ON e.saleItemID = au.saleItemID";
  $result = mysqli_query($connection, $query) or die('Error making select users query' . mysqli_error());
  $queryRes = mysqli_num_rows($result);
  if (empty($queryRes)) {
    echo ('<div class="error" style="color: red">Sorry, we have no recommendations for you.</div>');
  } else {
    while ($row = mysqli_fetch_assoc($result)) {
      $item_id = $row['saleItemID'];
      $title = $row['itemName'];
      $description = $row['description'];
      $current_price = $row['maxBid'];
      $num_bids = $row['countBid'];
      $end_date = $row['endDate'];
      print_listing_li($item_id, $title, $description, $current_price, $num_bids, $end_date);
    }
  };
  ?>