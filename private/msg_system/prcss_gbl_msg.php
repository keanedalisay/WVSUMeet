<?php

require_once('../hlprs/sess.php');

sessStart('CREDS');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $conn = mysqli_connect('meet_wvsu_db', 'root', '123', 'meet.wvsu');

  $user_wid = htmlspecialchars($_SESSION['user_wid']);
  $msg_id = uniqid(random_bytes(5));
  $gbl_msg = htmlspecialchars($_POST['user_gbl_msg']);

  $time_sent = time();

  $gbl_msg_sql = "INSERT INTO gbl_msgs(Msg, Time_Sent, WVSU_ID, Msg_ID) VALUES (?, ?, ?, ?)";
  $prep_gbl_msg = mysqli_prepare($conn, $gbl_msg_sql);
  mysqli_stmt_bind_param($prep_gbl_msg, 'siss', $gbl_msg, $time_sent, $user_wid, $msg_id);
  mysqli_stmt_execute($prep_gbl_msg);
  mysqli_stmt_close($prep_gbl_msg);

  mysqli_close($conn);
  header('Location: ../../public/pages/dshbrd.php', true, 303);
  exit;
}
?>