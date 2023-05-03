<?php

require_once('../hlprs/sess.php');

sessStart('CREDS');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $conn = mysqli_connect('localhost', 'root', '', 'meet.wvsu');

  $user_wid = htmlspecialchars($_SESSION['user_wid']);
  $msg_id = uniqid(random_bytes(5));
  $gbl_msg = htmlspecialchars($_POST['user_gbl_msg']);

  $time_sent = time();

  $gbl_msg_sql = "INSERT INTO gbl_msgs(WVSU_ID, Msg_ID, Msg, Time_Sent) VALUES (?, ?, ?, ?)";
  $prep_gbl_msg = mysqli_prepare($conn, $gbl_msg_sql);
  mysqli_stmt_bind_param($prep_gbl_msg, 'sssi', $user_wid, $msg_id, $gbl_msg, $time_sent);
  mysqli_stmt_execute($prep_gbl_msg);
  mysqli_stmt_close($prep_gbl_msg);

  mysqli_close($conn);
  header('Location: ../../public/pages/dshbrd.php', true, 303);
  exit;
}
?>