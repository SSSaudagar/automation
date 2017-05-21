<?php
session_start();
    if(empty($_SESSION) or !isset($_SESSION['username']) or !isset($_SESSION['status']) or !isset($_SESSION['LoggedIn'])) die("Oops something went wrong. Please try signing up or logging in again");
    if(!($_SESSION['status']>='1' and $_SESSION['LoggedIn']==TRUE and isset($_SESSION['OTP']))) die("Unauthorised Access Detected");
require_once("connect.php"); 
$led=array();
$result1=$conn->query("SELECT * FROM `led` ");
if ($result1->num_rows > 0) {
    while($row=$result1->fetch_assoc()){
        $led[$row['id']]=$row['value'];
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
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="../assets/css/dashboard.css" rel="stylesheet">
    <link href="../assets/css/switch.css" rel="stylesheet">
    
    <script>
        function changeState(led,name){
            if($('#'+led).is(":checked")){
                var value=1;
            }else{
                var value=0;
            }

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
             xmlhttp.open("GET", "ledcontrol.php?led=" + name+ "&value="+value, true);
            xmlhttp.send();
        }
    </script>

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
                    <li><a href="overview.php">Overview <span class="sr-only">(current)</span></a></li>
                    <li><a href="statistics.php">Usage Statistics</a></li>
                    <li class="active"><a href="#">System Control</a></li>
                    <li><a href="admin.php">Admin Panel</a></li>
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">Dashboard</h1>

                
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
                        <div class="panel panel-default">
                            <!-- Default panel contents -->
                            <div class="panel-heading">Material Design Switch Demos</div>

                            <!-- List group -->
                            <ul class="list-group">
<!--
                                <li class="list-group-item">
                                    Bootstrap Switch Default
                                    <div class="material-switch pull-right">
                                        <input id="someSwitchOptionDefault" name="someSwitchOption001" type="checkbox" />
                                        <label for="someSwitchOptionDefault" class="label-default"></label>
                                    </div>
                                </li>
-->
                                <li class="list-group-item">
                                    LED BLUE
                                    <div class="material-switch pull-right">
                                        <input id="someSwitchOptionPrimary" name="1" onclick="changeState(this.id,this.name)" type="checkbox" <?php if($led[1]==1) echo "checked"; ?> />
                                        <label for="someSwitchOptionPrimary" class="label-primary"></label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    LED GREEN
                                    <div class="material-switch pull-right">
                                        <input id="someSwitchOptionSuccess" name="2" onclick="changeState(this.id,this.name)" type="checkbox" <?php if($led[2]==1) echo "checked"; ?>/>
                                        <label for="someSwitchOptionSuccess" class="label-success"></label>
                                    </div>
                                </li>
<!--
                                <li class="list-group-item">
                                    Bootstrap Switch Info
                                    <div class="material-switch pull-right">
                                        <input id="someSwitchOptionInfo" name="someSwitchOption001" type="checkbox" />
                                        <label for="someSwitchOptionInfo" class="label-info"></label>
                                    </div>
                                </li>
-->
                                <li class="list-group-item">
                                    LED YELLOW
                                    <div class="material-switch pull-right">
                                        <input id="someSwitchOptionWarning" name="3" onclick="changeState(this.id,this.name)" type="checkbox" <?php if($led[3]==1) echo "checked"; ?>/>
                                        <label for="someSwitchOptionWarning" class="label-warning"></label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    LED RED
                                    <div class="material-switch pull-right">
                                        <input id="someSwitchOptionDanger" name="4" onclick="changeState(this.id,this.name)" type="checkbox" <?php if($led[4]==1) echo "checked"; ?>/>
                                        <label for="someSwitchOptionDanger" class="label-danger"></label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

<!--                <div id=txtHint></div>-->
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