<?php

namespace WvsuMeet;
class LogIn {
  private string $input_wvsuid = "";
  private string $input_password = "";

  public function __construct() {

    $this->input_wvsuid = filter_input(INPUT_POST, "user_wvsuid", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $this->input_password = filter_input(INPUT_POST, "user_password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $user = $this->getUserData();

    $is_valid_pswrd = password_verify($this->input_password, $user["Password"]);
    if ($is_valid_pswrd) {
      $_SESSION["user_name"] = $user["Name"];
      $_SESSION["user_wvsuid"] = $user["WVSU_ID"];
      $_SESSION["user_profile"] = $user["Profile"];
      $_SESSION["has_logged_in"] = true;

      header("Location: /chat");
      exit;
    }
  }

  private function getUserData()
  {
    $conn = mysqli_connect("meet_wvsu_db", "root", "123", "meet.wvsu");
    $san_input_wvsuid = mysqli_escape_string($conn, $this->input_wvsuid);

    $user_sql = "SELECT * FROM users WHERE WVSU_ID = '$san_input_wvsuid'";
    $user_query = mysqli_query($conn, $user_sql);

    $user = mysqli_fetch_assoc($user_query);

    mysqli_free_result($user_query);
    mysqli_close($conn);
    return $user;
  }
}



