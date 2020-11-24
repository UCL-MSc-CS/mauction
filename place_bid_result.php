<?php
include 'connection.php';
?>

<?php include_once("header.php") ?>

<div class="container my-5">

    <?php

    if (isset($_POST['submit'])) {
        $bidAmount = mysqli_real_escape_string($connection, $_POST['bidAmount']);
        $item_id = $_GET['item_id'];
        $userName = $_SESSION['username'];

        if (empty($bidAmount)) {
            echo "Please provide a bid amount";
        } 
        $query = "SELECT MAX(bidAmount) FROM Bid WHERE saleItemID = '$item_id' ";
        $max_bid = mysqli_query($connection, $query) or die('Error making maxBid query' . mysqli_error($connection));
        $queryResult = mysqli_num_rows($max_bid);
        if ($bidAmount <= $queryResult) {
            echo "Please enter an amount above the current leading bid";
        } else {
            echo '<div class="text-center">Bid placed successfully! <a href=index.php>Back to browse.</a></div>';
            $query = "INSERT INTO Bid (userName, saleItemID, bidAmount) VALUES('$userName','$item_id','$bidAmount')";
            if (!mysqli_query($connection, $query)) {
                die('Error: ' . mysqli_error($connection));
            }
        }
    }
    ?>

</div>

<?php include_once("footer.php") ?>