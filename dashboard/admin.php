<?php
session_start();
    if(empty($_SESSION) or !isset($_SESSION['username']) or !isset($_SESSION['status']) or !isset($_SESSION['LoggedIn'])) die("Oops something went wrong. Please try signing up or logging in again");
    if(!($_SESSION['status']>='2' and $_SESSION['LoggedIn']==TRUE and isset($_SESSION['OTP']))) {header("Location:../login.php");die("Unauthorised Access Detected");}
   
    require_once("connect.php");
    if(isset($_POST) and isset($_POST['uid']) and isset($_POST['action'])){
        $sql="UPDATE `sensordata`.`users` SET `status` = '{$_POST['action']}' WHERE `users`.`userID` = {$_POST['uid']};";
        $conn->query($sql);
    }
    $sql="select userID, username, email from users where status = 0";
    $result1=$conn->query($sql);
    $sql="select userID, username, email from users where status = 1";
    $result2=$conn->query($sql);
    $sql="select userID, username, email from users where status = 2";
    $result3=$conn->query($sql);
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
<!--    <link rel="icon" href="../../favicon.ico">-->

    <title>Dashboard Overview</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="../assets/css/dashboard.css" rel="stylesheet">
    <link href="../assets/css/switch.css" rel="stylesheet">

</head>

<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Project name</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar">
                    <li ><a href="overview.php">Overview <span class="sr-only">(current)</span></a></li>
                    <li ><a href="statistics.php">Usage Statistics</a></li>
                    <li><a href="control.php">System Control</a></li>
                    <li class="active"><a href="#">Admin Panel</a></li>
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <div class="row">
                    <h3>Blocked users</h3><hr/>
                    <table class="table table-striped">
                        <thead>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Unblock</th>
                        </thead>
                        <tbody>
                            <?php
                            while($row=$result1->fetch_assoc()){
                              ?>
                            <tr>
                                <td><?=$row['username']?></td>
                                <td><?=$row['email']?></td>
                                <td><form action="<?=$_SERVER['PHP_SELF']?>" method="post"> <input name="uid" value="<?=$row['userID']?>" readonly style="visibility:hidden;"> <button class="btn btn-block btn-success " type="submit" name='action' value="1">Unblock</button></form></td>
                            </tr>
                            <?php  
                            }
                            ?>
                        </tbody>
                    </table>
                    <hr/>
                    <h3>Active users</h3><hr/>
                    <table class="table table-striped">
                        <thead>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Make Admin</th>
                            <th>block</th>
                        </thead>
                        <tbody>
                            <?php
                            while($row=$result2->fetch_assoc()){
                              ?>
                            <tr>
                                <td><?=$row['username']?></td>
                                <td><?=$row['email']?></td>
                                <td><form action="<?=$_SERVER['PHP_SELF']?>" method="post"> <input name="uid" value="<?=$row['userID']?>" readonly style="visibility:hidden;"> <button class="btn btn-block btn-success " type="submit" name='action' value="2">Make Admin</button></form></td>
                                <td><form action="<?=$_SERVER['PHP_SELF']?>" method="post"> <input name="uid" value="<?=$row['userID']?>" readonly style="visibility:hidden;"><button class="btn btn-block btn-danger " type="submit" name='action' value="0">Block</button></form></td>
                            </tr>
                            <?php  
                            }
                            ?>
                            
                        </tbody>
                    </table>
                    <hr/>
                    <h3>Admin users</h3><hr/>
                    <table class="table table-striped">
                        <thead>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Remove admin</th>
                            <th>block</th>
                        </thead>
                        <tbody>
                            <?php
                            while($row=$result3->fetch_assoc()){
                              ?>
                            <tr>
                                <td><?=$row['username']?></td>
                                <td><?=$row['email']?></td>
                                <td><form action="<?=$_SERVER['PHP_SELF']?>" method="post"> <input name="uid" value="<?=$row['userID']?>" readonly style="visibility:hidden;"><button class="btn btn-block btn-warning " type="submit" name='action' value="1">Remove Admin</button></form></td>
                                <td><form action="<?=$_SERVER['PHP_SELF']?>" method="post"> <input name="uid" value="<?=$row['userID']?>" readonly style="visibility:hidden;"><button class="btn btn-block btn-danger " type="submit" name='action' value="0">Block</button></form></td>
                            </tr>
                            <?php  
                            }
                            ?>
                        </tbody>
                    </table>
                    <hr/>
                </div>    
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="../assets/js/bootstrap.min.js"></script>
    
</body>

</html>