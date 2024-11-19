<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WVSUMeet | Create a New Account</title>
</head>
<body>
  <form action="/sign-up" method="post">
  <label for="user-name">
      Name
      <input type="text" name="user-name">
    </label>
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
      Sign up
    </button>
  </form>
</body>
</html>