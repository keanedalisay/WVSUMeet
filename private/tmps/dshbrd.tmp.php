<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="application-name" content="Meet.WVSU">
  <title>Meet.WVSU</title>
  <link href="../styles/global.css" rel="stylesheet">
  <link href="../styles/dshbrd.css" rel="stylesheet">
  <script src="../scripts/js/dshbrd.js" defer></script>
</head>

<body>
  <?php require_once('../../private/cmpnts/header.logout.html') ?>
  <main class="mn">
    <section class="hdng">
      <h1 class="hdng-user">Welcome
        <?php echo $user_name[0], '.' ?>
      </h1>
      <hr class="hdng-hr">
    </section>
    <section class="msgbox">
      <div class="wrap wrap--msgs">
        <ol class="msgs" data-slctr="msgbox" tabindex="0" aria-label="Message box">
        </ol>
      </div>
      <form class="wdgt" action="dshbrd.php" method="POST">
        <textarea class="wdgt-input" name="user_gbl_msg" placeholder="Enter your message..."
          aria-label="Global message input"></textarea>
        <button class="wdgt-sbmt" type="submit" aria-label="Send message">
          <img src="../icons/send_msg_icon.svg" alt="Send message">
        </button>
      </form>
    </section>
  </main>
  <?php require_once('../../private/cmpnts/footer.html') ?>
</body>

</html>