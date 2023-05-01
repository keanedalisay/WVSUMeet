<?php
$login_path = 'login.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  session_name('CREDS');
  session_start();

  $user_wid = htmlspecialchars($_POST['user_wid']);
  $user_pswrd = htmlspecialchars($_POST['user_pswrd']);

  $conn = mysqli_connect('localhost', 'root', '', 'meet.wvsu');

  $user_sql = "SELECT * FROM users WHERE WVSU_ID = '$user_wid'";
  $user_query = mysqli_query($conn, $user_sql);
  $user = mysqli_fetch_assoc($user_query);

  $_SESSION['user_name'] = $user['Name'];
  $_SESSION['user_wid'] = $user['WVSU_ID'];

  $pswrd_is_match = password_verify($user_pswrd, $user['Password']);
  if ($pswrd_is_match) {
    header('Location: dshbrd.php');
    exit;
  }
}

require_once('../../private/tmps/login.tmp.php');
?>