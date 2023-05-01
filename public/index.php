<?php
require_once('../private/hlprs/sess.php');

sessStart('CREDS');
sessCheckLogin('Location: pages/dshbrd.php');
$login_path = 'pages/login.php';

require_once('../private/tmps/index.tmp.php');
?>