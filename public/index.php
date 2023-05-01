<?php
$login_path = 'pages/login.php';

session_name('CREDS');
session_start();

if (!isset($_SESSION['has_logged_in']) || !$_SESSION['has_logged_in']) {
  $_SESSION['has_logged_in'] = false;
} else {
  header('Location: pages/dshbrd.php', true, 302);
  exit;
}

require_once('../private/tmps/index.tmp.php');
?>