<?php 
  require_once("../../core/initialize.php");
  global $database;
  $auth =  new GoogleAuth($database);
  $auth->logout();
  redirect_to('login.php');
?>
