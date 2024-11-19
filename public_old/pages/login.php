<?php
require_once('../../private/hlprs/sess.php');

sessStart('CREDS');
sessCheckLogout();
sessCheckLogin('Location: dshbrd.php');

$login_path = 'login.php';

class LogIn
{
  private string $input_wid = '';
  private string $input_pswrd = '';
  private string $err_wid = '';
  private string $err_pswrd = '';
  private $tkn;
  private function isValidToken()
  {
    $post_tkn = filter_input(INPUT_POST, 'tkn_login', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sess_tkn = filter_var($_SESSION['tkn_login'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    return (bool) $post_tkn && ($post_tkn === $sess_tkn);
  }

  private function setLogInToken()
  {
    $_SESSION['tkn_login'] = '';
  }
  public function setAriaInvalid(string $lbl)
  {
    return empty($this->$lbl) ? 'false' : 'true';
  }

  public function setErrClass(string $lbl)
  {
    return empty($this->$lbl) ? 'form-err_lbl--hidden' : '';
  }

  private function getUserData()
  {
    $conn = mysqli_connect('meet_wvsu_db', 'root', '123', 'meet.wvsu');
    $san_input_wid = mysqli_escape_string($conn, $this->input_wid);

    $user_sql = "SELECT * FROM users WHERE WVSU_ID = '$san_input_wid'";
    $user_query = mysqli_query($conn, $user_sql);

    $user = mysqli_fetch_assoc($user_query);

    mysqli_free_result($user_query);
    mysqli_close($conn);
    return $user;
  }
  public function getInputWid()
  {
    return $this->input_wid;
  }
  public function getInputPswrd()
  {
    return $this->input_pswrd;
  }
  public function getErrWid()
  {
    return $this->err_wid;
  }
  public function getErrPswrd()
  {
    return $this->err_pswrd;
  }
  public function getToken()
  {
    return $this->tkn;
  }

  private function process()
  {
    $this->input_wid = filter_input(INPUT_POST, 'user_wid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $this->input_pswrd = filter_input(INPUT_POST, 'user_pswrd', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $user = $this->getUserData();

    if (empty($user)) {
      $this->err_wid = 'No account has the WVSU-ID you entered. Try signing-up for a new one.';
      return;
    }

    $is_valid_pswrd = password_verify($this->input_pswrd, $user['Password']);
    if ($is_valid_pswrd) {
      $_SESSION['user_name'] = $user['Name'];
      $_SESSION['user_wid'] = $user['WVSU_ID'];
      $_SESSION['has_logged_in'] = true;

      header('Location: dshbrd.php');
      exit;
    }

    $this->err_pswrd = 'You entered the wrong password.';
  }
  public function init()
  {
    $this->tkn = uniqid(mt_rand(), true);

    if (empty($_SESSION['tkn_login']))
      $this->setLogInToken();

    if ($this->isValidToken())
      $this->process();

    $_SESSION['tkn_login'] = $this->tkn;
  }
}

$log_in = new LogIn;
$log_in->init();

require_once('../../private/tmps/login.tmp.php');
?>