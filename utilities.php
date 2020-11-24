
<?php

function display_time_remaining($interval)
{

  if ($interval->days == 0 && $interval->h == 0) {
    $time_remaining = $interval->format('%im %Ss');
  } else if ($interval->days == 0) {
    $time_remaining = $interval->format('%hh %im');
  } else {
    $time_remaining = $interval->format('%ad %hh');
  }

  return $time_remaining;
}

function print_listing_li($item_id, $title, $desc, $price, $num_bids, $endDate)
{
  if (strlen($desc) > 250) {
    $desc_shortened = substr($desc, 0, 250) . '...';
  } else {
    $desc_shortened = $desc;
  }
  if ($num_bids == 1) {
    $bid = ' bid';
  } else {
    $bid = ' bids';
  }

  $end_time = new DateTime($endDate);
  $now = new DateTime("now");
  if ($now > $end_time) {
    $time_remaining = 'This auction has ended';
  } else {
    $time_to_end = date_diff($now, $end_time);
    $time_remaining = display_time_remaining($time_to_end) . ' remaining';
  }

  echo ('
    <li class="list-group-item d-flex justify-content-between">
    <div class="p-2 mr-5"><h5><a href="listing.php?item_id=' . $item_id . '">' . $title . '</a></h5>' . $desc_shortened . '</div>
    <div class="text-center text-nowrap"><span style="font-size: 1.5em">£' . number_format($price, 2) . '</span><br/>' . $num_bids . $bid . '<br/>' . $time_remaining . '</div>
  </li>');
}

?>