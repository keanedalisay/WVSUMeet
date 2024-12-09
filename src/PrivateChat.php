<?php

namespace WvsuMeet;

use DateTime;

class PrivateChat
{
    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect("meet_wvsu_db", "root", "123", "meet.wvsu");
    }

    public function __destruct()
    {
        mysqli_close($this->conn);
    }

    public function displayMessages($currentUser, $chatPartner)
    {
        $crnt_user_wvsuid = htmlspecialchars($currentUser);
        $chat_partner_wvsuid = htmlspecialchars($chatPartner);

        $private_msgs_sql = mysqli_query(
            $this->conn,
            "SELECT * FROM private_msgs 
             WHERE (Sender_WVSU_ID = '$crnt_user_wvsuid' AND Receiver_WVSU_ID = '$chat_partner_wvsuid') 
                OR (Sender_WVSU_ID = '$chat_partner_wvsuid' AND Receiver_WVSU_ID = '$crnt_user_wvsuid') 
             ORDER BY Time_Sent ASC"
        );

        $private_msgs = mysqli_fetch_all($private_msgs_sql, MYSQLI_ASSOC);
        $last_user = "";

        if (empty($private_msgs)) {
            echo "
                <li class='msg--empty' style='display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; margin: 0; padding: 20px; width: 100%; height: 100%;'>
                    <h2 style='font-size: 24px; font-weight: bold; color: #4d94ff; margin: 0;'>Start a Conversation</h2>
                    <p style='font-size: 14px; color: #555; margin: 5px 0;'>Don't be a Stranger!</p>
                    <p style='font-size: 14px; color: #555;'>Start the conversation by sending a message or emoji</p>
                </li>";
        } else {
            foreach ($private_msgs as $msg) {
                $msg_content = $msg["Msg"];
                $msg_sender_id = $msg["Sender_WVSU_ID"];

                $user_sql = mysqli_query($this->conn, "SELECT Name FROM users WHERE WVSU_ID = '$msg_sender_id'");
                $user = mysqli_fetch_assoc($user_sql);

                $is_crnt_user = $crnt_user_wvsuid === $msg_sender_id;
                $user_name = $is_crnt_user ? "You" : htmlspecialchars($user["Name"]);
                $msg_cls = $is_crnt_user ? "msg--user" : "msg--others";

                echo "
                    <li class='msg $msg_cls'>";
                if ($last_user === $user_name) {
                    echo "<cite class='msg-athr' data-athr=$user_name></cite>";
                } else {
                    echo "<cite class='msg-athr' data-athr=$user_name>$user_name</cite>";
                }
                echo "
                    <blockquote class='msg-ctnt'>
                        $msg_content
                    </blockquote>
                    </li>";

                $last_user = $user_name;
                mysqli_free_result($user_sql);
                }
            }
            mysqli_free_result($private_msgs_sql);
    }

    public static function chatButton($currentUser, $chatPartner)
    {
        $conn = mysqli_connect("meet_wvsu_db", "root", "123", "meet.wvsu");

        $last_msg_sql = mysqli_query(
            $conn,
            "SELECT * FROM private_msgs 
            WHERE (Sender_WVSU_ID = '$currentUser' AND Receiver_WVSU_ID = '$chatPartner') 
                OR (Sender_WVSU_ID = '$chatPartner' AND Receiver_WVSU_ID = '$currentUser') 
            ORDER BY Time_Sent DESC LIMIT 1"
        );

        $last_msg = mysqli_fetch_assoc($last_msg_sql);
        $chat_partner_sql = mysqli_query($conn, "SELECT Name FROM users WHERE WVSU_ID = '$chatPartner'");
        $chat_partner = mysqli_fetch_assoc($chat_partner_sql);

        $chat_partner_name = htmlspecialchars($chat_partner["Name"]);

        $msg = $last_msg ? $last_msg["Msg"] : "No messages yet";
        if ($last_msg && $last_msg["Sender_WVSU_ID"] == $currentUser) {
            $msg = "you: " . $msg;
        }
        $time_info = "";

        if ($last_msg) {
            $date_now = new DateTime();
            $date_last_msg = new DateTime(date("F j, Y, G:i:s", $last_msg["Time_Sent"]));
            $interval = $date_now->diff($date_last_msg);

            if ($interval->m > 1) {
                $time_info = "{$interval->m} months ago";
            } elseif ($interval->d > 1) {
                $time_info = "{$interval->d} days ago";
            } elseif ($interval->h > 1) {
                $time_info = "{$interval->h} hours ago";
            } elseif ($interval->i > 1) {
                $time_info = "{$interval->i} mins ago";
            } else {
                $time_info = "{$interval->i} min ago";
            }
        }

        echo "
            <form class='chat-btn-form' action='/api/chats/private' method='post'>
                <input type='hidden' name='chat_type' value= 'private'>
                <input type='hidden' name='chat_partner' value='$chatPartner'>
                <input type='hidden' name='chat_partner_name' value='$chat_partner_name'>
                <button class='chat-btn' type='submit'>
                    <img class='chat-btn__profile' src='../assets/images/private-chat.png' alt=''>
                    <div class='chat-btn-details'>
                        <p class='chat-btn-details__name'><b> $chat_partner_name</b></p>
                        <p class='chat-btn-details__last-msg'>$msg</p>";
        if ($time_info) {
            echo "<time class='chat-btn-details__last-sent'><span class='sr-only'>Last sent </span>$time_info</time>";
        }
        echo "
                    </div>
                </button>
            </form>
        ";

        mysqli_free_result($last_msg_sql);
        mysqli_free_result($chat_partner_sql);
        mysqli_close($conn);
    }


    public static function storeMessage(array $msg)
    {
        $conn = mysqli_connect("meet_wvsu_db", "root", "123", "meet.wvsu");

        $sender_id = $msg["sender_id"];
        $receiver_id = $msg["receiver_id"];
        $msg_id = uniqid("", true);
        $message = $msg["msg"];
        $time_sent = time();

        $private_msg_sql = "INSERT INTO private_msgs (Msg_ID, Sender_WVSU_ID, Receiver_WVSU_ID, Msg, Time_Sent) VALUES (?, ?, ?, ?, ?)";
        $prep_private_msg = mysqli_prepare($conn, $private_msg_sql);
        mysqli_stmt_bind_param($prep_private_msg, "ssssi", $msg_id, $sender_id, $receiver_id, $message, $time_sent);
        mysqli_stmt_execute($prep_private_msg);
        mysqli_stmt_close($prep_private_msg);

        mysqli_close($conn);
    }
}
