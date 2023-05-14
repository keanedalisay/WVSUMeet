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
  <?php require_once('../../private/cmpnts/header.login.php') ?>
  <main class="mn">
    <div class="wrap wrap--action_form">
      <section class="hdng">
        <h1 class="hdng-actn">Log-in</h1>
        <p class="hdng-side">to your account...</p>
        <a class="hdng-link" href="signup.php">or sign-up for a new one</a>
      </section>
      <section class="login">
        <form class="form" action="login.php" method="POST">
          <label for="user_wid" class="form-lbl">WVSU-ID:</label>
          <input id="user_wid" type="text" name="user_wid" value="<?php echo $log_in->getInputWid() ?>"
            class="form-input" aria-errormessage="user_err_wid"
            aria-invalid="<?php echo $log_in->setAriaInvalid('err_wid') ?>" required />
          <p id="user_err_wid" class="form-err_lbl <?php echo $log_in->setErrClass('err_wid') ?>" aria-live="assertive">
            <?php echo $log_in->getErrWid() ?>
          </p>

          <label for="user_pswrd" class="form-lbl">Password:</label>
          <input id="user_pswrd" type="password" name="user_pswrd" value="<?php echo $log_in->getInputPswrd() ?>"
            class="form-input" aria-errormessage="user_err_pswrd"
            aria-invalid="<?php echo $log_in->setAriaInvalid('err_pswrd') ?>" required />
          <p id="user_err_pswrd" class="form-err_lbl <?php echo $log_in->setErrClass('err_pswrd') ?>"
            aria-live="assertive">
            <?php echo $log_in->getErrPswrd() ?>
          </p>

          <input id="tkn_login" type="hidden" name="tkn_login" value=<?php echo $log_in->getToken() ?> />

          <button type="submit" class="form-submit">Log-in</button>
        </form>
      </section>
    </div>
  </main>
  <?php require_once('../../private/cmpnts/footer.html') ?>
</body>

</html>