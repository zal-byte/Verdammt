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
    
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#">Logo</a>

  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="#">Link 1</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link 2</a>
    </li>

    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Dropdown link
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Link 1</a>
        <a class="dropdown-item" href="#">Link 2</a>
        <a class="dropdown-item" href="#">Link 3</a>
      </div>
    </li>
  </ul>
</nav>
    
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