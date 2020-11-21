<?php include("connection.php")?>
<?php include_once("header.php")?>
<?php
// this script need to be run from email.php to enter the outcome results into the outcome table
// it will then send an email to the buyer and seller 

// problems: only adds 1 saleItem to outcome table rather than all of the items that have gone past the end date
// only sends emails referring to that 1 saleItem
// sends email every time page is refreshed
?>
Refresh to send outcome to database and email results

<?php
//// Assign variables:

	  $query = "SELECT auction.*
	  FROM auction
	  WHERE saleItemID='6' ";
      $result = mysqli_query($connection, $query) or die('Error making select auction query' . mysqli_error($connection));
      $queryRes = mysqli_num_rows($result);
      while ($row = mysqli_fetch_assoc($result)) {
        // $saleItemID = $row['saleItemID'];
		$seller_username = $row['userName'];	
        $itemName = $row['itemName'];
		$reservePrice = $row['reservePrice'];
        $endDate = $row['endDate'];
	  }
	  
	  $query = "SELECT MAX(bidAmount), saleItemID
	  FROM bid
	  WHERE saleItemID='6' ";
      $result = mysqli_query($connection, $query) or die('Error making select bid query' . mysqli_error($connection));
      $queryRes = mysqli_num_rows($result);
      while ($row = mysqli_fetch_assoc($result)) {
        $saleItemID = $row['saleItemID'];
		$end_bid = $row['MAX(bidAmount)'];

	  }
	
	$query = "SELECT userName
	  FROM bid 
	  WHERE bidAmount= $end_bid and 
	  saleItemID=$saleItemID ";
      $result = mysqli_query($connection, $query) or die('Error making select bid query' . mysqli_error($connection));
      $queryRes = mysqli_num_rows($result);
      while ($row = mysqli_fetch_assoc($result)) {
		$buyer_username = $row['userName'];
	  }

$now = new DateTime("now");
$end_time = new DateTime($endDate);
$commission = (0.05 * $end_bid); 
$finalPrice = ($end_bid - $commission);

	if ($finalPrice > $reservePrice) {
		$sold = True;}
	else { 
		$sold = False;}

// query to send results to outcome table, only sends once per sale item to avoid duplicates

	if ($now > $end_time) {
	
	$query = "SELECT * FROM outcome WHERE saleItemID=$saleItemID";
	$result = mysqli_query($connection, $query) or die('Error making select outcome query' . mysqli_error($connection));
	
	if (mysqli_num_rows($result) <= 0) {
	$query = "INSERT INTO outcome (saleItemID, sold, end_bid, commission, finalPrice, seller_username, buyer_username) 
	VALUES ('$saleItemID', '$sold', '$end_bid', '$commission', '$finalPrice', '$seller_username', '$buyer_username')";
	if (!mysqli_query($connection, $query)) {die('Error: making insert into outcome query' . mysqli_error($connection)); }
	}
}

// // seller email
// // if sold


// $query = "SELECT outcome.saleItemID, outcome.sold, outcome.seller_username,
 // outcome.end_bid, outcome.commission, outcome.finalPrice, user.email, auction.itemName FROM outcome, user, auction 
// WHERE outcome.seller_username=user.userName and outcome.saleItemID=auction.saleItemID";
      // $result = mysqli_query($connection, $query) or die('Error making select users query' . mysqli_error($connection));
      // $queryRes = mysqli_num_rows($result);
      // while ($row = mysqli_fetch_assoc($result)) {
		// $saleItemID = $row['saleItemID'];
		// $sold = $row['sold'];
		// $seller_username = $row['seller_username'];
		// $itemName = $row['itemName'];
		// $end_bid = $row['end_bid'];
		// $commission = $row['commission'];
		// $finalPrice = $row['finalPrice'];
		// $seller_email = $row['email'];
	  // }
	  	
// if ($sold = True) {
	
	// $from = "ariannabourke@gmail.com";
	// $to = "$seller_email";
	// $subject = "You have sold an item!";
	// $message = "Congratulations $seller_username! Your item $itemName 
	// has $sold for $end_bid. You will receive $finalPrice, 
	// which is the winning bid price minus our $commission commission fee of 0.05%";
	// $headers = [ "From: $from" ];

// mail( $to, $subject, $message, implode( '\r\n', $headers ) ); 

// }
// // // seller email
// // // if not sold 

// if ($sold = False) {
	// $from = "ariannabourke@gmail.com";
	// $to = "$seller_email";
	// $subject = "Your item has not sold";
	// $message = "Unfortunately, $seller_username your item $itemName has not sold!";
	// $headers = [ "From: $from" ];

// mail( $to, $subject, $message, implode( '\r\n', $headers ) );
// }


// // buyer email
// // if won  

// if ($sold = True) {
// $query = "SELECT outcome.saleItemID, outcome.sold, outcome.end_bid, outcome.buyer_username, user.email, auction.itemName FROM outcome, user, auction 
// WHERE outcome.buyer_username=user.userName and outcome.saleItemID=auction.saleItemID";
      // $result = mysqli_query($connection, $query) or die('Error making select users query' . mysqli_error($connection));
      // $queryRes = mysqli_num_rows($result);
      // while ($row = mysqli_fetch_assoc($result)) {
		// $saleItemID = $row['saleItemID'];
		// $sold = $row['sold'];
		// $buyer_username = $row['buyer_username'];
		// $itemName = $row['itemName'];
		// $end_bid = $row['end_bid'];
		// $buyer_email = $row['email'];
	  // }

	// $from = "ariannabourke@gmail.com";
	// $to = "$buyer_email";
	// $subject = "You have won an auction!";
	// $message = "Congratulations! $buyer_username you have won item $itemName
	// Your bid of $end_bid was the highest! ";
	// $headers = [ "From: $from" ];

// mail( $to, $subject, $message, implode( '\r\n', $headers ) );
// }
	
?>
<?php include_once("footer.php")?>
		