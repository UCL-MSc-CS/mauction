<?php include("connection.php") ?>

 <?php
  // $userName = "erinuclkwon";
  $array = $_POST['arguments'];
  $array2 = $_POST['user'];
  $userName = $array2[0];
  $item_id = $array[0];
  // $item_id = array_pop(array_reverse($_POST['arguments']));
  // $item_id = $_POST['arguments'];
  // $item_id = 10;
  if (!isset($_POST['functionname']) || !isset($_POST['arguments'])) {
    return;
  }

  // Extract arguments from the POST variables:


  if ($_POST['functionname'] == "add_to_watchlist") {
    // TODO: Update database and return success/failure.
    $query = "INSERT INTO watchlist (userName, saleItemID) VALUES ('$userName','$item_id')";
    if (!mysqli_query($connection, $query)) {
      die('Error: ' . mysqli_error($connection));
    }
    $res = "success";
  } else if ($_POST['functionname'] == "remove_from_watchlist") {
    // TODO: Update database and return success/failure.
    $query = "DELETE FROM watchlist WHERE userName = '$userName' AND saleItemID = '$item_id'";
    if (!mysqli_query($connection, $query)) {
      die('Error: ' . mysqli_error($connection));
    }
    $res = "success";
  }

  // Note: Echoing from this PHP function will return the value as a string.
  // If multiple echo's in this file exist, they will concatenate together,
  // so be careful. You can also return JSON objects (in string form) using
  // echo json_encode($res).
  echo $res;

  ?>