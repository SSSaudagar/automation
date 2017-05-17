<?php 
    session_start();
    if(empty($_SESSION) or !isset($_SESSION['username']) or !isset($_SESSION['status'])) die("Oops something went wrong. Please try signing up or logging in again");
    if (!isset($_POST['OTP']) and isset($_SESSION['OTP')){
        //sendmail
        //echo $_SESSION['OTP'];
    }
    if(isset($_POST['OTP'])){
        if($_POST['OTP']==$_SESSION['OTP']){
            $_SESSION['LoggedIn']=TRUE;
            header("Location:dashboard/overview.php");
            die();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Account Login</title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/signup.css" rel="stylesheet">  
      <style>
          #username{
              font-size: 200%;
          }
          #error{
              color: darkred;
          }
      </style>
  </head>
  <body>
    
      <div class="container">
  
  <div class="row" id="pwd-container">
    <div class="col-md-4"></div>
    
    <div class="col-md-4">
      <section class="login-form">
        <form method="post" action="#" role="login">
          <img src="assets/img/662135-8521.png" class="img-responsive" alt="" />
          <div id=username ><?=$_SESSION['username']?></div>
          <input type="password" class="form-control input-lg" name="OTP" id="pass" placeholder="Enter OTP" required="" <?php if($_SESSION['status']=='0') echo "readonly" ?>/>
            <?php if($_SESSION['status']=='0') {?>    <div id=error>
                Either you are attempting to log into a new account or your account has been blocked. Please contact admin to grant access to your user.
            </div> <?php }else{ ?>
          <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Log In</button>
            <?php } ?>
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
  </body>
</html>