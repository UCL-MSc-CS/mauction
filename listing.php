<?php include_once("header.php") ?>
<?php require("utilities.php") ?>
<?php include("connection.php") ?>

<?php // Database changes: CHANGED saleitemID to item_id in database!!
// Altered to endDate in database (no separate time column)
// dropped commission column, this is calculated here based on the final bid
// dropped final price, this is calculated here
// droppped outcome, also not needed

// Timings, bid number, current price all work

// current price based on MAX bid, for this to work 
// most recent bidder must not be allowed to bid lower than the previous bidder (or 0)


//TODO: Sessions. Watchlist. 
// TODO: sort out utilites function to feed the same information through.
// TODO: notify specific user that they have won 

?>

<?php
  // Get info from the URL:
  $item_id = $_GET['item_id'];

  // TODO: Use item_id to make a query to the database.
  
	  $query = "SELECT auction.*, MAX(bidAmount), COUNT(bidID) 
	  FROM auction, bid where auction.saleItemID=$item_id and bid.saleItemID=$item_id";
      $result = mysqli_query($connection, $query) or die('Error making select users query' . mysql_error());
      $queryRes = mysqli_num_rows($result);
      while ($row = mysqli_fetch_assoc($result)) {
        $item_id = $row['saleItemID'];
		$userName = $row['userName'];
        $itemName = $row['itemName'];
        $description = $row['description'];
		$reservePrice = $row['reservePrice'];
		$category = $row['category'];
		$condition = $row['itemCondition'];
		$delivery = $row['delivery'];
		$startPrice = $row['startPrice'];
        $endDate = $row['endDate'];
		$current_price = $row['MAX(bidAmount)'];
		$num_bids = $row['COUNT(bidID)'];
	  }
	     

  // assigned variables.

  $end_time = new DateTime($endDate); // creates end time
  $commission = (0.05 * $current_price); // calculates commission from max bid
  $finalPrice = ($current_price + $commission); //caluculates final price of sold listing
  

  // TODO: Note: Auctions that have ended may pull a different set of data,
  //       like whether the auction ended in a sale or was cancelled due
  //       to lack of high-enough bids. Or maybe not. -- Completed this 
  
  
  
  // Calculate time to auction end:
  $now = new DateTime("now");
  
  if ($now < $end_time) {
    $time_to_end = date_diff($now, $end_time);
    $time_remaining = ' (in ' . display_time_remaining($time_to_end) . ')';
  }
  
  // TODO: If the user has a session, use it to make a query to the database
  //       to determine if the user is already watching this item.
  //       For now, this is hardcoded.
  $has_session = true;
  $watching = false;

?>

<div class="container my-5">
<div style="max-width: 1000px; margin: 10px auto">
  <div class="card">
    <div class="card-body">

<div class="row"> <!-- Row #1 with auction title + watch button -->
  <div class="col-sm-8"> <!-- Left col -->
    <h2 class="my-3"><?php echo($itemName); ?></h2>
  </div>
  <div class="col-sm-4 align-self-center"> <!-- Right col -->
<?php
  /* The following watchlist functionality uses JavaScript, but could
     just as easily use PHP as in other places in the code */
  if ($now < $end_time):
?>
    <div id="watch_nowatch" <?php if ($has_session && $watching) echo('style="display: none"');?> >
      <button type="button" class="btn btn-outline-secondary btn-sm" onclick="addToWatchlist()">+ Add to watchlist</button>
    </div>
    <div class="col-sm-4 align-self-center">
      <!-- Right col -->
      <?php
      /* The following watchlist functionality uses JavaScript, but could
     just as easily use PHP as in other places in the code */
      if ($now > $end_time) :
      ?>
        <div id="watch_nowatch" <?php if ($has_session && $watching) echo ('style="display: none"'); ?>>
          <button type="button" class="btn btn-outline-secondary btn-sm" onclick="addToWatchlist()">+ Add to watchlist</button>
        </div>
        <div id="watch_watching" <?php if (!$has_session || !$watching) echo ('style="display: none"'); ?>>
          <button type="button" class="btn btn-success btn-sm" disabled>Watching</button>
          <button type="button" class="btn btn-danger btn-sm" onclick="removeFromWatchlist()">Remove watch</button>
        </div>
      <?php endif /* Print nothing otherwise */ ?>
    </div>
  </div>

  <div class="row">
    <!-- Row #2 with auction description + bidding info -->
    <div class="col-sm-8">
      <!-- Left col with item info -->

    <div class="itemDescription">
    Description: <?php echo($description); ?>
    </div>
	<div class="itemcategory">
    Category: <?php echo($category); ?>
    </div>
	<div class="itemcondition">
    Condition: <?php echo($condition); ?>
    </div>
	<div class="itemdelivery">
    Delivery: <?php echo($delivery); ?>
    </div>


  </div>

  <div class="col-sm-4"> <!-- Right col with bidding info -->
   <?php if ($num_bids == 1) {
    echo $num_bids, ' Bid';
  }
  else {
    echo $num_bids, ' Bids';
  } ?>

    <p>
