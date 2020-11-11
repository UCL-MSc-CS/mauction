<?php include 'connection.php' ?>
<?php include_once("header.php") ?>

<?php 
// TODO: Extract $_POST variables, check they're OK, and attempt to make a bid.
// Notify user of success/failure and redirect/give navigation options.

// Matt 01/11: connect->extract and check variables -> INSERT query -> close db connection

<!-- Create auction form -->
<div style="max-width: 800px; margin: 10px auto">
  <h2 class="my-3">Create new auction</h2>
  <div class="card">
    <div class="card-body">
      <!-- Note: This form does not do any dynamic / client-side / 
      JavaScript-based validation of data. It only performs checking after 
      the form has been submitted, and only allows users to try once. You 
      can make this fancier using JavaScript to alert users of invalid data
      before they try to send it, but that kind of functionality should be
      extremely low-priority / only done after all database functions are
      complete. -->
      <form method="post" action="place_bid_result.php">              
        <div class="form-group row">
          <label for="auctionTitle" class="col-sm-2 col-form-label text-right">Title of auction</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="auctionTitle" id="auctionTitle" placeholder="e.g. Black mountain bike">
            <small id="titleHelp" class="form-text text-muted"><span class="text-danger">* Required.</span> A short description of the item you're selling, which will display in listings.</small>
          </div>
        </div>
        <div class="form-group row">
          <label for="auctionDetails" class="col-sm-2 col-form-label text-right">Details</label>
          <div class="col-sm-10">
            <textarea class="form-control" name="auctionDetails" id="auctionDetails" rows="4"></textarea>
            <small id="detailsHelp" class="form-text text-muted">Full details of the listing to help bidders decide if it's what they're looking for.</small>
          </div>
        </div>
	<div class="form-group row">
	  <label for="condition" class="col-sm-2 col-form-label text-right">Condition</label>
	  <div class="col-sm-10">
	    <select class="form-control" name="condition" id="condition">
 	      <option value=""> </option>
              <option value="new">New</option>
              <option value="used_new">Used-Like New</option>
	      <option value="used">Used</option>
            </select>
            <small id="categoryHelp" class="form-text text-muted"><span class="text-danger">* Required.</span> Specify the item's condition.</small>
          </div>
        </div>
        <div class="form-group row">
          <label for="auctionCategory" class="col-sm-2 col-form-label text-right">Category</label>
          <div class="col-sm-10">
            <select class="form-control" name="auctionCategory" id="auctionCategory">
              <option value=""> </option>
              <option value="homeware">Homeware</option>
              <option value="fashion">Fashion</option>
              <option value="electronics">Electronics</option>
	      <option value="healthbeauty">Health & Beauty</option>
	      <option value="sportsfit">Sports & Fitness</option>
	      <option value="entertainment">Films, TV, Musics, Games</option>
            </select>
            <small id="categoryHelp" class="form-text text-muted"><span class="text-danger">* Required.</span> Select a category for this item.</small>
          </div>
        </div>
        <div class="form-group row">
          <label for="auctionStartPrice" class="col-sm-2 col-form-label text-right">Starting price</label>
          <div class="col-sm-10">
	        <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">£</span>
              </div>
              <input type="number" class="form-control" name="auctionStartPrice" id="auctionStartPrice">
            </div>
            <small id="startBidHelp" class="form-text text-muted"><span class="text-danger">* Required.</span> Initial bid amount.</small>
          </div>
        </div>
        <div class="form-group row">
          <label for="auctionReservePrice" class="col-sm-2 col-form-label text-right">Reserve price</label>
          <div class="col-sm-10">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">£</span>
              </div>
              <input type="number" class="form-control" name="auctionReservePrice" id="auctionReservePrice">
            </div>
            <small id="reservePriceHelp" class="form-text text-muted">Optional. Auctions that end below this price will not go through. This value is not displayed in the auction listing.</small>
          </div>
        </div>
        <div class="form-group row">
          <label for="auctionEndDate" class="col-sm-2 col-form-label text-right">End date</label>
          <div class="col-sm-10">
            <input type="date" class="form-control" name="auctionEndDate" id="auctionEndDate">
            <small id="endDateHelp" class="form-text text-muted"><span class="text-danger">* Required.</span> Day for the auction to end.</small>
          </div>
        </div>
	<div class="form-group row">
          <label for="auctionEndTime" class="col-sm-2 col-form-label text-right">End Time</label>
          <div class="col-sm-10">
            <input type="time" class="form-control" name="auctionEndTime" id="auctionEndTime" step="2">
            <small id="endTimeHelp" class="form-text text-muted"><span class="text-danger">* Required.</span> Time for the auction to end.</small>
          </div>
        </div>
	<div class="form-group row">
          <label for="delivery" class="col-sm-2 col-form-label text-right">Delivery Method</label>
          <div class="col-sm-10">
            <select class="form-control" name="delivery" id="delivery">
              <option value=""> </option>
              <option value="post_1">Mail-First Class</option>
              <option value="post_2">Mail-Second Class</option>
              <option value="pick-up">Pick-up in person</option>
              <option value="other">Other</option>
            </select>
            <small id="categoryHelp" class="form-text text-muted"><span class="text-danger">* Required.</span> Specify the item's delivery method.</small>
          </div>
        </div>
        <button type="submit" name="submit" class="btn btn-primary form-control">Create Auction</button>
      </form>
    </div>
  </div>
</div>

</div>


<?php include_once("footer.php")?>

?>
