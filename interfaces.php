<?php

interface query{
  const authLogin = "SELECT password FROM usr WHERE username=:username";
  const authSignup = "INSERT INTO usr (`username`, `name`,`email`,`password`) VALUES (:username, :name, :email,:password)";
  const checkUser = "SELECT username FROM usr WHERE username = :username";
  
  
  const usrPost = "SELECT * FROM usr_post LEFT JOIN usr ON usr.username = usr_post.username ORDER BY usr_post.post_date DESC LIMIT :page, :limit";

  const getPost = 'SELECT * FROM usr_post LEFT JOIN usr ON usr.username = usr_post.username ORDER BY post_time DESC LIMIT :page, :limit';
  const newPost = 'INSERT INTO usr_post (`post_id`,`username`,`post_content`,`post_likes`,`post_date`,`post_time`) VALUES (:post_id,:username, :post_content, :post_likes,:post_date, :post_time)';
  const insertPostLikes = 'INSERT INTO post_likes (`post_id`,`username`) VALUES (:post_id, :username)';
  const deletePostLikes = 'DELETE FROM post_likes WHERE post_id=:post_id AND username=:username';
  
  const getPostLikes = 'SELECT post_likes FROM usr_post WHERE post_id=:post_id';

  const updatePostLikes = 'UPDATE usr_post SET `post_likes`=:post_likes WHERE post_id=:post_id';
  
  const isLiked = 'SELECT post_id, username FROM post_likes WHERE username=:username AND post_id = :post_id';
  
}

?>