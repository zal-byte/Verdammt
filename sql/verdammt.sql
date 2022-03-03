DROP TABLE IF EXISTS usr;
DROP TABLE IF EXISTS usr_post;
DROP TABLE IF EXISTS post_image;
DROP TABLE IF EXISTS post_comment;
DROP TABLE IF EXISTS post_likes;


CREATE TABLE usr (
username VARCHAR(50) PRIMARY KEY NOT NULL,
name VARCHAR(50),
email VARCHAR(100),
password  TEXT NOT NULL,
img_path TEXT NOT NULL DEFAULT 'img/user/default.jpg')
COMMENT = 'User table';
/**
@table: usr
@description: User table
@location: 360.0 754.0
@columnsDescription:  username() name() email() password () img_path()
@colors: title(#FF4E0B3E) username(#FF666666) name(#FF666666) email(#FF666666) password (#FFA61C00) img_path(#FF666666)
*/

CREATE TABLE usr_post (
post_id VARCHAR(100) PRIMARY KEY NOT NULL,
username VARCHAR(50) NOT NULL,
post_date DATE NOT NULL,
post_time TIME NOT NULL,
post_content TEXT,
post_likes INT NOT NULL DEFAULT 0)
COMMENT = 'User post ';
/**
@table: usr_post
@description: User post 
@location: 648.0094 719.4176
@columnsDescription:  post_id() username() post_date() post_time() post_content() post_likes()
@colors: title(#FF104945) post_id(#FF666666) username(#FF666666) post_date(#FF666666) post_time(#FF666666) post_content(#FF666666) post_likes(#FF666666)
*/

CREATE TABLE post_image (
image_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
image_path TEXT NOT NULL,
post_id VARCHAR(100) NOT NULL)
COMMENT = 'Post image tables ';
/**
@table: post_image
@description: Post image tables 
@location: 969.39636 716.87305
@columnsDescription:  image_id() image_path() post_id()
@colors: title(#FF1C4E18) image_id(#FF666666) image_path(#FF666666) post_id(#FF666666)
*/

CREATE TABLE post_comment (
comment_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
comment_value TEXT,
post_id VARCHAR(100) NOT NULL)
COMMENT = 'Post comments';
/**
@table: post_comment
@description: Post comments
@location: 969.8965 885.5504
@columnsDescription:  comment_id() comment_value() post_id()
@colors: title(#FF4E1343) comment_id(#FF666666) comment_value(#FF666666) post_id(#FF666666)
*/

CREATE TABLE post_likes (
post_likes_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
post_id VARCHAR(100) NOT NULL,
username  VARCHAR(50) NOT NULL);
/**
@table: post_likes
@location: 638.00757 480.40955
@columnsDescription:  post_likes_id() post_id() username ()
@colors: title(#FF1B1F1E) post_likes_id(#FF666666) post_id(#FF666666) username (#FF666666)
*/

ALTER TABLE usr_post ADD CONSTRAINT usr_post_username_usr_username FOREIGN KEY (username) REFERENCES usr(username) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE post_image ADD CONSTRAINT post_image_post_id_usr_post_post_id FOREIGN KEY (post_id) REFERENCES usr_post(post_id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE post_comment ADD CONSTRAINT post_comment_post_id_usr_post_post_id FOREIGN KEY (post_id) REFERENCES usr_post(post_id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE post_likes ADD CONSTRAINT post_likes_post_id_usr_post_post_id FOREIGN KEY (post_id) REFERENCES usr_post(post_id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE post_likes ADD CONSTRAINT post_likes_username _usr_username FOREIGN KEY (username ) REFERENCES usr(username) ON DELETE CASCADE ON UPDATE CASCADE;
