<?php
include 'connection.php';
?>

<?php include_once("header.php") ?>

<div class="container my-5">

        <?php

        if (isset($_POST['submit'])) {
                $username = $_SESSION['username'];
                $auctionTitle = mysqli_real_escape_string($connection, $_POST['auctionTitle']);
                $description = mysqli_real_escape_string($connection, $_POST['auctionDetails']);
                $condition = mysqli_real_escape_string($connection, $_POST['condition']);
                $category = mysqli_real_escape_string($connection, $_POST['auctionCategory']);
                $startPrice = mysqli_real_escape_string($connection, $_POST['auctionStartPrice']);
                $reservePrice = mysqli_real_escape_string($connection, $_POST['auctionReservePrice']);
                $htmlDate = mysqli_real_escape_string($connection, $_POST['auctionEndDate']);
                $strDate = strtotime($htmlDate);
                $endDate = date("Y-m-d H:i:s", $strDate);
                $delivery = mysqli_real_escape_string($connection, $_POST['delivery']);

                if ($reservePrice == '') {
                        $reservePrice = 0;
                } if (empty($auctionTitle)) {
                        echo "Please provide an auction title";
                } elseif (empty($category)) {
                        echo "Please select a category";
                } elseif (empty($startPrice)) {
                        echo "Please provide a starting price";
                } elseif (empty($endDate)) {
                        echo "Please provide an end date";
                } elseif (empty($condition)) {
                        echo "Please state the condition of your item";
                } elseif (empty($delivery)) {
                        echo "Please provide the item's delivery method";
                } else {
                        echo '<div class="text-center">Auction successfully created! <a href="mylistings.php">View your new listing.</a></div>';
                        $query = "INSERT INTO Auction (userName, itemName, startPrice, category, description, endDate, itemCondition, delivery) VALUES('$username','$auctionTitle','$startPrice','$category',
			'$description', '$endDate', '$condition', '$delivery')";
                        if (!mysqli_query($connection, $query)) {
                                die('Error: ' . mysqli_error($connection));
                        }
                }
        }
        ?>

</div>

<?php include_once("footer.php") ?>