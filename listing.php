<?php include_once("header.php") ?>
<?php require("utilities.php") ?>
<?php include("connection.php") ?>

<?php
$item_id = $_GET['item_id'];

$query = "SELECT Auction.*, MAX(bidAmount), COUNT(bidID) 
	  FROM Auction, Bid where Auction.saleItemID=$item_id and Bid.saleItemID=$item_id";
$result = mysqli_query($connection, $query) or die('Error making select bid and auction query' . mysqli_error($connection));
$queryRes = mysqli_num_rows($result);
while ($row = mysqli_fetch_assoc($result)) {
  $item_id = $row['saleItemID'];
  $userID = $row['userName'];
  $itemName = $row['itemName'];
  $description = $row['description'];
  $category = $row['category'];
  $condition = $row['itemCondition'];
  $delivery = $row['delivery'];
  $startPrice = $row['startPrice'];
  $endDate = $row['endDate'];
  $current_price = $row['MAX(bidAmount)'];
  $num_bids = $row['COUNT(bidID)'];
}

$end_time = new DateTime($endDate);
$commission = (0.05 * $current_price);
$finalPrice = ($current_price - $commission);

$now = new DateTime("now");

if ($now < $end_time) {
  $time_to_end = date_diff($now, $end_time);
  $time_remaining = ' (in ' . display_time_remaining($time_to_end) . ')';
}

$has_session = "";

?>
<?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) : ?>

  <?php
  if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    $user = $_SESSION['username'];
    $watching = false;
    $has_session = true;
    $query = "SELECT * FROM Watchlist WHERE userName='$user' and saleItemID='$item_id'";
    $result = mysqli_query($connection, $query) or die('Error making select users query' . mysqli_error($connection));
    $queryRes = mysqli_num_rows($result);
    if (!empty($queryRes)) {
      $watching = true;
    }
  }

  ?>

  <div class="container my-5">
    <div style="max-width: 1000px; margin: 10px auto">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-8">
              <h2 class="my-3"><?php echo ($itemName); ?></h2>
            </div>
            <div class="col-sm-4 align-self-center">
              <?php
              if ($now < $end_time) :
              ?>
                <div id="watch_nowatch" <?php if ($has_session && $watching) echo ('style="display: none"'); ?>>
                  <button type="button" class="btn btn-outline-secondary btn-sm" onclick="addToWatchlist()">+ Add to watchlist</button>
                </div>
                <div id="watch_watching" <?php if (!$has_session || !$watching) echo ('style="display: none"'); ?>>
                  <button type="button" class="btn btn-success btn-sm" disabled>Watching</button>
                  <button type="button" class="btn btn-danger btn-sm" onclick="removeFromWatchlist()">Remove watch</button>
                </div>
              <?php endif ?>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-8">

              <div class="itemDescription">
                Description: <?php echo ($description); ?>
              </div>
              <div class="itemcategory">
                Category: <?php echo ($category); ?>
              </div>
              <div class="itemcondition">
                Condition: <?php echo ($condition); ?>
              </div>
              <div class="itemdelivery">
                Delivery: <?php echo ($delivery); ?>
              </div>


            </div>

            <div class="col-sm-4">
              <?php if ($num_bids == 1) {
                echo $num_bids, ' Bid';
              } else {
                echo $num_bids, ' Bids';
              } ?>

              <p>
                <?php if ($now > $end_time) : ?>
                  This auction ended on: <?php echo (date_format($end_time, 'j M H:i')) ?></p>
              <div>
                <?php if ($current_price == 0) {  ?>
                  This item was not sold
                <?php } else { ?>
                  The winning bid was: £<?php echo number_format($current_price, 2) ?>
                  <div>
                    We take 0.05% commission, which works out to £<?php echo number_format($commission, 2) ?> on this item
                    <div>
                      So, the seller receives: £<?php echo number_format($finalPrice, 2) ?>
                    <?php }
                    ?>
                    </div>

                  <?php else : ?>
                    Auction ends: <?php echo (date_format($end_time, 'j M H:i') . $time_remaining) ?>
                    <div>
                      <?php if ($current_price != 0) { ?>
                        Current total: £<?php echo number_format($current_price, 2) ?>
                      <?php } else { ?>
                        The start price is: £<?php echo number_format($startPrice, 2) ?>
                      <?php }
                      ?>
                    </div>

                    <form method="POST" action="place_bid_result.php?item_id=<?= $item_id ?>">
                      <div class="form-group row">
                        <div class="col-sm-10">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">£</span>
                            </div>
                            <input type="number" class="form-control" name="bidAmount" id="bidAmount">
                          </div>
                        </div>
                      </div>
                      <button type="submit" name="submit" class="btn btn-primary form-control">Place Bid</button>
                    </form>
                  <?php endif ?>

                <?php endif ?>
                  </div>
              </div>

              <?php include_once("footer.php") ?>

              <script>
                function addToWatchlist(button) {
                  console.log("These print statements are helpful for debugging");
                  $.ajax('watchlist_funcs.php', {
                    type: "POST",
                    data: {
                      functionname: 'add_to_watchlist',
                      arguments: [<?php echo ($item_id); ?>]
                    },

                    success: function(obj, textstatus) {
                      console.log("Success");
                      var objT = obj.trim();
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
                  });

                }

                function removeFromWatchlist(button) {
                  $.ajax('watchlist_funcs.php', {
                    type: "POST",
                    data: {
                      functionname: 'remove_from_watchlist',
                      arguments: [<?php echo ($item_id); ?>]
                    },

                    success: function(obj, textstatus) {
                      console.log("Success");
                      var objT = obj.trim();
                      console.log("objT " + objT);
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
                  });

                }
              </script>

              <?php if ($now < $end_time) : ?>
                <div class="container my-5">
                  <div style="max-width: 1000px; margin: 10px auto">
                    <div class="card">
                      <div class="card-body">
                        <div class="bidhistory">
                          <div class="row">
                            <div class="col-sm-8">
                              <h2 class="my-3">Bid History</h2>
                            </div>
                          </div>
                          <?php
                          $query = "SELECT * FROM Bid WHERE saleItemID=$item_id";
                          $result = mysqli_query($connection, $query) or die('Error making select users query' . mysqli_error($connection));
                          echo '<table style="width:70%">
      <th>Username</th>
      <th>Bid Time</th>
      <th>Bid Amount</th>';
                          while ($row = mysqli_fetch_assoc($result)) {
                            $userName = $row["userName"];
                            $bidTime = $row["bidTime"];
                            $bidAmount = $row["bidAmount"];
                            echo '<tr> 
        <td>' . $userName . ' </td>
        <td>' . $bidTime . ' </td>
        <td>£' . number_format($bidAmount, 2) . ' </td>
        </tr>';
                          }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endif; ?>