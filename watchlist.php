<?php include 'connection.php'; ?>
<?php include("header.php") ?>
<?php require("utilities.php") ?>

<div class="container">

    <h2 class="my-3">Your Watchlist</h2>

    <?php
    $userName = $_SESSION['username'];
    $query = "SELECT a.AuctionItem, a.itemName, a.description, a.endDate, a.startPrice, a.userName, a.WatchItem, MAX(bidAmount) as maxBid, COUNT(DISTINCT bidID) as countBid FROM (SELECT Auction.saleItemID as AuctionItem, Auction.itemName, Auction.description, Auction.endDate, Auction.startPrice, Watchlist.userName, Watchlist.saleItemID as WatchItem FROM Auction, Watchlist WHERE Watchlist.userName = '$userName' AND Auction.saleItemID = Watchlist.saleItemID) a LEFT JOIN Bid ON a.AuctionItem = Bid.saleItemID GROUP BY a.AuctionItem, a.itemName, a.description, a.endDate, a.startPrice, a.userName, a.WatchItem";
    $result = mysqli_query($connection, $query) or die('Error making select users query' . mysqli_error());
    $queryRes = mysqli_num_rows($result);
    if (empty($queryRes)) {
        echo ('<div class="error" style="color: red">Sorry, you have no items on your watchlist.</div>');
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            $saleItemID = $row['AuctionItem'];
            $title = $row['itemName'];
            $description = $row['description'];
            $end_date = $row['endDate'];
            if ($row['maxBid'] == null) {
                $current_price = $row['startPrice'];
            } else {
                $current_price = $row['maxBid'];
            }
            if ($row['countBid'] == null) {
                $num_bids = 0;
            } else {
                $num_bids = $row['countBid'];
            }
            print_listing_li($saleItemID, $title, $description, $current_price, $num_bids, $end_date);
        }
    }
    ?>