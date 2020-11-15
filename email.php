<?php include("connection.php")?>

<?php
// SET GLOBAL event_schedular = ON;
// Create EVENT email
// ON SCHEDULE
// EVERY 1 DAY
// STARTS 2020-11-14
// DO
// 

$query = "SELECT MAX(bidAmount)
	  FROM bids";
      $result = mysqli_query($connection, $query) or die('Error making select users query' . mysql_error());
      $queryRes = mysqli_num_rows($result);
      while ($row = mysqli_fetch_assoc($result)) {
		$bidTotal = $row['MAX(bidAmount)'];
	  }

$from = "ariannabourke@gmail.com";
$to = "arianna.bourke.20@ucl.ac.uk";
$subject = "I hate PHP";
$message = "Max bid is $bidTotal";
$headers = [ "From: $from" ];

mail( $to, $subject, $message, implode( '\r\n', $headers ) );


	// if ($now > $end_time && $current_price > $reservePrice) {
		// $query = "INSERT INTO outcome (userID, outcome_seller, outcome_buyer, item_id) 
		// Values ($userID, 'sold', 'winner', $item_id)";
		// if (!mysqli_query($connection, $query)) {
		// die('Error: ' . mysqli_error($connection)); }
	// }
	
		// if ($now > $end_time && $current_price < $reservePrice) {
		// $query = "INSERT INTO outcome (userID, outcome_seller, outcome_buyer, item_id) 
		// Values ($userID, 'not sold', 'no winner', $item_id)";
		// if (!mysqli_query($connection, $query)) {
		// die('Error: ' . mysqli_error($connection)); }
	// }
	
?>
		