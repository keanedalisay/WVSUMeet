<?php

if (empty($_SESSION["has_logged_in"])) {
  header("Location: /log-in");
  exit;
}


if (isset($_FILES["user_profile_img"]) && $_SERVER["REQUEST_URI"] === "/api/user/profile/img") {
  $date = date("Y-m-d");
  $parent_dir = "/assets/";

  print_r($parent_dir);

  if (is_dir(dirname(__DIR__) . $parent_dir)) {
    print_r("\n" . $parent_dir);
    $date_values = explode("-", $date);
    $dir_to_store = $parent_dir . "profiles/" . $date_values[0] . "/" . $date_values[1] . "/" . $date_values[2];
    $final_file_name = $dir_to_store . "/" . $_FILES["user_profile_img"]["name"];

    if (!is_dir($dir_to_store))
      mkdir(dirname(__DIR__) . $dir_to_store . "/", 0755, true);

    if (is_uploaded_file($_FILES["user_profile_img"]["tmp_name"])) {
      print_r("\n" . $parent_dir);
      move_uploaded_file($_FILES["user_profile_img"]["tmp_name"],dirname(__DIR__) . $final_file_name);

      $conn = mysqli_connect("meet_wvsu_db", "root", "123", "meet.wvsu");
      mysqli_query($conn, "UPDATE users SET Profile = '$final_file_name' WHERE WVSU_ID = '$_SESSION[user_wvsuid]';");

      $_SESSION["user_profile"] = $final_file_name;
    }
  }

  header("Location: /chat/profile");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WVSUMeet | Profile</title>
  <link href="../styles/global.css" rel="stylesheet" />
  <link href="../styles/profile.css" rel="stylesheet" />
  <script src="../scripts/profile.js" type="module"></script>
</head>

<body>
  <header class="header">
    <a class="header__logo" href="#"><img src="../assets/images/wvsumeet.png" alt="" /></a>
    <button class="profile">
      <?php if (empty($_SESSION["user_profile"])): ?>
        <div class="profile__img">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path
              d="M19 7.001c0 3.865-3.134 7-7 7s-7-3.135-7-7c0-3.867 3.134-7.001 7-7.001s7 3.134 7 7.001zm-1.598 7.18c-1.506 1.137-3.374 1.82-5.402 1.82-2.03 0-3.899-.685-5.407-1.822-4.072 1.793-6.593 7.376-6.593 9.821h24c0-2.423-2.6-8.006-6.598-9.819z" />
          </svg>
        </div>
      <?php else: ?>
        <img class="profile__img" src="<?= $_SESSION["user_profile"]?>" alt="">
      <?php endif; ?>
      <?= $_SESSION["user_name"] ?>
      <menu class="dropdown dropdown--profile" data-js="profile-dropdown">
        <a href="/chat/profile">Profile</a>
        <a href="/log-out">Log out</a>
      </menu>
    </button>
  </header>
  <main>
    <h1>Edit Profile</h1>
    <form data-js="form-user-profile" action="/api/user/profile/img" enctype="multipart/form-data" method="post">
      <?php if (empty($_SESSION["user_profile"])): ?>
        <img class="user-profile user-profile--hide" data-js="user-profile" src="" alt="">
        <div class="user-profile" data-js="user-default-profile">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path
              d="M19 7.001c0 3.865-3.134 7-7 7s-7-3.135-7-7c0-3.867 3.134-7.001 7-7.001s7 3.134 7 7.001zm-1.598 7.18c-1.506 1.137-3.374 1.82-5.402 1.82-2.03 0-3.899-.685-5.407-1.822-4.072 1.793-6.593 7.376-6.593 9.821h24c0-2.423-2.6-8.006-6.598-9.819z" />
          </svg>
        </div>
      <?php else: ?>
        <img class="user-profile" data-js="user-profile" src="<?= $_SESSION["user_profile"]?>" alt="">
        <div class="user-profile user-profile--hide" data-js="user-default-profile">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path
              d="M19 7.001c0 3.865-3.134 7-7 7s-7-3.135-7-7c0-3.867 3.134-7.001 7-7.001s7 3.134 7 7.001zm-1.598 7.18c-1.506 1.137-3.374 1.82-5.402 1.82-2.03 0-3.899-.685-5.407-1.822-4.072 1.793-6.593 7.376-6.593 9.821h24c0-2.423-2.6-8.006-6.598-9.819z" />
          </svg>
        </div>
      <?php endif; ?>
      <label>
        Change profile picture
        <input type="file" data-js="input-user-profile" name="user_profile_img" accept="image/*" />
      </label>
      <fieldset class="form__controls form__controls--hide">
        <button class="button button--save" type="submit" data-js="button-user-profile-save">
          Save
        </button>
        <button class="button button--cancel" type="reset" data-js="button-user-profile-cancel">
          Cancel
        </button>
      </fieldset>
    </form>
    <form action="/api/user/profile/details">
      <label>
        Name
        <input type="text" data-js="input-user-name" name="user_name" value="<?= $_SESSION["user_name"] ?>" />
      </label>
      <label>
        WVSU ID
        <input type="text" data-js="input-user-wvsuid" name="user_wvsuid" value="<?= $_SESSION["user_wvsuid"] ?>" />
      </label>
      <fieldset class="form__controls form__controls--hide">
        <button class="button button--save" type="submit" data-js="button-user-details-save">
          Save
        </button>
        <button class="button button--cancel" type="reset" data-js="button-user-details-cancel">
          Cancel
        </button>
      </fieldset>
    </form>
    <section class="account-settings">
      <h2>Account Settings</h2>
      <button class="button button--danger">Delete Account</button>
      <button class="button">Change Password</button>
    </section>
  </main>
  </script>
</body>

</html>