<?php if ($now > $end_time): ?> 
     This auction ended on: <?php echo(date_format($end_time, 'j M H:i')) ?></p>
	 <div>
	 <?php if ($current_price < $reservePrice || $current_price == 0) {  ?>
	This item was not sold
	 <?php } else { ?>
	 This item sold for: £<?php echo number_format($current_price, 2)?>
	 <div>
	 Plus 0.05% commission: £<?php echo number_format($commission, 2)?>
	 </div>
	 Total price: £<?php echo number_format($finalPrice, 2)?>
	 <?php }
	 ?>
	 </div>
     <!-- ARI: loop added: if auction time passed, 
	 checks if the price exceeded 0 or reserve price.
	Calculates commission and prints the total-->


<?php else: ?>
     Auction ends: <?php echo(date_format($end_time, 'j M H:i') . $time_remaining) ?>
	<div>
	 <?php if ($current_price != 0) { ?> 
	 Current total: £<?php echo number_format($current_price, 2)?>
	 <?php } else { ?>
	 The start price is: £<?php echo number_format($startPrice, 2)?>
	 <?php }
	 ?>
	 </div>
  	 <!-- ARI: loop added: if auction active, if no bids then start price displayed. 
	 If bidding has started then current price displayed -->
	 
    <!-- Bidding form -->
    
	<form method="POST" action="place_bid.php">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">£</span>
        </div>
        <button type="submit" class="btn btn-primary form-control">Place bid</button>
      </form>
    <?php endif ?>


    </div> <!-- End of right col with bidding info -->

  </div> <!-- End of row #2 -->



  <?php include_once("footer.php") ?>


  <script>
    // JavaScript functions: addToWatchlist and removeFromWatchlist.

    function addToWatchlist(button) {
      console.log("These print statements are helpful for debugging btw");
      console.log(<?php echo ($item_id); ?>)
      // This performs an asynchronous call to a PHP function using POST method.
      // Sends item ID as an argument to that function.
      $.ajax('watchlist_funcs.php', {
        type: "POST",
        data: {
          functionname: 'add_to_watchlist',
          arguments: [<?php echo ($item_id); ?>]
        },

        success: function(obj, textstatus) {
          // Callback function for when call is successful and returns obj
          console.log("Success");
          var objT = obj.trim();
          console.log("objT: " + objT);
          if (objT == "success") {
            $("#watch_nowatch").hide();
            $("#watch_watching").show();
          } else {
            var mydiv = document.getElementById("watch_nowatch");
            mydiv.appendChild(document.createElement("br"));
            mydiv.appendChild(document.createTextNode("Add to watch failed. Try again later."));
          }
        },

        error: function(obj, textstatus) {
          console.log("Error");
        }
      }); // End of AJAX call

    } // End of addToWatchlist func

    function removeFromWatchlist(button) {
      // This performs an asynchronous call to a PHP function using POST method.
      // Sends item ID as an argument to that function.
      $.ajax('watchlist_funcs.php', {
        type: "POST",
        data: {
          functionname: 'remove_from_watchlist',
          arguments: [<?php echo ($item_id); ?>]
        },

        success: function(obj, textstatus) {
          // Callback function for when call is successful and returns obj
          console.log("Success");
          var objT = obj.trim();
          console.log("OBJECT: ");
          if (objT == "success") {
            $("#watch_watching").hide();
            $("#watch_nowatch").show();
          } else {
            var mydiv = document.getElementById("watch_watching");
            mydiv.appendChild(document.createElement("br"));
            mydiv.appendChild(document.createTextNode("Watch removal failed. Try again later."));
          }
        },

        error: function(obj, textstatus) {
          console.log("Error");
        }
      }); // End of AJAX call

    } // End of addToWatchlist func
  </script>