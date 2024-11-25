<?php

session_start();

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
</head>
<body>
  <h1>Welcome to WVSUMeet!</h1>
  <a href="/log-in">Log-in Account</a>
  <a href="/sign-up">Create a New Account</a>
</body>
</html>