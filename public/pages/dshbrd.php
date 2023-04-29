<?php
session_name('CREDS');
session_start();

if (session_name() === 'CREDS') {
  $user_name = explode(' ', $_SESSION['user_name']);
  $user_wid = $_SESSION['user_wid'];
  require_once('../../private/tmps/dshbrd.tmp.php');
}
?>