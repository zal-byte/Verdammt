<?php

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
  
  #User HANDLER
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
  
  
  public static function prepare( $query, $param = null ){
    
    $pdo = self::$con->prepare($query);
    
    if($param != null){
      $pdo->execute($param);
    }else{
      $pdo->execute();
    }
    return $pdo;
    
  }
  public static function fetch_assoc( $pdo_statement ){
    return $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
  }
  public static function validate( $array, $name ){
    return empty($array[$name]) ? die("missing ({$name})") : $array[$name];
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