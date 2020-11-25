<?php
include 'connection.php';
?>
<?php include_once("header.php") ?>
<?php require("utilities.php") ?>
<div class="container">
  <?php
  if (isset($_GET['search'])) {
    $keyword = mysqli_real_escape_string($connection, $_GET['keyword']);
    $cat = mysqli_real_escape_string($connection, $_GET['cat']);
    $order_by = mysqli_real_escape_string($connection, $_GET['order_by']);
    if ($keyword == "") {
      $keyworderror = "Please enter a search keyword.";
    }
    if ($cat == "none") {
      $caterror = "Please enter a search category.";
    }
    if ($order_by == "none") {
      $order_byerror = "Please enter a search sort by.";
    }
  }
  ?>
  <h2 class="my-3">Browse Listings</h2>

  <div id="searchSpecs">
    <form method="get">
      <div class="row">
        <div class="col-md-5 pr-0">
          <div class="form-group">
            <label for="keyword" class="sr-only">Search Keyword:</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text bg-transparent pr-0 text-muted">
                  <i class="fa fa-search"></i>
                </span>
              </div>
              <input type="text" class="form-control border-left-0" id="keyword" name="keyword" placeholder="Search for anything">
            </div>
            <?php
            if (isset($keyworderror) && !empty($keyworderror)) {
            ?>
              <div class="error" style="color: red"><?= $keyworderror; ?></div>
            <?php
            }
            ?>
          </div>
        </div>
        <div class="col-md-3 pr-0">
          <div class="form-group">
            <label for="cat" class="sr-only">Search Within:</label>
            <select class="form-control" id="cat" name="cat">
              <option selected value="none">Category</option>
              <option value="All Categories">All Categories</option>
              <option value="Books">Books</option>
              <option value="Health">Health</option>
              <option value="Home Decor">Home Decor</option>
              <option value="Sports and Fitness">Sports and Fitness</option>
            </select>
            <?php
            if (isset($caterror) && !empty($caterror)) {
            ?>
              <div class="error" style="color: red"><?= $caterror; ?></div>
            <?php
            }
            ?>
          </div>
        </div>
        <div class="col-md-3 pr-0">
          <div class="form-inline">
            <label for="order_by" class="sr-only">Sort By:</label>
            <select class="form-control" id="order_by" name="order_by">
              <option selected value="none">Sort By</option>
              <option value="Low to High">Price (low to high)</option>
              <option value="High to Low">Price (high to low)</option>
              <option value="Soonest expiry">Soonest expiry</option>
            </select>
            <?php
            if (isset($order_byerror) && !empty($order_byerror)) {
            ?>
              <div class="error" style="color: red"><?= $order_byerror; ?></div>
            <?php
            }
            ?>
          </div>
        </div>
        <div class="col-md-1 px-0">
          <button type="submit" name="search" class="btn btn-primary">Search</button>
        </div>
      </div>
    </form>
  </div>

</div>

