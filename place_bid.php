<?php include 'connection.php' ?>
<?php include_once("header.php") ?>

<?php
// TODO: Extract $_POST variables, check they're OK, and attempt to make a bid.
// Notify user of success/failure and redirect/give navigation options.

// Matt 01/11: connect->extract and check variables -> INSERT query -> close db connection ?.

<!-- Create auction form -->
<div style="max-width: 800px; margin: 10px auto">
  <h2 class="my-3">Place a bid</h2>
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
          <label for="bidAmount" class="col-sm-2 col-form-label text-right">Bid Amount</label>
          <div class="col-sm-10">
	        <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">£</span>
              </div>
              <input type="number" class="form-control" name="bidAmount" id="bidAmount">
            </div>
            <small id="placeBidHelp" class="form-text text-muted"><span class="text-danger">* Required.</span> How much are you bidding?.</small>
          </div>
        </div>
       
        <button type="submit" name="submit" class="btn btn-primary form-control">Place Bid</button>
      </form>
    </div>
  </div>
</div>

</div>


<?php include_once("footer.php")?>

