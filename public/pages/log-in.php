<?php
use WvsuMeet\LogIn;

if ($_SERVER['REQUEST_URI'] === "/log-out") {
  session_unset();
  session_destroy();
  header("Location: /log-in");
  exit;
}

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
  <link href="../styles/global.css" rel="stylesheet" />
  <link href="../styles/login.css" rel="stylesheet" />
</head>
<body>
  <div class="left">
    <img src="../assets/images/wvsumeet.png" class="logo" />
    <h1>Welcome Back!</h1>
    <p>Please enter your log-in details</p>
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
    <p class="already-have-account">
      Don't have an account? <a class="signup-link" href="/sign-up">Sign Up</a>
    </p>
  </div>

  <div class="right">
    <img src="../assets/images/Photo1.jpg" alt="User 1" class="profile-circle" style="top: 40px; left: 130px;">
    <img src="../assets/images/Photo2.jpg" alt="User 2" class="profile-circle" style="top: 60px; right: 150px;">
    <img src="../assets/images/Photo3.jpg" alt="User 3" class="profile-circle" style="top: 240px; left: 150px;">
    <img src="../assets/images/Photo4.jpg" alt="User 4" class="profile-circle" style="top: 260px; right: 100px;">
    <img src="../assets/images/Photo5.jpg" alt="User 5" class="profile-circle" style="bottom: 160px; left: 60px;">
    <img src="../assets/images/Photo6.jpg" alt="User 6" class="profile-circle" style="bottom: 180px; right: 240px;">
    <img src="../assets/images/Photo7.jpg" alt="User 7" class="profile-circle" style="bottom: 20px; left: 210px;">
    <img src="../assets/images/Photo8.jpg" alt="User 8" class="profile-circle" style="bottom: 70px; right: 50px;">
  </div>
</body>
</html>