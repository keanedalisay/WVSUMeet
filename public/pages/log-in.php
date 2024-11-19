<?php
use WvsuMeet\LogIn;

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
    <label for="user-wvsuid">
      WVSU-ID
      <input type="text" name="user-wvsuid">
    </label>
    <label for="user-password">
      Password
      <input type="password" name="user-password">
    </label>
    <?= set_csrf(); ?>
    <button type="submit">
      Continue
    </button>
  </form>
</body>
</html>