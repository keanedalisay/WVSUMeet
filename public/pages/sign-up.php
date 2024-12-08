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
  <link href="../styles/global.css" rel="stylesheet" />
  <link href="../styles/sign-up.css" rel="stylesheet" />
</head>

<body>
  <div class="left">
    <img src="../assets/images/wvsumeet.png" class="logo" />
    <h1>Create an Account!</h1>
    <p>Please enter your sign-up details</p>
    <form action="/sign-up" method="post">
      <label for="name">Name</label>
      <input type="text" id="name" name="user_name" />

      <label for="wvsu-id">WVSU-ID</label>
      <input type="text" id="wvsu-id" name="user_wvsuid" />

      <label for="password">Password</label>
      <input type="password" id="password" name="user_password" />

      <?= set_csrf(); ?>
      <button type="submit">Sign up</button>
    </form>
    <p class="already-have-account">
      Already have an account? <a class="login-link" href="/log-in">Log in</a>
    </p>
  </div>
  <div class="right">
    <img src="../assets/images/image1.jpg" alt="User 1" class="profile-circle" style="top: 40px; left: 130px;">
    <img src="../assets/images/image2.jpg" alt="User 2" class="profile-circle" style="top: 60px; right: 150px;">
    <img src="../assets/images/image3.jpg" alt="User 3" class="profile-circle" style="top: 240px; left: 150px;">
    <img src="../assets/images/image4.jpg" alt="User 4" class="profile-circle" style="top: 260px; right: 100px;">
    <img src="../assets/images/image5.jpg" alt="User 5" class="profile-circle" style="bottom: 160px; left: 60px;">
    <img src="../assets/images/image6.jpg" alt="User 6" class="profile-circle" style="bottom: 180px; right: 240px;">
    <img src="../assets/images/image7.jpg" alt="User 7" class="profile-circle" style="bottom: 20px; left: 210px;">
    <img src="../assets/images/image8.jpg" alt="User 8" class="profile-circle" style="bottom: 70px; right: 50px;">
  </div>
</body>

</html>