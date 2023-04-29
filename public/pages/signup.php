<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="application-name" content="Meet.WVSU">
  <title>Meet.WVSU</title>
  <link href="../styles/global.css" rel="stylesheet">
  <link href="../styles/action_form.css" rel="stylesheet">
  <script src="../scripts/signup.js" defer></script>
</head>

<body>
  <?php require_once('../../private/cmpnts/header.login.html') ?>
  <main class="mn mn--signup">
    <div class="wrap wrap--action_form">
      <section class="hdng">
        <h1 class="hdng-actn">Sign-Up</h1>
        <p class="hdng-side">as a new user...</p>
        <a class="hdng-link" href="login.php">or log-in if you already did.</a>
      </section>
      <section class="login">
        <form class="form" action="../../private/process/signup.php" method="POST">
          <label for="user_name" class="form-lbl">Name:</label>
          <input id="user_name" type="text" name="user_name" class="form-input" />
          <label for="user_wid" class="form-lbl">WVSU-ID:</label>
          <input id="user_wid" type="text" name="user_wid" class="form-input" />
          <label for="user_pswrd" class="form-lbl form-lbl--signup_pswrd">Password:</label>
          <input id="user_pswrd" type="password" name="user_pswrd" class="form-input" />
          <label for="user_cnfrm_pswrd" class="form-lbl">Confirm:</label>
          <input id="user_cnfrm_pswrd" type="password" name="user_cnfrm_pswrd" class="form-input" />
          <button type="submit" class="form-submit">Sign-Up</button>
        </form>
      </section>
    </div>
  </main>
  <?php require_once('../../private/cmpnts/footer.html') ?>
</body>

</html>