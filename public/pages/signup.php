<?php
require_once('../../private/hlprs/sess.php');

sessStart('CREDS');
sessCheckLogin('Location: dshbrd.php');
$login_path = 'login.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $conn = mysqli_connect('localhost', 'root', '', 'meet.wvsu');

  $user_name = htmlspecialchars($_POST['user_name']);
  $user_pswrd = password_hash(htmlspecialchars($_POST['user_pswrd']), PASSWORD_BCRYPT);
  $user_wid = htmlspecialchars($_POST['user_wid']);
  $time_joined = time();

  $user_sql = "INSERT INTO users(Name, Password, WVSU_ID, Time_Joined) VALUES(?, ?, ?, ?)";
  $prep_sql = mysqli_prepare($conn, $user_sql);
  mysqli_stmt_bind_param($prep_sql, 'sssi', $user_name, $user_pswrd, $user_wid, $time_joined);
  mysqli_stmt_execute($prep_sql);
  mysqli_stmt_close($prep_sql);

  $_SESSION['user_name'] = $user_name;
  $_SESSION['user_wid'] = $user_wid;
  $_SESSION['has_logged_in'] = true;

  header('Location: dshbrd.php');
  exit;
}

require_once('../../private/tmps/signup.tmp.php');
?>