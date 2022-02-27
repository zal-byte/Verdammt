<?php

session_start();

if(!empty($_SESSION['access'])){
  unset($_SESSION['access']);
  unset($_SESSION['username']);
  unset($_SESSION['auth_error']);
  session_destroy();
  
  header("location: auth.php?func=signin");
}else{
  header("location: auth.php?func=signin");
}

?>