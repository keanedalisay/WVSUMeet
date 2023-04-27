<?php
session_start();

$_SESSION['LST_TIME_MSG'] = date('Y-m-d h:i:m');

$db = mysqli_connect('localhost', 'root', '', 'meet.wvsu');

$gbl_msgs_sql = mysqli_query($db, 'SELECT * FROM gbl_msgs');
$gbl_msgs = mysqli_fetch_all($gbl_msgs_sql, MYSQLI_ASSOC);

$crnt = '2022M0017';
foreach ($gbl_msgs as $gbl_msg) {
  $msg = $gbl_msg['Msg'];
  $msg_wid = $gbl_msg['WID'];

  $user_sql = mysqli_query($db, "SELECT Name, WID FROM users WHERE WID = '$msg_wid'");
  $user = mysqli_fetch_assoc($user_sql);

  $user_name = $user['Name'];
  $msg_cls = $crnt === $user['WID'] ? 'msg--user' : 'msg--others';

  echo "
    <li class='msg $msg_cls'>
      <cite class='msg-athr'>$user_name</cite>
      <blockquote class='msg-ctnt'>
        $msg
      </blockquote>
    </li>
  ";
}

mysqli_free_result($gbl_msgs_sql);
mysqli_free_result($user_sql);
mysqli_close($db);
?>