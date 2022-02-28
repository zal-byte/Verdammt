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
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="fa/css/all.min.css">
    <meta name="viewport" content="device-width=weight, initial-scale=1.0">
    <title>
      Verdammt
    </title>
  </head>
  <body>
    
<ul class='nav-bar' style="position:fixed;margin-bottom:20px;">
  <li class="nav-item bg-info"><a><span class="fa fa-plus-square"></span></a></li>
  <li class="nav-item"><a><span class="fa fa-user"></span></a></li>
  <li class="nav-item right bg-danger"><a href="logout.php" ><span class="fa fa-sign-out"></span></a></li>
</ul>
    
    <div class="container">
      <div class="card shadow-sm border-0 mt-3">
        <div class="card-body">
          <?php
          
          $data = json_decode($dir::get(__DIR__),1);
          print_r($data)
           
          ?>
        </div>
      </div>
    </div>
    
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="bs5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="fa/js/all.min.js"></script>
  </body>
</html>