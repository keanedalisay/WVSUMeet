<?php
function sessStart(string $sess_name)
{
  session_name($sess_name);
  session_start();
}

function sessCheckLogin(string $rdrct_hdr)
{
  if (!isset($_SESSION['has_logged_in']) || !$_SESSION['has_logged_in']) {
    $_SESSION['has_logged_in'] = false;
    return;
  }

  header($rdrct_hdr, true, 302);
  exit;
}
?>