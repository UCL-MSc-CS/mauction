<?php
include 'connection.php';
?>
<?php include_once("header.php") ?>
<?php require("utilities.php") ?>

<div class="container">

    <h2 class="my-3">Your Watchlist</h2>

    <?php
    $userName = 'erinuclkwon';
    $bidQuery = "SELECT auction.*, MAX(bidAmount) as maxBid, COUNT(bidID) as countBid FROM auction, bid WHERE auction.saleItemID = bid.saleItemID GROUP BY auction.saleItemID ORDER BY itemName ASC";
    $bidResult = mysqli_query($connection, $bidQuery) or die('Error making select users query' . mysqli_error());
    $bidQueryRes = mysqli_num_rows($bidResult);
    $arr = array();
    while ($bidRow = mysqli_fetch_assoc($bidResult)) {
        $arr . array_push($arr, $bidRow);
    }
    $query = "SELECT * FROM watchlist WHERE userName = '$userName'";
    $result = mysqli_query($connection, $query) or die('Error making select users query' . mysqli_error());
    $queryRes = mysqli_num_rows($result);

    // TODO: Loop through results and print them out as list items.
    while ($row = mysqli_fetch_assoc($result)) {
        $item_id = $row['userName'];
        $saleItemID = $row['saleItemID'];
        for ($y = 0; $y <= count($arr) - 1; $y++) {
            if ($saleItemID == $arr[$y]['saleItemID']) {
                $current_price = $arr[$y]['maxBid'];
                $num_bids = $arr[$y]['countBid'];
                $title = $arr[$y]['itemName'];
                $description = $arr[$y]['description'];
                $end_date = $arr[$y]['endDate'];
            }
        }
        print_listing_li($saleItemID, $title, $description, $current_price, $num_bids, $end_date);
    }

    ?>