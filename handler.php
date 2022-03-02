<?php

ini_set('display_errors', 1);

require_once 'db.php';
require_once 'interfaces.php';

DB::createConnection();


class HANDLER implements query{
  private static $instance = null;
  private static $con = null;
  public static function getInstance(){
    if( self::$instance == null){
      self::$instance = new HANDLER();
    }
    return self::$instance;
  }
  public function __construct(){
    if (self::$con == null){
      self::$con = DB::getConnection();
    }
  }
  public static function echo_json( $data ){
    echo json_encode( $data );
  }
  #User HANDLER
  
  private static function checkUser( $username ){
    
    $prepare = self::prepare( HANDLER::checkUser, array('username'=>$username));
    
    if( $prepare ){
      if( $prepare->rowCount() > 0){
        return true;
      }else{
        return false;
      }
    }else{
      die("Error");
    }
    
  }
  
  
  public static function authSignup( $post ){
    
    $username = $post["username"];
    $password = $post["password"];
    $name = $post["name"];
    $email = $post["email"];
    
    $param = array("username"=>$username, "email"=>$email, "name"=>$name, "password"=>md5($password));
    
    if( self::checkUser($username) != true ){
      $prepare = self::prepare( self::authSignup, $param );
      if( $prepare ){
        return [true, "Signup Successfuly"];
      }else{
        return [false, "Couldn't execute the query"];
      }
    }else{
      return [false, $username . ", Already exists."];
    }
  }
  
  public static function authLogin( $username, $password ){
    $prepare = self::prepare( HANDLER::authLogin, array("username"=>$username));
    
    if($prepare){
      if($prepare->rowCount() > 0){
        $pw = self::fetch_assoc( $prepare )[0]["password"];
        if( md5($password) == $pw ){
          return [true, "Login Successfuly"];
        }else{
          return [false, "Invalid password"];
        }
      }else{
        return [false, "User not found"];
      }
    }else{
      die("Execute error");
    }
  }
  #User HANDLER
  
  #Post HANDLER
  
  public static function updatePostLikes( $post_id , $num){
    $param = array('post_id'=>$post_id, 'post_likes'=>$num);
    
    $prepare = self::prepare( HANDLER::updatePostLikes, $param);
    if( $prepare ){
      return true;
    }else{
      die("execute error");
    }
    
    
  }
  
  public static function insertPostLikes( $post_id , $username ){
    
    if(self::isLiked($post_id, $username) != false )
    {
      //do-like
      $param = array('username'=>$username, 'post_id'=>$post_id);
      
      $prepare = self::prepare(HANDLER::insertPostLikes, $param);
      if( $prepare ){
        $num = self::getPostLikes( $post_id );
        if( self::updatePostLikes($post_id, $num + 1) == true ){
          return [true, $num];
        }else{
          return [false, 'update error'];
        }
      }else{
        return [false, 'execute failed'];
      }
    }else{
      //donot-like
      $prepare = self::prepare(HANDLER::deletePostLikes, array('post_id'=>$post_id, 'username'=>$username));
      if( $prepare ){
        $num = self::getPostLikes($post_id);
        if(self::updatePostLikes($post_id, $num - 1) == true){
          return [true, $num];
        }else{
          return [false, 'Update error'];
        }
      }else{
        return [false, 'execute failed.'];
      }
    }
  }
  
  public static function getPostLikes( $post_id ){
    $prepare = self::prepare( HANDLER::getPostLikes, array('post_id'=>$post_id));
    if($prepare){
      $num = self::fetch_assoc($prepare)[0]['post_likes'];
      return $num;
    }else{
      die("ERROR");
    }
  }
  
  private static function isLiked( $post_id, $username){
    
    $param = array('username'=>$username, 'post_id'=>$post_id);
    
    $prepare = self::prepare( HANDLER::isLiked, $param );
    if( $prepare ){
      if( $prepare->rowCount() > 0){
        return false;
      }else{
        return true;
      }
    }else{
      return [false, 'Execute failed'];
    }
    
  }
  
  public static function getPost( $page, $limit )
  {
    $query = str_replace(":page",$page, str_replace(":limit",$limit, HANDLER::getPost));
    
    $prepare = self::prepare( $query );
    
    if( $prepare)
    {
      if( $prepare->rowCount() > 0 )
      {
        $array = array();
        $data = self::fetch_assoc( $prepare );
        for($i = 0; $i < count($data); $i++)
        {
          $re['post_id'] = $data[$i]['post_id'];
          $re['username'] = $data[$i]['username'];
          $re['post_date'] = $data[$i]['post_date'];
          $re['post_time'] = $data[$i]['post_time'];
          $re['post_content'] = $data[$i]['post_content'];
          $re['post_likes'] = $data[$i]['post_likes'];
          
          $re["name"] = $data[$i]["name"];
          $re["usr_img"] = $data[$i]["img_path"];
          
          array_push($array, $re);
        }
        return !empty($array) ? $array : null;
      }else{
        return [false, "no_data"];
      }
    }else
    {
      [false, "Couldn't execute the queries."];
    }
  }
  
  public static function getPostID( $username ){
    $query = 'SELECT post_id FROM usr_post WHERE username=:username';
    $prepare = self::prepare($query, array('username'=>$username));
    if( $prepare->rowCount() > 0  )
    {
      $data = self::fetch_assoc( $prepare )[0]['post_id'];
      return $data;
    }else{
      return [false, 'no_data'];
    }
  }
  
  #Post HANDLER
  
  public static function prepare( $query, $param = null ){
    
    if(self::$con != null ){
      $pdo = self::$con->prepare($query);
      
      if($param != null){
        $pdo->execute($param);
      }else{
        $pdo->execute();
      }
      return $pdo;      
    }else{
      return false;
    }
  }
  public static function fetch_assoc( $pdo_statement ){
    return $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
  }
  public static function validate( $array, $name ){
    return !isset($array[$name]) ? die("missing ({$name})") : $array[$name];
  }
  public static function val_len( $count, $data ){
    $re = array();
    $re['count'] = $count;
    $re['data'] = $data;
    return self::validate_length( $re );
  }
  private static function validate_length( $array ){
    $num = null;
    
    
    $keys = array_keys($array);
    foreach ($keys as $key){
      if( $key == "count"){
        $num = $array[$key];
      }
      if( $key == "data" ){
          $data = $array[$key];
          foreach ( $data as $val ){
            if( strlen($val) >= $num ){
              return [true,];
            }else{
              return [false, $val . ", min length is : {$num}."];
            }
          }
      }
    }
    
  }
}

?>