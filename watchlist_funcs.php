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

  if ($_POST['functionname'] == "add_to_watchlist") {
    $query = "INSERT INTO Watchlist (userName, saleItemID) VALUES ('$userName','$item_id')";
    if (!mysqli_query($connection, $query)) {
      die('Error: ' . mysqli_error($connection));
    }
    $res = "success";
  } else if ($_POST['functionname'] == "remove_from_watchlist") {
    $query = "DELETE FROM Watchlist WHERE userName = '$userName' AND saleItemID = '$item_id'";
    if (!mysqli_query($connection, $query)) {
      die('Error: ' . mysqli_error($connection));
    }
    $res = "success";
  }

  echo $res;

  ?>