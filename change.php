<?php
require_once("./honey/connect.php");
if(!isset($_POST['username'])){
     header("Location:login.php");
    die();
}
session_start();
$_SESSION=array();
$_SESSION['username']=$_POST['username'];
//search database for username
$user=$_POST['username'];
$sql="SELECT * FROM `users` WHERE `username` = '{$user}'";
$result1=$conn->query($sql);
if ($result1->num_rows == 0) {header("Location:message.php?invalid=1");die();}
if(!isset($_SESSION['OTP']))$_SESSION['OTP']=generateRandomString(10);
echo $_SESSION['OTP'];
//generate ans send otp
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Change Password</title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/signup.css" rel="stylesheet">  

  </head>
  <body>
    
      <div class="container">
  
  <div class="row" id="pwd-container">
    <div class="col-md-4"></div>
    
    <div class="col-md-4">
      <section class="login-form">
        <form method="post" action="honey/reset.php" role="login" >
          <img src="assets/img/662135-8521.png" class="img-responsive" alt="" />
            <input type="text" name="OTP" class="form-control input-lg" id="otp" placeholder="OTP" required />
          
          <input type="password" class="form-control input-lg" id="password" name='password' placeholder="Password" required="" />
         
          
          
          <div class="pwstrength_viewport_progress"></div>
          
          
          <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Sign Up</button>
          
        </form>
        
        
      </section>  
      </div>
      
      <div class="col-md-4"></div>
      

  </div>
  
  
  
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/signup.js"></script>
    
  </body>
</html> 