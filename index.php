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
    
    <input id="page" value="0" hidden>
    <input id="limit" value="5" hidden>
    
    <div class="container" id="body_res">
      <div class="card shadow-sm border-0 mt-3">
        <div class="card-body">
          <div id="body-response">
            
          </div>
        </div>
      </div>
    </div>
    
    <ul class='nav-bar' style="position:fixed;">
      <li class="nav-item">
        <a id="home"><span class="fa fa-home"></span></a>
      </li>
      <li class="nav-item bg-info"><a id="new-post"><span class="fa fa-plus-square"></span></a></li>
      <li class="nav-item"><a id="profile"><span class="fa fa-user"></span></a></li>
      <li class="nav-item right bg-danger"><a href="logout.php" ><span class="fa fa-sign-out"></span></a></li>
    </ul>

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="bs5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="fa/js/all.min.js"></script>
      <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript">
      getPost($("#page").val(), $("#limit").val());
    </script>
  </body>
</html>