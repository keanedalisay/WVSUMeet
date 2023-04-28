<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="application-name" content="Meet.WVSU">
  <title>Meet.WVSU</title>
  <link href="../styles/global.css" rel="stylesheet">
  <link href="../styles/action_form.css" rel="stylesheet">
  <script src="../scripts/login.js" defer></script>
</head>

<body>
  <?php require_once('../../private/cmpnts/header.login.html') ?>
  <main class="mn">
    <div class="wrap--login">
      <section class="hdng">
        <h1 class="hdng-actn">Log-in</h1>
        <p class="hdng-side">to your account...</p>
        <a class="hdng-link" href="signup.php">or sign-up for a new one</a>
      </section>
      <section class="login">
        <form class="form" action="../../private/process/signup.php" method="POST">
          <label for="user_wid" class="form-lbl">WVSU-ID:</label>
          <input id="user_wid" type="text" name="user_wid" class="form-input" />
          <label for="user_pswrd" class="form-lbl">Password:</label>
          <input id="user_pswrd" type="password" name="user_pswrd" class="form-input" />
          <button type="submit" class="form-submit">Log-in</button>
        </form>
      </section>
    </div>
  </main>
  <?php require_once('../../private/cmpnts/footer.html') ?>
</body>

</html>