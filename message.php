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
        <form method="post" action="" role="login">
          <img src="assets/img/662135-8521.png" class="img-responsive" alt="" />
          
            <?php if(isset($_GET['invalid']) and $_GET["invalid"]==1) {?>    <div id=error>
                Attempt failed. Please try again;
            </div> <?php } ?>
          <?php if(isset($_GET['success']) and $_GET["success"]==1) {?>    <div id=error>
                password change successful
            </div> <?php } ?>
          <div>
            Log In <a href="login.php">Here</a>  
          </div>
          
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