<?php include("connection.php")?>
<?php include_once("header.php")?>

Refresh to send outcome to database and email results

<?php


$query = "SELECT * FROM auction WHERE endDate < NOW()";
$result = mysqli_query($connection, $query) or die('Error making select users query' . mysqli_error($connection));
      $queryRes = mysqli_num_rows($result);
      while ($row = mysqli_fetch_assoc($result)) {
		  $saleItemID = $row['saleItemID'];
		  $seller_username = $row['userName'];
		  

$query2 = "SELECT MAX(bidAmount), userName FROM bid WHERE saleItemID = '$saleItemID' GROUP BY userName";
$result2 = mysqli_query($connection, $query2) or die('Error making select users query' . mysqli_error($connection));
      $queryRes2 = mysqli_num_rows($result2);
      $row2 = mysqli_fetch_assoc($result2);
		  $buyer_username = $row2['userName'];
		  $end_bid = $row2['MAX(bidAmount)'];	
			
if ($end_bid == '') {	
	$query3 = "SELECT * FROM outcome WHERE saleItemID=$saleItemID";
	$result3 = mysqli_query($connection, $query3) or die('Error making select outcome query' . mysqli_error($connection));
	$row3 = mysqli_fetch_assoc($result3);
	
	if ($row3['saleItemID'] != $saleItemID) {
$query4 = "INSERT INTO outcome (saleItemID, sold, end_bid, seller_username, buyer_username, seller_emailSent, buyer_emailSent) 
	VALUES ('$saleItemID', '0', '0.0', '$seller_username', '', '0', '0')";
	if (!mysqli_query($connection, $query4)) {die('Error: making insert into outcome query' . mysqli_error($connection)); }
}}

else {	
	$query3 = "SELECT * FROM outcome WHERE saleItemID=$saleItemID";
	$result3 = mysqli_query($connection, $query3) or die('Error making select outcome query' . mysqli_error($connection));
	$row3 = mysqli_fetch_assoc($result3);
	if ($row3['saleItemID'] != $saleItemID) {

$query5 = "INSERT INTO outcome (saleItemID, sold, end_bid, seller_username, buyer_username, seller_emailSent, buyer_emailSent) 
	VALUES ('$saleItemID', '1', '$end_bid', '$seller_username', '$buyer_username', '0', '0')";
	if (!mysqli_query($connection, $query5)) {die('Error: making insert into outcome query' . mysqli_error($connection)); }
}}
	  


	  }

// // seller email
// // if sold


$emailquery = "SELECT outcome.saleItemID, outcome.sold, outcome.seller_username,
 outcome.end_bid, user.email, auction.itemName FROM outcome, user, auction 
WHERE outcome.seller_username=user.userName and outcome.saleItemID=auction.saleItemID and outcome.seller_emailSent = '0' ";
      $emailresult = mysqli_query($connection, $emailquery) or die('Error making select users query' . mysqli_error($connection));
      $emailqueryRes = mysqli_num_rows($emailresult);
      while ($row = mysqli_fetch_assoc($emailresult)) {
		$saleItemID = $row['saleItemID'];
		$sold = $row['sold'];
		$seller_username = $row['seller_username'];
		$itemName = $row['itemName'];
		$end_bid = $row['end_bid'];
		$seller_email = $row['email'];
	  
	  	
if ($sold == '1') {
		
	$from = "ariannabourke@gmail.com";
	$to = "$seller_email";
	$subject = "You have sold an item!";
	$message = "Congratulations $seller_username! Your item $itemName 
	has sold for $end_bid.";
	$headers = [ "From: $from" ];

mail( $to, $subject, $message, implode( '\r\n', $headers ) ); 
	  }

// // seller email
// // if not sold 

if ($sold == '0' ) {
	$from = "ariannabourke@gmail.com";
	$to = "$seller_email";
	$subject = "Your item has not sold";
	$message = "Unfortunately, $seller_username your item $itemName has not sold!";
	$headers = [ "From: $from" ];

mail( $to, $subject, $message, implode( '\r\n', $headers ) );
	  }
$sentemailquery = "UPDATE outcome SET seller_emailSent = '1' WHERE saleItemID = $saleItemID";
$emailresults = mysqli_query($connection, $sentemailquery) or die('Error making select users query' . mysqli_error($connection));
	  }


// // buyer email
// // if won  


$query7 = "SELECT outcome.saleItemID, outcome.sold, outcome.end_bid, outcome.buyer_username, user.email, auction.itemName FROM outcome, user, auction 
WHERE outcome.buyer_username=user.userName and outcome.saleItemID=auction.saleItemID and outcome.buyer_emailSent = '0' ";
      $result7 = mysqli_query($connection, $query7) or die('Error making select users query' . mysqli_error($connection));
      $queryRes7 = mysqli_num_rows($result7);
      while ($row7 = mysqli_fetch_assoc($result7)) {
		$saleItemID = $row7['saleItemID'];
		$sold = $row7['sold'];
		$buyer_username = $row7['buyer_username'];
		$itemName = $row7['itemName'];
		$end_bid = $row7['end_bid'];
		$buyer_email = $row7['email'];

if ($sold == '1') {	  

	$from = "ariannabourke@gmail.com";
	$to = "$buyer_email";
	$subject = "You have won an auction!";
	$message = "Congratulations! $buyer_username you have won item $itemName
	Your bid of $end_bid was the highest! ";
	$headers = [ "From: $from" ];

mail( $to, $subject, $message, implode( '\r\n', $headers ) );
}

$sentemailquery = "UPDATE outcome SET buyer_emailSent = '1' WHERE saleItemID = $saleItemID";
$emailresults = mysqli_query($connection, $sentemailquery) or die('Error making select users query' . mysqli_error($connection));
	  }
?>

<?php


?>
<?php include_once("footer.php")?>
		