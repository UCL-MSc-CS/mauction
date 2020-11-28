<?php include 'connection.php'; ?>
<?php include ("header.php") ?>
<?php require("utilities.php") ?>

<div class="container">

    <h2 class="my-3">Your Watchlist</h2>

    <?php
    $newQuery = "SELECT a.AuctionItem, a.itemName, a.description, a.endDate, a.startPrice, a.userName, a.WatchItem, MAX(bidAmount) as maxBid, COUNT(DISTINCT bidID) as countBid FROM (SELECT Auction.saleItemID as AuctionItem, Auction.itemName, Auction.description, Auction.endDate, Auction.startPrice, Watchlist.userName, Watchlist.saleItemID as WatchItem FROM Auction, Watchlist WHERE Watchlist.userName = 'mattShorvon' AND Auction.saleItemID = Watchlist.saleItemID) a LEFT JOIN Bid ON a.AuctionItem = Bid.saleItemID WHERE a.AuctionItem = Bid.saleItemID GROUP BY a.AuctionItem, a.itemName, a.description, a.endDate, a.startPrice, a.userName, a.WatchItem";
    
    $userName = $_SESSION['username'];
    $bidQuery = "SELECT Auction.*, MAX(bidAmount) as maxBid, COUNT(bidID) as countBid FROM Auction, Bid WHERE Auction.saleItemID = Bid.saleItemID AND Bid.userName = '$userName' GROUP BY Auction.saleItemID ORDER BY itemName ASC";
    $bidResult = mysqli_query($connection, $bidQuery) or die('Error making select users query' . mysqli_error());
    $bidQueryRes = mysqli_num_rows($bidResult);
    $arr = array();
    // array_push brings up a notice on Windows computers, but not MacOS
    while ($bidRow = mysqli_fetch_assoc($bidResult)) {
        $arr . array_push($arr, $bidRow);
    }
    $query = "SELECT Auction.*, Watchlist.* FROM Auction, Watchlist WHERE Watchlist.userName = '$userName' AND Auction.saleItemID = Watchlist.saleItemID";
    $result = mysqli_query($connection, $query) or die('Error making select users query' . mysqli_error());
    $queryRes = mysqli_num_rows($result);

    while ($row = mysqli_fetch_assoc($result)) {
        $saleItemID = $row['saleItemID'];
        $title = $row['itemName'];
        $description = $row['description'];
        $end_date = $row['endDate'];
        $current_price = $row['startPrice'];
        $num_bids = 0;
        for ($y = 0; $y <= count($arr) - 1; $y++) {
            if ($saleItemID == $arr[$y]['saleItemID']) {
                $current_price = $arr[$y]['maxBid'];
                $num_bids = $arr[$y]['countBid'];
            }
        }
        print_listing_li($saleItemID, $title, $description, $current_price, $num_bids, $end_date);
    }

    ?>