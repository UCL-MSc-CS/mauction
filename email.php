<?php include("connection.php") ?>
<?php include_once("header.php") ?>

Refresh to send outcome to database and email results

<?php

$query = "SELECT * FROM Auction WHERE endDate < NOW()";
$result = mysqli_query($connection, $query) or die('Error making select users query' . mysqli_error($connection));
$queryRes = mysqli_num_rows($result);
while ($row = mysqli_fetch_assoc($result)) {
	$saleItemID = $row['saleItemID'];
	$sellerUsername = $row['userName'];

	$query2 = "SELECT MAX(bidAmount), userName FROM Bid WHERE saleItemID = '$saleItemID' GROUP BY userName";
	$result2 = mysqli_query($connection, $query2) or die('Error making select users query' . mysqli_error($connection));
	$queryRes2 = mysqli_num_rows($result2);
	$row2 = mysqli_fetch_assoc($result2);
	$buyerUsername = $row2['userName'];
	$endBid = $row2['MAX(bidAmount)'];

	if ($endBid == '') {
		$query3 = "SELECT * FROM Outcome WHERE saleItemID=$saleItemID";
		$result3 = mysqli_query($connection, $query3) or die('Error making select outcome query' . mysqli_error($connection));
		$row3 = mysqli_fetch_assoc($result3);

		if ($row3['saleItemID'] != $saleItemID) {
			$query4 = "INSERT INTO Outcome (saleItemID, sold, endBid, sellerUsername, buyerUsername, sellerEmailSent, buyerEmailSent) 
	VALUES ('$saleItemID', '0', '0.0', '$sellerUsername', '', '0', '0')";
			if (!mysqli_query($connection, $query4)) {
				die('Error: making insert into outcome query' . mysqli_error($connection));
			}
		}
	} else {
		$query3 = "SELECT * FROM Outcome WHERE saleItemID=$saleItemID";
		$result3 = mysqli_query($connection, $query3) or die('Error making select outcome query' . mysqli_error($connection));
		$row3 = mysqli_fetch_assoc($result3);
		if ($row3['saleItemID'] != $saleItemID) {

			$query5 = "INSERT INTO Outcome (saleItemID, sold, endBid, sellerUsername, buyerUsername, sellerEmailSent, buyerEmailSent) 
	VALUES ('$saleItemID', '1', '$endBid', '$sellerUsername', '$buyerUsername', '0', '0')";
			if (!mysqli_query($connection, $query5)) {
				die('Error: making insert into outcome query' . mysqli_error($connection));
			}
		}
	}
}

// Seller email if sold

$emailquery = "SELECT Outcome.saleItemID, Outcome.sold, Outcome.sellerUsername,
 Outcome.endBid, User.email, Auction.itemName FROM Outcome, User, Auction 
WHERE Outcome.sellerUsername=User.userName and Outcome.saleItemID=Auction.saleItemID and Outcome.sellerEmailSent = '0' ";
$emailresult = mysqli_query($connection, $emailquery) or die('Error making select users query' . mysqli_error($connection));
$emailqueryRes = mysqli_num_rows($emailresult);
while ($row = mysqli_fetch_assoc($emailresult)) {
	$saleItemID = $row['saleItemID'];
	$sold = $row['sold'];
	$sellerUsername = $row['sellerUsername'];
	$itemName = $row['itemName'];
	$endBid = $row['endBid'];
	$sellerEmail = $row['email'];

	if ($sold == '1') {

		$from = "ariannabourke@gmail.com";
		$to = "$sellerEmail";
		$subject = "You have sold an item!";
		$message = "Congratulations $sellerUsername! Your item $itemName 
		has sold for $endBid pounds.";
		$headers = ["From: $from"];

		mail($to, $subject, $message, implode('\r\n', $headers));
	}

	// Seller email if not sold

	if ($sold == '0') {
		$from = "ariannabourke@gmail.com";
		$to = "$sellerEmail";
		$subject = "Your item has not sold";
		$message = "Unfortunately, $sellerUsername your item $itemName has not sold!";
		$headers = ["From: $from"];

		mail($to, $subject, $message, implode('\r\n', $headers));
	}
	$sentemailquery = "UPDATE Outcome SET sellerEmailSent = '1' WHERE saleItemID = $saleItemID";
	$emailresults = mysqli_query($connection, $sentemailquery) or die('Error making select users query' . mysqli_error($connection));
}

// Buyer email if won 

$query7 = "SELECT Outcome.saleItemID, Outcome.sold, Outcome.endBid, Outcome.buyerUsername, User.email, Auction.itemName FROM Outcome, User, Auction 
WHERE Outcome.buyerUsername=User.userName and Outcome.saleItemID=Auction.saleItemID and Outcome.buyerEmailSent = '0' ";
$result7 = mysqli_query($connection, $query7) or die('Error making select users query' . mysqli_error($connection));
$queryRes7 = mysqli_num_rows($result7);
while ($row7 = mysqli_fetch_assoc($result7)) {
	$saleItemID = $row7['saleItemID'];
	$sold = $row7['sold'];
	$buyerUsername = $row7['buyerUsername'];
	$itemName = $row7['itemName'];
	$endBid = $row7['endBid'];
	$buyerEmail = $row7['email'];

	if ($sold == '1') {

		$from = "ariannabourke@gmail.com";
		$to = "$buyerEmail";
		$subject = "You have won an auction!";
		$message = "Congratulations! $buyerUsername you have won item $itemName
	Your bid of $endBid pounds was the highest! ";
		$headers = ["From: $from"];

		mail($to, $subject, $message, implode('\r\n', $headers));
	}

	$sentemailquery = "UPDATE Outcome SET buyerEmailSent = '1' WHERE saleItemID = $saleItemID";
	$emailresults = mysqli_query($connection, $sentemailquery) or die('Error making select users query' . mysqli_error($connection));
}
?>

<?php


?>
<?php include_once("footer.php") ?>