<div class="container mt-5">

  <ul class="list-group">

    <?php
    if (!isset($_GET['search'])) {
      $query = "SELECT Auction.saleItemID, Auction.startPrice, Auction.itemName, Auction.description, Auction.endDate, MAX(bidAmount) as maxBid, COUNT(bidID) as countBid FROM Auction LEFT JOIN Bid ON Auction.saleItemID = Bid.saleItemID GROUP BY Auction.saleItemID ORDER BY itemName ASC";
      $result = mysqli_query($connection, $query) or die('Error making select users query' . mysqli_error());
      $queryres = mysqli_num_rows($result);
      while ($row = mysqli_fetch_assoc($result)) {
        $item_id = $row['saleItemID'];
        $title = $row['itemName'];
        $description = $row['description'];
        $end_date = $row['endDate'];
        if ($row['maxBid'] == null) {
          $current_price = $row['startPrice'];
          $num_bids = 0;
        } else {
          $current_price = $row['maxBid'];
          $num_bids = $row['countBid'];
        }
        print_listing_li($item_id, $title, $description, $current_price, $num_bids, $end_date);
      }
    }
    if (!isset($_GET['page'])) {
      $curr_page = 1;
    } else {
      $curr_page = $_GET['page'];
    }
    global $max_page;
    $num_results = $auctionQueryRes;
    $results_per_page = 2;
    $max_page = ceil($num_results / $results_per_page);
    if (isset($_GET['search'])) {
      $keyword = mysqli_real_escape_string($connection, $_GET['keyword']);
      $cat = mysqli_real_escape_string($connection, $_GET['cat']);
      $order_by = mysqli_real_escape_string($connection, $_GET['order_by']);
      if (($keyword != "") && ($cat != "none") && ($order_by != "none")) {
        searchKey($connection, $keyword, $cat, $order_by);
      }
    }
    function searchKey($connection, $keyword, $cat, $order_by)
    {
      if ($cat == "All Categories") {
        $querycat = "";
      } else {
        $querycat = " AND category = '$cat'";
      }
      if ($order_by == "Low to High") {
        $queryorder = " ORDER BY startPrice ASC";
      } elseif ($order_by == "High to Low") {
        $queryorder = " ORDER BY startPrice DESC";
      } else {
        $queryorder = " ORDER BY endDate DESC";
      }

      $query2 = "SELECT Auction.saleItemID, Auction.startPrice, Auction.itemName, Auction.description, Auction.endDate, MAX(bidAmount) as maxBid, COUNT(bidID) as countBid FROM Auction LEFT JOIN Bid ON Auction.saleItemID = Bid.saleItemID WHERE Auction.itemName LIKE '%$keyword%'$querycat GROUP BY Auction.saleItemID $queryorder";
      $result2 = mysqli_query($connection, $query2) or die('Error making select users query' . mysqli_error());
      $queryres2 = mysqli_num_rows($result2);
      if ($queryres2 == 0) {
        echo ('<div class="error" style="color: red">Sorry, no results.</div>');
      } else {
        while ($row2 = mysqli_fetch_assoc($result2)) {
          $item_id = $row2['saleItemID'];
          $title = $row2['itemName'];
          $description = $row2['description'];
          $end_date = $row2['endDate'];
          if ($row2['maxBid'] == null) {
            $current_price = $row2['startPrice'];
            $num_bids = 0;
          } else {
            $current_price = $row2['maxBid'];
            $num_bids = $row2['countBid'];
          }
          print_listing_li($item_id, $title, $description, $current_price, $num_bids, $end_date);
        }
        global $max_page;
        $num_results = $queryres2;
        $results_per_page = 2;
        $max_page = ceil($num_results / $results_per_page);
      }
    }
    ?>
  </ul>

  <nav aria-label="Search results pages" class="mt-5">
    <ul class="pagination justify-content-center">

      <?php

      $querystring = "";
      foreach ($_GET as $key => $value) {
        if ($key != "page") {
          $querystring .= "$key=$value&amp;";
        }
      }

      $high_page_boost = max(3 - $curr_page, 0);
      $low_page_boost = max(2 - ($max_page - $curr_page), 0);
      $low_page = max(1, $curr_page - 2 - $low_page_boost);
      $high_page = min($max_page, $curr_page + 2 + $high_page_boost);

      if ($curr_page != 1) {
        echo ('
    <li class="page-item">
      <a class="page-link" href="browse.php?' . $querystring . 'page=' . ($curr_page - 1) . '" aria-label="Previous">
        <span aria-hidden="true"><i class="fa fa-arrow-left"></i></span>
        <span class="sr-only">Previous</span>
      </a>
    </li>');
      }

      for ($i = $low_page; $i <= $high_page; $i++) {
        if ($i == $curr_page) {
          echo ('
    <li class="page-item active">');
        } else {
          echo ('
    <li class="page-item">');
        }
        echo ('
      <a class="page-link" href="browse.php?' . $querystring . 'page=' . $i . '">' . $i . '</a>
    </li>');
      }

      if ($curr_page != $max_page) {
        echo ('
    <li class="page-item">
      <a class="page-link" href="browse.php?' . $querystring . 'page=' . ($curr_page + 1) . '" aria-label="Next">
        <span aria-hidden="true"><i class="fa fa-arrow-right"></i></span>
        <span class="sr-only">Next</span>
      </a>
    </li>');
      }
      ?>

    </ul>
  </nav>

</div>

<?php include_once("footer.php") ?>