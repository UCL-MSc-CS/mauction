<?php include("connection.php") ?>

 <?php
  $array = $_POST['arguments'];
  $item_id = $array[0];
  $userName = $_SESSION['username'];
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