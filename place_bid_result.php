<?php
include 'connection.php';
?>

<?php include_once("header.php") ?>

<div class="container my-5">

    <?php

    if (isset($_POST['submit'])) {
        $bidAmount = mysqli_real_escape_string($connection, $_POST['bidAmount']);
        $item_id = $_GET['item_id'];
        $startPrice = $_GET['startPrice'];
        $userName = $_SESSION['username'];
        if (empty($bidAmount)) {
            echo "Please provide a bid amount";
        } else {
            $query = "SELECT MAX(bidAmount) FROM Bid WHERE saleItemID = '$item_id' ";
            $max_bid = mysqli_query($connection, $query) or die('Error making maxBid query' . mysqli_error($connection));
            $queryRes = mysqli_num_rows($max_bid);
            $result = mysqli_fetch_assoc($max_bid);
            $maxBid = $result["MAX(bidAmount)"];
            if ($bidAmount < $startPrice) {
                echo "Please enter an amount that is greater or equal to the start price";
            } else if ($bidAmount <= $maxBid) {
                echo "Please enter an amount above the current leading bid";
            } else {
                $query2 = "INSERT INTO Bid (userName, saleItemID, bidAmount) VALUES('$userName','$item_id','$bidAmount')";
                if (!mysqli_query($connection, $query2)) {
                    die('Error: ' . mysqli_error($connection));
                }
                echo '<div class="text-center">Bid placed successfully! <a href=index.php>Back to browse.</a></div>';
            }
        }
    }
    ?>

</div>

<?php include_once("footer.php") ?>