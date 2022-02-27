<?php

interface query{
  const authLogin = "SELECT password FROM usr WHERE username=:username";
  const authSignup = "INSERT INTO usr (`username`, `name`,`email`,`password`) VALUES (:username, :name, :email,:password)";
  const checkUser = "SELECT username FROM usr WHERE username = :username";
  
  
  const usrPost = "SELECT * FROM usr_post LEFT JOIN usr ON usr.username = usr_post.username ORDER BY usr_post.post_date DESC LIMIT :page, :limit";
  
}

?>