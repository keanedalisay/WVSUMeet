<?php
require_once('../../private/hlprs/sess.php');

sessStart('CREDS');

if (!isset($_SESSION['has_logged_in']) || !$_SESSION['has_logged_in']) {
  $_SESSION['has_logged_in'] = false;
  header('Location: ../index.php', true, 302);
  exit;
}

if (session_name() === 'CREDS') {
  $user_name = explode(' ', $_SESSION['user_name']);
  $user_wid = $_SESSION['user_wid'];
  require_once('../../private/tmps/dshbrd.tmp.php');
}
?>