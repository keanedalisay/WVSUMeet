<?php
require_once('../../private/hlprs/sess.php');

function showDshbrd()
{
  global $logout_actn, $user_gbl_msg_tkn;

  $user_name = explode(' ', $_SESSION['user_name']);
  $user_wid = $_SESSION['user_wid'];

  $_SESSION['user_gbl_msg_tkn'] = $user_gbl_msg_tkn;

  require_once('../../private/tmps/dshbrd.tmp.php');
}

sessStart('CREDS');

if (!isset($_SESSION['has_logged_in']) || !$_SESSION['has_logged_in']) {
  $_SESSION['has_logged_in'] = false;
  header('Location: ../index.php', true, 303);
  exit;
}

$logout_actn = 'login.php';

if (!isset($_SESSION['lst_msg_time']))
  $_SESSION['lst_msg_time'] = time();

showDshbrd();
?>