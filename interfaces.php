<?php

interface query{
  const authLogin = "SELECT password FROM usr WHERE username=:username";
  const authSignup = "INSERT INTO usr (`username`, `name`,`email`,`password`) VALUES (:username, :name, :email,:password)";
  const checkUser = "SELECT username FROM usr WHERE username = :username";
}

?>