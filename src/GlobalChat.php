<?php

namespace WvsuMeet;

use DateTime;

class GlobalChat
{
  public function __construct()
  {
    $conn = mysqli_connect("meet_wvsu_db", "root", "123", "meet.wvsu");

    $gbl_msgs_sql = mysqli_query($conn, "SELECT * FROM gbl_msgs");
    $gbl_msgs = mysqli_fetch_all($gbl_msgs_sql, MYSQLI_ASSOC);

    $crnt_user_wvsuid = htmlspecialchars($_SESSION["user_wvsuid"]);

    $last_user = "";

    foreach ($gbl_msgs as $gbl_msg) {
      $msg = $gbl_msg["Msg"];
      $msg_wvsuid = $gbl_msg["WVSU_ID"];

      $user_sql = mysqli_query($conn, "SELECT Name, WVSU_ID FROM users WHERE WVSU_ID = '$msg_wvsuid'");
      $user = mysqli_fetch_assoc($user_sql);

      $is_crnt_user = $crnt_user_wvsuid === $user["WVSU_ID"];

      $user_name = $is_crnt_user ? "You" : $user["Name"];
      $msg_cls = $is_crnt_user ? "msg--user" : "msg--others";

      echo "
                <li class='msg $msg_cls'>";
      if ($last_user === $user_name)
        echo "<cite class='msg-athr' data-athr=$user_name></cite>";
      else
        echo "<cite class='msg-athr' data-athr=$user_name>$user_name</cite>";
      echo "
                <blockquote class='msg-ctnt'>
                    $msg
                </blockquote>
                </li>
            ";

      $last_user = $user_name;
      mysqli_free_result($user_sql);
    }

    mysqli_free_result($gbl_msgs_sql);
    mysqli_close($conn);
  }

  public static function chatButton()
  {
    $conn = mysqli_connect("meet_wvsu_db", "root", "123", "meet.wvsu");

    $last_gbl_msg_sql = mysqli_query($conn, "SELECT * FROM gbl_msgs ORDER BY Time_Sent DESC LIMIT 1");
    $last_gbl_msg = mysqli_fetch_assoc($last_gbl_msg_sql);

    $msg = $last_gbl_msg["Msg"];
    $msg_wvsuid = $last_gbl_msg["WVSU_ID"];

    $user_sql = mysqli_query($conn, "SELECT Name, WVSU_ID FROM users WHERE WVSU_ID = '$msg_wvsuid'");
    $user = explode(" ", mysqli_fetch_assoc($user_sql)["Name"]);
    $user_last_name = end($user);

    $date_now = new DateTime();
    $date_last_msg = new DateTime(date("F j, Y, G:i:s", timestamp: $last_gbl_msg["Time_Sent"]));
    $interval = $date_now->diff($date_last_msg, true);

    echo "
        <form class='chat-btn-form' action='/api/chats/global' method='post'>
            <input type='hidden' name='chat_type' value='global'>
            <button class='chat-btn' type='submit'>
              <img class='chat-btn__profile' src='../assets/images/global-chat.png' alt=''>
              <div class='chat-btn-details'>
                <p class='chat-btn-details__name'><b>Global Chat</b></p>
                <p class='chat-btn-details__last-msg'>$user_last_name: $msg</p>";
    if ($interval->h < 1)
      echo "  <time class='chat-btn-details__last-sent'><span class='sr-only'>Last sent </span>$interval->i min ago</time>";
    else if ($interval->d < 1)
      echo "  <time class='chat-btn-details__last-sent'><span class='sr-only'>Last sent </span>$interval->h hours ago</time>";
    else if ($interval->d < 2)
      echo "  <time class='chat-btn-details__last-sent'><span class='sr-only'>Last sent </span>$interval->d day ago</time>";
    else if ($interval->m < 1)
      echo "  <time class='chat-btn-details__last-sent'><span class='sr-only'>Last sent </span>$interval->d month ago</time>";
    else
      echo "  <time class='chat-btn-details__last-sent'><span class='sr-only'>Last sent </span>$interval->m months ago</time>";
    // <span class="chat-btn-details__unread-msgs">20<span class="sr-only">new messages</span>
    echo "
              </div>
            </button>
          </form>
        ";
  }

  public static function store(array $msg)
  {
    $conn = mysqli_connect("meet_wvsu_db", "root", "123", "meet.wvsu");

    $user_wvsuid = $msg["wvsuid"];
    $msg_id = uniqid(more_entropy: true);
    $gbl_msg = $msg["msg"];
    $time_sent = time();

    $gbl_msg_sql = "INSERT INTO gbl_msgs(Msg, Time_Sent, WVSU_ID, Msg_ID) VALUES (?, ?, ?, ?)";
    $prep_gbl_msg = mysqli_prepare($conn, $gbl_msg_sql);
    mysqli_stmt_bind_param($prep_gbl_msg, "siss", $gbl_msg, $time_sent, $user_wvsuid, $msg_id);
    mysqli_stmt_execute($prep_gbl_msg);
    mysqli_stmt_close($prep_gbl_msg);
  }
}