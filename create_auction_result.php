<?php
include 'connection.php';
//include 'login_result.php';
?>

<?php include_once("header.php") ?>

<div class="container my-5">

        <?php

        // Questions and stuff to do: how do you update outcome when bidding ends? 
        // Need to set commission to some sort of default value
        // Need to work out how to fill in the correct userID. Get the variable from session somehow? 

        // This function takes the form data and adds the new auction to the database.

        /* TODO #1: Connect to MySQL database (perhaps by requiring a file that
            already does this). */
        //Matt 01/11: this is done by the include connection statement that caroline made at the top


        /* TODO #2: Extract form data into variables. Because the form was a 'post'
            form, its data can be accessed via $POST['auctionTitle'], 
            $POST['auctionDetails'], etc. Perform checking on the data to
            make sure it can be inserted into the database. If there is an
            issue, give some semi-helpful feedback to user. */

        if (isset($_POST['submit'])) {
                $username = 'mattShorvon'; // hardcoded for now
                $auctionTitle = mysqli_real_escape_string($connection, $_POST['auctionTitle']); // this is the itemName
                $description = mysqli_real_escape_string($connection, $_POST['auctionDetails']);
                $condition = mysqli_real_escape_string($connection, $_POST['condition']);
                $category = mysqli_real_escape_string($connection, $_POST['auctionCategory']);
                $startPrice = mysqli_real_escape_string($connection, $_POST['auctionStartPrice']);
                $reservePrice = mysqli_real_escape_string($connection, $_POST['auctionReservePrice']);
                $htmlDate = mysqli_real_escape_string($connection, $_POST['auctionEndDate']);
                $strDate = strtotime($htmlDate);
                $endDate = date("Y-m-d H:i:s", $strDate);
                //$endTime = mysqli_real_escape_string($connection, $_POST['auctionEndTime']);
                $delivery = mysqli_real_escape_string($connection, $_POST['delivery']);
                //$userID = mysqli_query($connection, "SELECT 'userID' FROM users WHERE userName = '$loginusername' ") or die('Error...' . mysqli_error());

                if ($reservePrice == '') { //echo "yes";
                        $reservePrice = 0;
                }

                if (empty($auctionTitle)) {
                        echo "Please provide an auction title";
                }  //Matt 01/11: this checks that something is in auctionTitle
                elseif (empty($category)) {
                        echo "Please select a category";
                } elseif (empty($startPrice)) {
                        echo "Please provide a starting price";
                } elseif (empty($endDate)) {
                        echo "Please provide an end date";
                } elseif (empty($condition)) {
                        echo "Please state the condition of your item";
                }      //currently on create_auction.php, condition can't be empty so this line doesn't really do anything
                elseif (empty($delivery)) {
                        echo "Please provide the item's delivery method";
                }         //same with this line and category. 


                /* TODO #3: If everything looks good, make the appropriate call to insert
            data into the database.  If all is successful, let user know. */ else {
                        echo '<div class="text-center">Auction successfully created! <a href="FIXME">View your new listing.</a></div>';
                        $query = "INSERT INTO auction (userName, itemName, startPrice, category, description, endDate, itemCondition, delivery, reservePrice) VALUES('$username','$auctionTitle','$startPrice','$category',
			'$description', '$endDate', '$condition', '$delivery','$reservePrice')";
                        if (!mysqli_query($connection, $query)) {
                                die('Error: ' . mysqli_error($connection));
                        }
                }
        }
        ?>

</div>

<?php include_once("footer.php") ?>