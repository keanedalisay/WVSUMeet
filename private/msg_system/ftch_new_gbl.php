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

  $is_crnt_user = $crnt_user_wid === $user['WVSU_ID'];

  $user_name = $is_crnt_user ? 'You' : $user['Name'];
  $msg_cls = $is_crnt_user ? 'msg--user' : 'msg--others';

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