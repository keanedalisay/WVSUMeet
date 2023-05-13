<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="application-name" content="Meet.WVSU">
  <title>Meet.WVSU</title>
  <link href="../styles/global.css" rel="stylesheet">
  <link href="../styles/dshbrd.css" rel="stylesheet">
  <script src="../scripts/dshbrd.js" defer></script>
</head>

<body>
  <?php require_once('../../private/cmpnts/header.logout.php') ?>
  <main class="mn">
    <div class="wrap wrap--dshbrd">
      <section class="hdng">
        <h1 class="hdng-user">Welcome
          <?php echo $user_name[0] ?>
        </h1>
        <hr class="hdng-hr">
      </section>
      <section class="infobox">
        <article class="info">
          <h1 class="info-lbl">User Count</h1>
          <p class="info-val">0</p>
        </article>
        <article class="info">
          <h1 class="info-lbl">Message Count</h1>
          <p class="info-val">0</p>
        </article>
      </section>
      <section class="msgbox">
        <div class="wrap wrap--msgs">
          <ol class="msgs" data-slctr="msgbox" tabindex="0" aria-label="Message box">
            <?php require_once('../../private/msg_system/show_gbl_msgs.php') ?>
          </ol>
        </div>
        <form class="wdgt" action="../../private/msg_system/prcss_gbl_msg.php" method="POST">
          <textarea class="wdgt-input" name="user_gbl_msg" placeholder="Enter your message..."
            aria-label="Global message input"></textarea>
          <button class="wdgt-sbmt" type="submit" aria-label="Send message">
            <img src="../icons/send_msg_icon.svg" alt="Send message">
          </button>
        </form>
      </section>
    </div>
  </main>
  <?php require_once('../../private/cmpnts/footer.html') ?>
</body>

</html>