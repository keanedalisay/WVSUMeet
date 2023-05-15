<?php
require_once('../../private/hlprs/sess.php');

sessStart('CREDS');
sessCheckLogin('Location: dshbrd.php');
$login_path = 'login.php';

class SignUp
{
  private string $input_name = '';
  private string $input_wid = '';
  private string $input_pswrd = '';

  private string $err_wid = "";

  private $tkn;

  private function isNotUniqueWid()
  {
    $conn = mysqli_connect('localhost', 'root', '', 'meet.wvsu');

    $wid_sql = "SELECT WVSU_ID from users WHERE WVSU_ID = '$this->input_wid'";
    $wid_query = mysqli_query($conn, $wid_sql);

    $wid = mysqli_fetch_assoc($wid_query)['WVSU_ID'];
    mysqli_free_result($wid_query);
    mysqli_close($conn);

    if ($wid)
      return true;

    return false;
  }
  private function isValidToken()
  {
    $post_tkn = filter_input(INPUT_POST, 'tkn_signup', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sess_tkn = filter_var($_SESSION['tkn_signup'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    return (bool) $post_tkn && ($post_tkn === $sess_tkn);
  }

  private function postUserData()
  {
    $conn = mysqli_connect('localhost', 'root', '', 'meet.wvsu');

    $input_hshd_pswrd = password_hash($this->input_pswrd, PASSWORD_BCRYPT);
    $time_joined = time();

    $user_sql = "INSERT INTO users(Name, Password, WVSU_ID, Time_Joined) VALUES(?, ?, ?, ?)";
    $prep_sql = mysqli_prepare($conn, $user_sql);
    mysqli_stmt_bind_param($prep_sql, 'sssi', $this->input_name, $input_hshd_pswrd, $this->input_wid, $time_joined);
    mysqli_stmt_execute($prep_sql);
    mysqli_stmt_close($prep_sql);

    mysqli_close($conn);
  }

  private function setSignUpToken()
  {
    $_SESSION['tkn_signup'] = '';
  }
  public function setAriaInvalid(string $lbl)
  {
    return empty($this->$lbl) ? 'false' : 'true';
  }

  public function setErrClass(string $lbl)
  {
    return empty($this->$lbl) ? 'form-err_lbl--hidden' : '';
  }
  public function getInputName()
  {
    return $this->input_name;
  }
  public function getInputPswrd()
  {
    return $this->input_pswrd;
  }
  public function getInputWid()
  {
    return $this->input_wid;
  }
  public function getErrWid()
  {
    return $this->err_wid;
  }
  public function getToken()
  {
    return $this->tkn;
  }


  public function process()
  {

    $this->input_name = filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $this->input_wid = filter_input(INPUT_POST, 'user_wid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $this->input_pswrd = filter_input(INPUT_POST, 'user_pswrd', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($this->isNotUniqueWid()) {
      $this->err_wid = 'An account with this WVSU-ID already exists. Please contact the WVSU Registrar personally or email them at registrar@wvsu.edu.ph.';
      return;
    }

    $this->postUserData();

    $_SESSION['user_name'] = $this->input_name;
    $_SESSION['user_wid'] = $this->input_wid;
    $_SESSION['has_logged_in'] = true;

    header('Location: dshbrd.php');
  }
  public function init()
  {
    $this->tkn = uniqid(mt_rand(), true);
    if (empty($_SESSION['tkn_signup']))
      $this->setSignUpToken();

    if ($this->isValidToken())
      $this->process();

    $_SESSION['tkn_signup'] = $this->tkn;
  }
}

$sign_up = new SignUp();
$sign_up->init();

require_once('../../private/tmps/signup.tmp.php');
?>