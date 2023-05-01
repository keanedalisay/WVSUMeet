<?php
function sessStart(string $sess_name)
{
  session_name($sess_name);
  session_start();
}
;
?>