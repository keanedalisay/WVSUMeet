<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $db = mysqli_connect('localhost', 'root', '', 'meet.wvsu');

  $wids = ['2022M0017', '2022M0257'][round(mt_rand(0, 1))];
  $gbl_msg = filter_input(INPUT_POST, 'user_gbl_msg', FILTER_SANITIZE_SPECIAL_CHARS);
  $msg_id = uniqid(random_bytes(5));
  $time_sent = date('Y-m-d h:i:m');

  $_SESSION['LST_TIME_MSG'] = $time_sent;

  mysqli_query($db, "INSERT INTO gbl_msgs(Msg, WID, Msg_ID, Time_Sent) VALUES ('$gbl_msg', '$wids', '$msg_id', '$time_sent')");
  mysqli_close($db);
  header('Location: dshbrd.php', true, 303);
  exit;
}
?>