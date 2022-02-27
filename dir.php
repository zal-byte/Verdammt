<?php

 class DIR{
   private static $instance = null;
   public static function getInstance(){
     if( self::$instance == null ){
       self::$instance = new DIR();
     }
     return self::$instance;
   }
   
   
  public static function get( $path ){
    $array = array();
    $dir = dir($path);
    while(($file = $dir->read()) != false){
      if($file == "" or $file == "." or $file == ".."){
        continue;
      }else{
        $re = pathinfo($file)["filename"];
        if(is_file($file)){
          $ext = pathinfo($file)["extension"];
          $re .= "." . $ext;
        }
        array_push($array, $re);
      }
    }
    return json_encode($array);
  }
 }

?>