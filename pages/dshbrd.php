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
  <?php require_once('cmpnts/header.logout.php') ?>
  <main class="mn">
    <section class="hdng">
      <h1 class="hdng-user">Welcome, Keane.</h1>
      <hr class="hdng-hr">
    </section>
    <section class="msgbox">
      <div class="wrap--msgs">
        <ol class="msgs" data-slctr="msgbox" tabindex="0" aria-label="Message box">
          <?php require_once('../scripts/php/show_gbl_msgs.php') ?>
        </ol>
      </div>
      <form class="wdgt">
        <textarea class="wdgt-input" placeholder="Enter your message..." aria-label="Message input"></textarea>
        <button class="wdgt-sbmt" type="submit" aria-label="Send message">
          <img src="../assets/icons/send_msg_icon.svg" alt="Send message">
        </button>
      </form>
    </section>
  </main>
  <?php require_once('cmpnts/footer.php') ?>
</body>

</html>