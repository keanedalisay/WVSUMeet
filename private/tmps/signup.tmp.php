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
  <?php require_once('../../private/cmpnts/header.login.php') ?>
  <main class="mn mn--signup">
    <div class="wrap wrap--action_form">
      <section class="hdng">
        <h1 class="hdng-actn">Sign-Up</h1>
        <p class="hdng-side">as a new user...</p>
        <a class="hdng-link" href="login.php">or log-in if you already did.</a>
      </section>
      <section class="login">
        <form class="form" action="signup.php" method="POST" data-slctr="signup-form">

          <label for="user_name" class="form-lbl">Name:</label>
          <input id="user_name" type="text" name="user_name" value="<?php echo $sign_up->getInputName() ?>"
            class="form-input" required />

          <label for="user_wid" class="form-lbl">WVSU-ID:</label>
          <input id="user_wid" type="text" name="user_wid" value="<?php echo $sign_up->getInputWid() ?>"
            class="form-input" required aria-invalid="<?php echo $sign_up->setAriaInvalid('err_wid') ?>"
            aria-errormessage="user_err_wid" />
          <p id="user_err_wid" class="form-err_lbl <?php echo $sign_up->setErrClass('err_wid') ?>" aria-live="assertive"
            data-slctr="err-lbl-wid">
            <?php echo $sign_up->getErrWid() ?>
          </p>

          <label for="user_pswrd" class="form-lbl form-lbl--signup_pswrd">Password:</label>
          <input id="user_pswrd" type="password" name="user_pswrd" value="<?php echo $sign_up->getInputPswrd() ?>"
            class="form-input" data-slctr="input-signup-pswrd" aria-invalid="false" aria-errormessage="user_err_pswrd"
            required />

          <label for="user_cnfrm_pswrd" class="form-lbl">Confirm:</label>
          <input id="user_cnfrm_pswrd" type="password" name="user_cnfrm_pswrd"
            value="<?php echo $sign_up->getInputPswrd() ?>" class="form-input" data-slctr="input-cnfrm-pswrd"
            aria-invalid="false" aria-errormessage="user_err_pswrd" required />
          <p id="user_err_pswrd" class="form-err_lbl form-err_lbl--hidden" aria-live="assertive"
            data-slctr="err-lbl-pswrd"></p>

          <input name="tkn_signup" value="<?php echo $sign_up->getToken() ?>" type="hidden">

          <button type="submit" class="form-submit">Sign-Up</button>
        </form>
      </section>
    </div>
  </main>
  <?php require_once('../../private/cmpnts/footer.html') ?>
</body>

</html>