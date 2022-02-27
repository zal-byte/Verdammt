<?php
  error_reporting(1);
  ini_set("display_errors",1);
  
  session_start();
  
  empty($_SESSION['access']) ? header("location: auth.php") : null;
  require_once "dir.php";
  
  $dir = DIR::getInstance();
?>


<html>
  <head>
    <link rel="stylesheet" href="bs5/css/bootstrap.min.css">
    <meta name="viewport" content="device-width=weight, initial-scale=1.0">
    <title>
      Verdammt
    </title>
  </head>
  <body>
    
    <div class="container">
      <div class="card shadow-sm border-0 mt-3">
        <div class="card-body">
          <?php
          $data = json_decode($dir::get(__DIR__),1);
          
          
           
          ?>
        </div>
      </div>
    </div>
    
    <script type="text/javascript" src="bs5/js/bootstrap.min.js">
      
    </script>
  </body>
</html>