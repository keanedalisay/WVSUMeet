<?php
use WvsuMeet\LogIn;

session_start();

if (isset($_SESSION["has_logged_in"]) && $_SESSION["has_logged_in"] === true) {
  header("Location: /chat");
  exit;
}

if (is_csrf_valid())
  new LogIn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WVSUMeet | Log-in Account</title>
</head>
<body>
  <form action="/log-in" method="post">
    <label for="user_wvsuid">
      WVSU-ID
      <input type="text" name="user_wvsuid">
    </label>
    <label for="user_password">
      Password
      <input type="password" name="user_password">
    </label>
    <?= set_csrf(); ?>
    <button type="submit">
      Continue
    </button>
  </form>
</body>
</html>