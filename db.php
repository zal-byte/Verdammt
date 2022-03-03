<?php

class DB{
  private static $instance = null;
  private static $host = "localhost";
  private static $username = "root";
  private static $password = "";
  private static $dbname = "verdammt";
  
  public static function getInstance(){
    if ( self::$instance == null ){
      self::$instance = new DB();
    }
    return self::$instance;
  }
  private static $connection = null;
  public static function createConnection(){
    if( self::$connection == null ){
      self::$connection = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname ,self::$username, self::$password) or die("Couldn't connect to database");
    }
  }
  public static function getConnection(){
    if(self::$connection == null){
      self::createConnection();
    }
    return self::$connection;
  }
  public function __construct(){
    self::createConnection();
  }
}

?>