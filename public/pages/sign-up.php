<?php 
use WvsuMeet\SignUp;

if (isset($_SESSION["has_logged_in"]) && $_SESSION["has_logged_in"] === true) {
  header("Location: /chat");
  exit;
}

if (is_csrf_valid())
  new SignUp();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WVSUMeet | Create a New Account</title>
</head>
<body>
  <form action="/sign-up" method="post">
  <label for="user_name">
      Name
      <input type="text" name="user_name">
    </label>
    <label for="user_wvsuid">
      WVSU-ID
      <input type="text" name="user_wvsuid">
    </label>
    <label for="user-password">
      Password
      <input type="password" name="user_password">
    </label>
    <?= set_csrf(); ?>
    <button type="submit">
      Sign up
    </button>
  </form>
</body>
</html>