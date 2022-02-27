<?php session_start();
  ini_set("display_errors",1);
  !empty($_SESSION['access']) ? header("location: index.php") : null;
  
  require_once 'handler.php';
  
  //access HANDLER instance
  HANDLER::getInstance();
  
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!empty($_POST['request'])){
      if($_POST['request']=='login'){
      $username = HANDLER::validate($_POST, "username");
      $password = HANDLER::validate($_POST, "password");
    
      $status = HANDLER::val_len(5, array($username, $password));
      $status[0] == false ? $_SESSION['auth_error'] = $status[1] : null;
      
      $status = HANDLER::authLogin( $username, $password);
      if($status[0] == true ){
        $_SESSION['username'] = $username;
        $_SESSION['access'] = 1;
        header("location: index.php");
      }else{
        $_SESSION['auth_error'] = $status[1];
      }
      
      }else if($_POST['request'] == 'signup'){
        $username = HANDLER::validate($_POST, "username");
        $name = HANDLER::validate($_POST, "name");
        $email = HANDLER::validate($_POST,"email");
        $password = HANDLER::validate($_POST, "password");
        $verify_password = HANDLER::validate($_POST,"verify_password");
    
        $status = HANDLER::val_len( 5, array($username,$email, $password));
        $status_1 = HANDLER::val_len( 2, array($name));
        
        if($status[0] == true){
          if($status_1[0] == true){
             $data = array("username"=>$username, "name"=>$name, "email"=>$email,"password"=>$password);
             
             if( $verify_password == $password ){
               $status = HANDLER::authSignup( $data );
               if($status[0] == true){
                 $_SESSION['auth_success'] = "Signup Successfuly.";
                 header("location: auth.php?func=signin");
               }else{
                 $_SESSION['auth_error'] = $status[1];
               }
             }else{
               $_SESSION['auth_error'] = "Password verify doesn't match";
             }
             
          }else{
            $_SESSION['auth_error'] = $status_1[1];
          }
        }else{
          $_SESSION['auth_error'] = $status[1];
        }
      }
    }
    
  }
?>

<html>
  <head>
    <link rel="stylesheet" href="bs5/css/bootstrap.min.css">
    <meta name="viewport" content="device-width=weight,initial-scale=1.0">
    <title>
      Need authorization
    </title>
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <?php
          function login(){
            ?>
           <div class="card shadow-sm border-0">
            <div class="card-body">
              <h4 class="text-center">
                User Login
              </h4>
              <form method="post" action="#" enctype="multipart/form-data">
                <input type="text" name="username" placeholder="Username" class="form-control mb-2">
                <input type="password" name="password" class="form-control mb-2" placeholder="Password">
                <input name="request" value="login" hidden>
                <button type="submit" class="btn btn-block btn-info text-white" style="width:100%;"> Login </button>
              </form>
              <?php
              if(isset($_SESSION['auth_error'])){
                ?>
                <p class="bg-danger text-center text-white p-2 rounded">
                  <?php echo $_SESSION['auth_error'];?>
                </p>
                <?php
                unset($_SESSION['auth_error']);
              }else if(isset($_SESSION['auth_success'])){
                ?>
                <p class="text-center text-white bg-success p-2 rounded">
                  <?php echo $_SESSION['auth_success']; ?>
                </p>
                <?php
              }
              ?>
              <p class="text-center">Doesn't have any account?, <a class="text-success" href="auth.php?func=signup" style="text-decoration:none;">Signup</a>.</p>
            </div>
          </div>           
            <?php
          }
          function register(){
            ?>
            <div class="card shadow-sm border-0">
              <div class="card-body">
                <h4 class="text-center">
                  User Signup
                </h4>
                <form method="post" action="#" enctype="multipart/form-data">
                  <input name="request" value="signup" hidden>
                  <input type="text" name="username" placeholder="Username" class="form-control mb-2">
                  <input type="text" name="name" class="form-control mb-2" placeholder="Full name">
                  <input type="email" name="email" placeholder="Email" class="form-control mb-2">
                  <hr>
                  <input type="password" name="password" class="form-control mb-2" placeholder="Password">
                  <input type="password" name="verify_password" class="form-control mb-2" placeholder="Verify Password">
                  <hr>
                  <button style="width:100%;" type="submit" class="btn btn-block btn-success text-white">Register</button>
                </form>
                <?php
                  if(isset($_SESSION['auth_error'])){
                    ?>
                    <p class="bg-danger text-center text-white p-2 rounded">
                      <?php echo $_SESSION['auth_error'];?>
                    </p>
                    <?php
                    unset($_SESSION['auth_error']);
                  }
              ?>
                <p class="text-center">
                  Already have an account ?, <a href="auth.php?func=signin" style="text-decoration:none;">Login</a>.
                </p>
              </div>
            </div>
            <?php
          }
          if(isset($_GET['func'])){
            if($_GET['func'] == "signin"){
              login();
            }else if($_GET['func']=="signup"){
              register();
            }else{
              login();
            }
          }else{
            login();
          }
          ?>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="bs5/js/bootstrap.min.js">
      
    </script>
  </body>
</html>