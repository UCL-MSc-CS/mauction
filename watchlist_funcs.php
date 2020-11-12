<?php include("connection.php")?>
 <?php
  $userID = 4;
  $saleItemID = ($_POST['arguments']);
  if (!isset($_POST['functionname']) || !isset($_POST['arguments'])) {
    return;
  }

  // Extract arguments from the POST variables:
  $item_id = $_POST['arguments'];

  if ($_POST['functionname'] == "add_to_watchlist") {
    // TODO: Update database and return success/failure.
    $query = "INSERT INTO watchlist (userID, saleItemID) VALUES ('$userID','$saleItemID')";
    if (!mysqli_query($connection, $query)) {die('Error: ' . mysqli_error($connection));}
    // $res = "success";
    $res = $query;
  } else if ($_POST['functionname'] == "remove_from_watchlist") {
    // TODO: Update database and return success/failure.
    $query = "DELETE FROM watchlist WHERE userID = '$userID' AND saleItemID = '$saleItemID'";
    if (!mysqli_query($connection, $query)) {die('Error: ' . mysqli_error($connection));}
    $res = "success";
  }

  // Note: Echoing from this PHP function will return the value as a string.
  // If multiple echo's in this file exist, they will concatenate together,
  // so be careful. You can also return JSON objects (in string form) using
  // echo json_encode($res).
  echo $res;

  ?>