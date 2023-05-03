<?php
require_once('../hlprs/sess.php');

sessStart('CREDS');

$conn = mysqli_connect('localhost', 'root', '', 'meet.wvsu');
$time_sent = $_SESSION['lst_msg_time'];
$crnt_user_wid = htmlspecialchars($_SESSION['user_wid']);

$html_gbl_msgs = '';

$gbl_msgs_sql = mysqli_query($conn, "SELECT * FROM gbl_msgs WHERE Time_Sent > '$time_sent'");
$gbl_msgs = mysqli_fetch_all($gbl_msgs_sql, MYSQLI_ASSOC);

if (count($gbl_msgs) < 1)
  exit;

foreach ($gbl_msgs as $gbl_msg) {
  $msg = $gbl_msg['Msg'];
  $msg_wid = $gbl_msg['WVSU_ID'];

  $user_sql = mysqli_query($conn, "SELECT Name, WVSU_ID FROM users WHERE WVSU_ID = '$msg_wid'");
  $user = mysqli_fetch_assoc($user_sql);

  $user_name = $user["Name"];
  $msg_cls = $crnt_user_wid === $user['WVSU_ID'] ? 'msg--user' : 'msg--others';
  $time_comp = $gbl_msg['Time_Sent'];
  $time_comp2 = $time_comp > $time_sent;

  $html_gbl_msgs .= "
    <li class='msg $msg_cls'>
      <cite class='msg-athr'>$user_name</cite>
      <blockquote class='msg-ctnt'>
        $msg
      </blockquote>
    </li>";
}

echo $html_gbl_msgs;

$_SESSION['lst_msg_time'] = time();
?>