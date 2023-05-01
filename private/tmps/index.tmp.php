<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="application-name" content="Meet.WVSU">
  <title>Meet.WVSU</title>
  <link href="styles/global.css" rel="stylesheet">
  <link href="styles/index.css" rel="stylesheet">
  <script src="scripts/index.js" defer></script>
</head>

<body>
  <?php require_once('../private/cmpnts/header.login.php') ?>
  <main class="mn">
    <section class="hdng">
      <h1 class="hdng-meet">Meet</h1>
      <h2 class="hdng-ppl">your classmates...</h2>
      <a href="pages/signup.php" class="hdng-signup">Sign-Up</a>
    </section>
    <section class="ptrts" data-slctr="ptrts">
    </section>
  </main>
  <?php require_once('../private/cmpnts/footer.html') ?>
</body>

</html>