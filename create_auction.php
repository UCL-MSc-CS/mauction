<?php include ("header.php") ?>

<div class="container">

  <div style="max-width: 800px; margin: 10px auto">
    <h2 class="my-3">Create New Auction</h2>
    <div class="card">
      <div class="card-body">
        <form method="post" action="create_auction_result.php">
          <div class="form-group row">
            <label for="auctionTitle" class="col-sm-2 col-form-label text-right">Title of Auction</label>
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
                <option value="New">New</option>
                <option value="Used-Like New">Used-Like New</option>
                <option value="Used">Used</option>
              </select>
              <small id="categoryHelp" class="form-text text-muted"><span class="text-danger">* Required.</span> Specify the item's condition.</small>
            </div>
          </div>
          <div class="form-group row">
            <label for="auctionCategory" class="col-sm-2 col-form-label text-right">Category</label>
            <div class="col-sm-10">
              <select class="form-control" name="auctionCategory" id="auctionCategory">
                <option value=""> </option>
                <option value="Books">Books</option>
                <option value="Health">Health</option>
                <option value="Home Decor">Home Decor</option>
                <option value="Sports and Fitness">Sports and Fitness</option>
              </select>
              <small id="categoryHelp" class="form-text text-muted"><span class="text-danger">* Required.</span> Select a category for this item.</small>
            </div>
          </div>
          <div class="form-group row">
            <label for="auctionStartPrice" class="col-sm-2 col-form-label text-right">Starting Price</label>
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
          <label for="auctionReservePrice" class="col-sm-2 col-form-label text-right">Reserve Price</label>
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
              <input type="datetime-local" class="form-control" name="auctionEndDate" id="auctionEndDate">
              <small id="endDateHelp" class="form-text text-muted"><span class="text-danger">* Required.</span> Day for the auction to end.</small>
            </div>
          </div>
          <div class="form-group row">
            <label for="delivery" class="col-sm-2 col-form-label text-right">Delivery Method</label>
            <div class="col-sm-10">
              <select class="form-control" name="delivery" id="delivery">
                <option value=""> </option>
                <option value="Mail-First Class">Mail-First Class</option>
                <option value="Mail-Second Class">Mail-Second Class</option>
                <option value="Pick-up in person">Pick-up in person</option>
                <option value="Other">Other</option>
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

<?php include_once("footer.php") ?>