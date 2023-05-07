<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="application-name" content="Meet.WVSU">
  <title>Error 404 | Meet.WVSU</title>
  <style>
    :root {
      --denim: #1569ae;
      --mnshft: #212121;
      --white: #ffffff;
      --wldsnd: #f4f4f4;
      --grey: #8c8c8c;
    }

    *,
    ::before,
    ::after {
      margin: 0;
      padding: 0;
      border: none;
      box-sizing: border-box;
      font-family: "Roboto", Arial, Helvetica, sans-serif;
      color: var(--mnshft, #212121);
    }

    html {
      font-size: 10px;
    }

    .wrap {
      width: 100%;
      position: relative;
    }

    .hdr {
      padding: 0 min(4rem, 5vw);
      position: relative;
      height: 8rem;
      display: flex;
      flex-flow: row nowrap;
      justify-content: flex-end;
      align-items: center;
    }

    .hdr-log {
      width: 10rem;
      height: 4rem;
      display: flex;
      justify-content: center;
      align-items: center;
      background: transparent;
      border-radius: 1rem;
      color: var(--denim, #1569ae);
      text-decoration: none;
      font-size: 1.8rem;
      font-weight: 700;
      transition: background ease-in-out 275ms, color ease-in-out 275ms;
    }

    .hdr-log:hover,
    .hdr-log:focus,
    .hdr-log:focus-visible {
      background: var(--denim, #1569ae);
      color: var(--white, #ffffff);
    }

    .mn {
      margin: 0 auto;
      height: 80vh;
      width: min(80%, 100rem);
    }

    .notice {
      height: 100%;
      max-height: 42rem;
      position: relative;
      top: 50%;
      transform: translateY(-50%);
    }

    .notice-icon {
      width: 20rem;
      height: 20rem;
      float: left;
      position: relative;
      top: 50%;
      left: 20%;
      transform: translate(-20%, -50%);
    }

    .text {
      margin-left: 8rem;
      padding: 10px 10px;
      max-width: 40rem;
      float: left;
      position: relative;
      top: 50%;
      left: 25%;
      transform: translate(-25%, -50%);
    }

    .text>* {
      margin: 3rem 0;
    }

    .text-hdng {
      font-size: 4rem;
      font-weight: 700;
      color: var(--denim, #1569ae);
    }

    .text-sub {
      font-size: 2rem;
      line-height: 2.5rem;
      font-weight: 400;
    }

    .text-link {
      width: 23rem;
      height: 6rem;
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 0.5rem;
      background: var(--denim, #1569ae);
      color: var(--white, #ffffff);
      font-size: 2rem;
      font-weight: 700;
      text-decoration: none;
      transition: background ease-in-out 275ms;
    }

    .text-link:focus-visible,
    .text-link:focus,
    .text-link:hover {
      background: #1569aea6;
    }

    @media screen and (max-width: 1000px) {
      .notice-icon {
        width: 15rem;
        height: 15rem;
      }

      .text-hdng {
        font-size: 3rem;
      }

      .text-sub {
        font-size: 1.8rem;
      }

      .text-link {
        width: 21rem;
        height: 5.5rem;
        font-size: 1.8rem;
      }
    }

    @media screen and (max-width: 900px) {
      .notice-icon {
        top: 0;
        left: 50%;
        transform: translateX(-50%);
      }

      .text {
        margin-left: 0rem;
        clear: left;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
      }

      .text-hdng {
        text-align: center;
      }

      .text-sub {
        text-align: center;
      }

      .text-link {
        position: relative;
        left: 50%;
        transform: translateX(-50%);
      }
    }

    @media screen and (max-width: 500px) {
      .notice-icon {
        width: 12rem;
        height: 12rem;
      }

      .text-hdng {
        font-size: 2.5rem;
      }

      .text-sub {
        font-size: 1.6rem;
      }

      .text-link {
        width: 18rem;
        height: 5rem;
        font-size: 1.6rem;
      }
    }

    .ftr {
      position: relative;
      height: 6rem;
    }

    .cprgt {
      padding: 3rem 1rem;
      width: min(40rem, 90%);
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
      font-size: 1.2rem;
    }

    .cprgt-link {
      color: var(--denim, #1569ae);
    }
  </style>
</head>

<body>
  <?php
  if (!isset($_SESSION['has_logged_in']) || !$_SESSION['has_logged_in']) {
    $_SESSION['has_logged_in'] = false;
    $login_path = '../../public/pages/login.php';
    $reroute_btn = "<a class='text-link' href='../../public/index.php'>Back To Home Page</a>";
    require_once('../cmpnts/header.login.php');
  } else {
    $reroute_btn = "<a class='text-link' href='../../public/pages/dshbrd.php'>Back To Dashboard</a>";
    require_once('../cmpnts/header.logout.php');
  }
  ?>
  <main class="mn">
    <section class="notice">

      <svg class="notice-icon" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#1569ae">
        <path
          d="m2.095 19.886 9.248-16.5c.133-.237.384-.384.657-.384.272 0 .524.147.656.384l9.248 16.5c.064.115.096.241.096.367 0 .385-.309.749-.752.749h-18.496c-.44 0-.752-.36-.752-.749 0-.126.031-.252.095-.367zm1.935-.384h15.939l-7.97-14.219zm7.972-6.497c-.414 0-.75.336-.75.75v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5c0-.414-.336-.75-.75-.75zm-.002-3c.552 0 1 .448 1 1s-.448 1-1 1-1-.448-1-1 .448-1 1-1z"
          fill-rule="nonzero" />
      </svg>

      <div class="text">
        <h1 class="text-hdng">404 NOT FOUND</h1>
        <p class="text-sub">The page you are looking for might have been removed or temporarily unavailable.
        </p>
        <?php echo $reroute_btn ?>
      </div>

    </section>
  </main>
  <?php require_once('../cmpnts/footer.html') ?>
</body>

</html>