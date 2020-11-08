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
    // Retrieve these from the URL
    if ($keyword == "") {
      // TODO: Define behavior if a keyword has not been specified.
      $keyworderror = "Please enter a search keyword.";
    }
    if ($cat == "none") {
      // TODO: Define behavior if a category has not been specified.
      $caterror = "Please enter a search category.";
    }
    if ($order_by == "none") {
      // TODO: Define behavior if an order_by value has not been specified.
      $order_byerror = "Please enter a search sort by.";
    }
  }
  /* TODO: Use above values to construct a query. Use this query to 
     retrieve data from the database. (If there is no form data entered,
     decide on appropriate default value/default query to make. */
  ?>
  <h2 class="my-3">Browse listings</h2>

  <div id="searchSpecs">
    <!-- When this form is submitted, this PHP page is what processes it.
     Search/sort specs are passed to this page through parameters in the URL
     (GET method of passing data to a page). -->
    <form method="get">
      <div class="row">
        <div class="col-md-5 pr-0">
          <div class="form-group">
            <label for="keyword" class="sr-only">Search keyword:</label>
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
            <label for="cat" class="sr-only">Search within:</label>
            <select class="form-control" id="cat" name="cat">
              <option selected value="none">Category</option>
              <option value="All Categories">All Categories</option>
              <!-- Matt 01/11: This is where we can add our own category names -->
              <option value="Health">Health</option>
              <option value="Mental Wellbeing">Mental Wellbeing</option>
              <option value="Home Decor">Home Decor</option>
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
            <label for="order_by" class="sr-only">Sort by:</label>
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
  </div> <!-- end search specs bar -->

</div>

<div class="container mt-5">

  <!-- TODO: If result set is empty, print an informative message. Otherwise... -->

  <ul class="list-group">

    <?php
    if (!isset($_GET['search'])) {
      $query = "SELECT userID, itemName, description, startPrice, commission, endDate FROM auctions ORDER BY itemName ASC";
      $result = mysqli_query($connection, $query) or die('Error making select users query' . mysql_error());
      $queryRes = mysqli_num_rows($result);
      while ($row = mysqli_fetch_assoc($result)) {
        $item_id = $row['userID'];
        $title = $row['itemName'];
        $description = $row['description'];
        $current_price = $row['startPrice'];
        $num_bids = $row['commission'];
        $end_date = $row['endDate'];
        // This uses a function defined in utilities.php
        print_listing_li($item_id, $title, $description, $current_price, $num_bids, $end_date);
      }
    }
    if (!isset($_GET['page'])) {
      $curr_page = 1;
    } else {
      $curr_page = $_GET['page'];
    }
    global $max_page;
    $num_results = $queryRes; // TODO: Calculate me for real
    $results_per_page = 2;
    $max_page = ceil($num_results / $results_per_page);
    if (isset($_GET['search'])) {
      $keyword = mysqli_real_escape_string($connection, $_GET['keyword']);
      $cat = mysqli_real_escape_string($connection, $_GET['cat']);
      $order_by = mysqli_real_escape_string($connection, $_GET['order_by']);
      // Retrieve these from the URL
      if (($keyword != "") && ($cat != "none") && ($order_by != "none")) {
        // TODO: Define behavior if a keyword has not been specified.
        searchKey($connection, $keyword, $cat, $order_by);
      }
    }
    // TODO: Use a while loop to print a list item for each auction listing retrieved from the query
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

      $query = "SELECT userID, itemName, description, startPrice, commission, endDate FROM auctions WHERE itemName LIKE '%$keyword%'$querycat$queryorder";
      $result = mysqli_query($connection, $query) or die('Error making select users query' . mysql_error());
      $queryRes = mysqli_num_rows($result);
      if ($queryRes == 0) {
        echo ('<div class="error" style="color: red">Sorry, no results.</div>');
      } else {
        while ($row = mysqli_fetch_assoc($result)) {
          $item_id = $row['userID'];
          $title = $row['itemName'];
          $description = $row['description'];
          $current_price = $row['startPrice'];
          $num_bids = $row['commission'];
          $end_date = $row['endDate'];
          // This uses a function defined in utilities.php
          print_listing_li($item_id, $title, $description, $current_price, $num_bids, $end_date);
        }
        /* For the purposes of pagination, it would also be helpful to know the
              total number of results that satisfy the above query */
        global $max_page;
        $num_results = $queryRes; // TODO: Calculate me for real
        $results_per_page = 2;
        $max_page = ceil($num_results / $results_per_page);
      }
    }
    ?>
  </ul>

  <!-- Pagination for results listings -->
  <nav aria-label="Search results pages" class="mt-5">
    <ul class="pagination justify-content-center">

      <?php

      // Copy any currently-set GET variables to the URL.
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

      // Puts a <- arrow all the way on the right when you're not on the first page
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
          // Highlight the link
          // Makes sure the page you are on is highlighted
          echo ('
    <li class="page-item active">');
        } else {
          // Non-highlighted link
          // Makes sure the not-current page number is not highlighted
          echo ('
    <li class="page-item">');
        }
        // Do this in any case
        // Displays the total range of page numbers
        echo ('
      <a class="page-link" href="browse.php?' . $querystring . 'page=' . $i . '">' . $i . '</a>
    </li>');
      }

      // The very left arrow when we're not on the last page
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