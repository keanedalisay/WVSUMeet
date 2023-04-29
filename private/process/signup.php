<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  session_name('CREDS');
  session_start();

  $conn = mysqli_connect('localhost', 'root', '', 'meet.wvsu');

  $user_name = htmlspecialchars($_POST['user_name']);
  $user_pswrd = password_hash(htmlspecialchars($_POST['user_pswrd']), PASSWORD_BCRYPT);
  $user_wid = htmlspecialchars($_POST['user_wid']);

  $user_sql = "INSERT INTO users(Name, Password, WVSU_ID) VALUES(?, ?, ?)";
  $prep_sql = mysqli_prepare($conn, $user_sql);
  mysqli_stmt_bind_param($prep_sql, 'sss', $user_name, $user_pswrd, $user_wid);
  mysqli_stmt_execute($prep_sql);
  mysqli_stmt_close($prep_sql);

  $_SESSION['user_name'] = $user_name;
  $_SESSION['user_wid'] = $user_wid;
  header('Location: ../../public/pages/dshbrd.php');
}
?>