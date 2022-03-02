<?php
  
  date_default_timezone_set("Asia/Jakarta");

  ini_set("display_errors",1);
  
  session_start();
  
  !empty($_SESSION['access']) ? null : header("auth.php");

  require_once 'handler.php';
  
  HANDLER::getInstance();
  
  //echo "<pre>";
 // print_r($_SERVER);
//  echo "</pre>";
  if(isset($_SERVER))
  {
    if($_SERVER["HTTP_SEC_FETCH_MODE"] == "cors"){
      if( $_SERVER['REQUEST_METHOD'] == 'GET')
       {
      $request = HANDLER::validate( $_GET, 'request');
      if( $request == 'getPost')
      {
        $page = HANDLER::validate( $_GET, 'page');
        $limit = HANDLER::validate( $_GET, 'limit');
        
        $status = HANDLER::getPost( $page, $limit );
        
        $status != null ? null : die("No Connection");
        
        if( $status[0] == true )
        {
          include "layout/post_layout.php";
        }else if($status[0] == false ){
          if( $status[1] == "no_data")
          {
            $html = "";
            $html .= "<div class='bg-danger p-2 text-white'>";
            $html .= '<div class="d-flex justify-content-center"><span class="fa fa-2x fa-warning"></span></div>';
            $html .= "<p class='text-center'>No Data</p>";
            $html .= '</div>';
            echo $html;
          }else{
            die($status[1]);
          }
        }
      }else if($request=='postLike'){
        $post_id = HANDLER::validate($_GET, 'post_id');
        $my_username = HANDLER::validate($_GET, "my_username");
        
        $res = HANDLER::insertPostLikes($post_id, $my_username);
        
        HANDLER::echo_json( $res );
        
      }
    }else if ($_SERVER['REQUEST_METHOD']=="POST"){
      
      $response = array();
      
      $request = HANDLER::validate($_POST, "request");
      if($request == "newPost"){
        $username = HANDLER::validate($_POST, "username");
        $post_content = HANDLER::validate($_POST, "post_content");
        
        $post_date = date("Y-m-d");
        $post_time = date("H:m:s");
        
        $post_id = "post_" . base64_encode( $post_date . "_" . $post_time . "_" . uniqid());
        
        $param = array('username'=>$username, 'post_content'=>$post_content,'post_date'=>$post_date, 'post_id'=>$post_id, 'post_time'=>$post_time, 'post_likes'=>0);
        
        
        $prepare = HANDLER::prepare(HANDLER::newPost, $param);
        
        if( $prepare )
        {
          $re['status'] = true;
          $re['msg'] = 'New post has been submited';
        }else{
          $re['status'] = false;
          $re['msg'] = "Couldn't execute the queries";
        }
    
        
        array_push( $response, $re);
        HANDLER::echo_json( $response );
    
      }
    }
    }else{
      die("ACCESS DENIED");
    }
  }
  

?>