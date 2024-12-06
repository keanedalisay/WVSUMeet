<?php

if (isset($_SESSION["has_logged_in"]) && $_SESSION["has_logged_in"] === true) {
  header("Location: /chat");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WVSUMeet</title>
  <link href="../styles/global.css" rel="stylesheet" />
  <link href="../styles/index.css" rel="stylesheet" />
</head>
<body>
  <img src="../assets/images/wvsumeet.png" class="logo" />
  <p>A real-time chat application catered to West Visayas State University (WVSU) students. </p>
  <div class="links">
    <a href="/log-in">Log-in to Account</a>
    <a href="/sign-up">Create a New Account</a>
  </div>
</body>
</html>