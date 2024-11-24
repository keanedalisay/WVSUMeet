<?php

namespace WvsuMeet;

class SignUp
{
  private string $input_name = "";
  private string $input_wvsuid = "";
  private string $input_password = "";

  public function __construct() {
    $this->input_name = filter_input(INPUT_POST, "user_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $this->input_wvsuid = filter_input(INPUT_POST, "user_wvsuid", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $this->input_password = filter_input(INPUT_POST, "user_password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $this->postUserData();

    $_SESSION["user_name"] = $this->input_name;
    $_SESSION["user_wvsuid"] = $this->input_wvsuid;
    $_SESSION["has_logged_in"] = true;

    header("Location: /chat");
  }

  private function isNotUniqueWvsuid()
  {
    $conn = mysqli_connect("meet_wvsu_db", "root", "123", "meet.wvsu");

    $wvsuid_sql = "SELECT WVSU_ID from users WHERE WVSU_ID = '$this->input_wvsuid'";
    $wvsuid_query = mysqli_query($conn, $wvsuid_sql);
    $wvsuid = mysqli_fetch_assoc($wvsuid_query);
    mysqli_free_result($wvsuid_query);
    mysqli_close($conn);

    if ($wvsuid)
      return true;

    return false;
  }

  private function postUserData()
  {
    $conn = mysqli_connect("meet_wvsu_db", "root", "123", "meet.wvsu");

    $input_hshd_password = password_hash($this->input_password, PASSWORD_BCRYPT);
    $time_joined = time();

    $user_sql = "INSERT INTO users(Name, Password, WVSU_ID, Time_Joined) VALUES(?, ?, ?, ?)";
    $prep_sql = mysqli_prepare($conn, $user_sql);
    mysqli_stmt_bind_param($prep_sql, "sssi", $this->input_name, $input_hshd_password, $this->input_wvsuid, $time_joined);
    mysqli_stmt_execute($prep_sql);
    mysqli_stmt_close($prep_sql);

    mysqli_close($conn);
  }
}