<?php
use WvsuMeet\GlobalChat;

session_start();

if (empty($_SESSION["has_logged_in"])) {
  header("Location: /log-in");
  exit;
}

if (empty($_SESSION["chat_type"])) {
  $_SESSION["chat_type"] = "global";
  $_SESSION["chat_api"] = "/api/chats/global";
}

if (filter_has_var(INPUT_POST, "chat_type")) {
  if ($_SERVER["REQUEST_URI"] === "/api/chats/global") {
    $_SESSION["chat_type"] = $_POST["chat_type"];
    $_SESSION["chat_api"] = $_SERVER["REQUEST_URI"];
    header("Location: /chat");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="application-name" content="WVSUMeet" />
  <title>WVSUMeet</title>
  <link href="../styles/global.css" rel="stylesheet" />
  <link href="../styles/chat.css" rel="stylesheet" />
  <script src="../scripts/chat.js" type="module"></script>
  <?php if (empty($_SESSION["chat_type"]) || $_SESSION["chat_type"] === "global"): ?>
    <script src="../scripts/global-chat.js" type="module"></script>
  <?php endif; ?>
</head>

<body>
  <header class="header">
    <a class="header__logo" href="#"><img src="../assets/images/wvsumeet.png" alt="" /></a>
    <button class="profile" data-js="profile-button">
      <div class="profile__img">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
          <path
            d="M19 7.001c0 3.865-3.134 7-7 7s-7-3.135-7-7c0-3.867 3.134-7.001 7-7.001s7 3.134 7 7.001zm-1.598 7.18c-1.506 1.137-3.374 1.82-5.402 1.82-2.03 0-3.899-.685-5.407-1.822-4.072 1.793-6.593 7.376-6.593 9.821h24c0-2.423-2.6-8.006-6.598-9.819z" />
        </svg>
      </div>
      <?= $_SESSION["user_name"] ?>
      <menu class="dropdown dropdown--profile" data-js="profile-dropdown">
        <a href="/chat/profile">Profile</a>
        <a href="/log-out">Log out</a>
      </menu>
    </button>
  </header>
  <main>
    <aside class="chat-sidebar">
      <h1>Chats</h1>
      <form class="search-bar-form">
        <label class="search-bar">
          <input type="search" class="search-bar__input" placeholder="Find a person or group to chat with..." />
          <button class="search-bar__btn" type="submit">
            <svg width="22" height="23" viewBox="0 0 22 23" fill="#212121" xmlns="http://www.w3.org/2000/svg">
              <g>
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M16.5294 15.7328C17.6584 14.3214 18.3335 12.5312 18.3335 10.5833C18.3335 6.0269 14.6398 2.33325 10.0835 2.33325C5.52715 2.33325 1.8335 6.0269 1.8335 10.5833C1.8335 15.1396 5.52715 18.8333 10.0835 18.8333C12.0314 18.8333 13.8217 18.1582 15.233 17.0292L17.6853 19.4814C18.0433 19.8394 18.6237 19.8394 18.9817 19.4814C19.3397 19.1235 19.3397 18.5431 18.9817 18.1851L16.5294 15.7328ZM16.5002 10.5833C16.5002 14.1271 13.6273 16.9999 10.0835 16.9999C6.53967 16.9999 3.66683 14.1271 3.66683 10.5833C3.66683 7.03942 6.53967 4.16659 10.0835 4.16659C13.6273 4.16659 16.5002 7.03942 16.5002 10.5833Z" />
              </g>
            </svg>
            <span class="sr-only">Find a person or group to chat with...</span>
          </button>
        </label>
      </form>
      <section>
        <h2>PIN CHATS</h2>
        <?php GlobalChat::chatButton(); ?>
      </section>
      <section>
        <h2>ALL CHATS</h2>
        <form class="chat-btn-form">
          <button class="chat-btn">
            <img class="chat-btn__profile" src="../assets/images/global-chat.png" alt="">
            <div class="chat-btn-details">
              <p class="chat-btn-details__name"><b>Albert</b></p>
              <p class="chat-btn-details__last-msg">Hi</p>
              <time class="chat-btn-details__last-sent"><span class="sr-only">Last sent at</span>09:21</time>
            </div>
          </button>
        </form>
        <form class="chat-btn-form">
          <button class="chat-btn">
            <img class="chat-btn__profile" src="../assets/images/global-chat.png" alt="">
            <div class="chat-btn-details">
              <p class="chat-btn-details__name"><b>Prince Malatuba</b></p>
              <p class="chat-btn-details__last-msg">What"s the assignment today?</p>
              <time class="chat-btn-details__last-sent"><span class="sr-only">Last sent at</span>09:21</time>
              <span class="chat-btn-details__unread-msgs">1</span>
            </div>
          </button>
        </form>
      </section>
    </aside>
    <section class="chatbox">
      <div class="chatbox-details">
        <img class="chatbox-details__profile" src="../assets/images/global-chat.png" alt="">
        <h2 class="chatbox-details__name">Global Chat</h2>
      </div>
      <div class="wrap wrap--msgs">
        <ol class="msgs" data-js="chatbox" tabindex="0" aria-label="Message box">
          <?php
          if ($_SESSION["chat_type"] === "global") {
            new GlobalChat();
          }
          ?>
        </ol>
      </div>
      <form class="chatbar" data-js="chatbar" action="<?= $_SESSION["chat_api"] ?></form>" method="post">
        <input type="hidden" name="chat_type" value="<?= $_SESSION["chat_type"] ?>">
        <input type="hidden" name="user_name" value="<?= $_SESSION["user_name"] ?>">
        <input type="hidden" name="user_wvsuid" value="<?= $_SESSION["user_wvsuid"] ?>">
        <label class="chatbar__image-input" for="user_files">
          <span class="sr-only"> Upload an image</span>
          <svg width="32" height="33" viewBox="0 0 32 33" fill="#212121" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M2.6665 7.16675C2.6665 4.95761 4.45737 3.16675 6.6665 3.16675H25.3332C27.5423 3.16675 29.3332 4.95761 29.3332 7.16675V25.8334C29.3332 28.0426 27.5423 29.8334 25.3332 29.8334H6.6665C4.45736 29.8334 2.6665 28.0426 2.6665 25.8334V7.16675ZM25.444 27.1622C26.0874 27.1093 26.0765 26.2951 25.6405 25.8189L14.0919 13.2066C12.4555 11.4214 9.62072 11.4884 8.0704 13.3487L5.64221 16.2626C5.44253 16.5022 5.33317 16.8042 5.33317 17.1161V25.8334C5.33317 26.5698 5.93012 27.1667 6.6665 27.1667H25.3332C25.3705 27.1667 25.4074 27.1652 25.444 27.1622ZM22.6665 12.5001C24.1393 12.5001 25.3332 11.3062 25.3332 9.83342C25.3332 8.36066 24.1393 7.16675 22.6665 7.16675C21.1937 7.16675 19.9998 8.36066 19.9998 9.83342C19.9998 11.3062 21.1937 12.5001 22.6665 12.5001Z" />
          </svg>
          <input type="file" id="user_files">
        </label>
        <label class="sr-only" for="user_msg">Write a message</label>
        <textarea class="chatbar__text-input" id="user_msg" name="user_msg"
          placeholder="Write a message..." required></textarea>
        <button class="chatbar__btn" type="submit">
          <span class="sr-only">Send your message</span>
          <svg width="32" height="33" viewBox="0 0 32 33" fill="#3E82CD" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M8.39453 4.37438C5.21333 2.90613 1.81561 5.94724 2.92356 9.27113L4.60549 14.2592C4.78832 14.8014 5.29673 15.1666 5.86893 15.1666H17.3332C18.0695 15.1666 18.6665 15.7635 18.6665 16.4999C18.6665 17.2363 18.0695 17.8332 17.3332 17.8332H5.86893C5.29672 17.8332 4.78832 18.1983 4.60549 18.7405L2.92358 23.7287C1.81561 27.0525 5.21334 30.0937 8.39454 28.6254L26.7975 20.1318C29.8959 18.7018 29.8959 14.2981 26.7975 12.8681L8.39453 4.37438Z" />
          </svg>
        </button>
      </form>
    </section>
  </main>
</body>

</html>