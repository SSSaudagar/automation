<?php 
session_start();
    if(empty($_SESSION) or !isset($_SESSION['username']) or !isset($_SESSION['status']) or !isset($_SESSION['LoggedIn'])) die("Oops something went wrong. Please try signing up or logging in again");
    if(!($_SESSION['status']>='1' and $_SESSION['LoggedIn']==TRUE and isset($_SESSION['OTP']))) die("Unauthorised Access Detected");

require_once("connect.php"); 

$result1=$conn->query("SELECT * FROM `dht11` ORDER BY `dht11`.`ROWID` DESC limit 1");
if ($result1->num_rows > 0) {
    $row=$result1->fetch_assoc();
    $temp=$row['TEMPERATURE'];
    $hum=$row['HUMIDITY'];
}else{
    $temp=False;
    $hum=False;
}
$result1=$conn->query("SELECT * FROM `mq2` ORDER BY `mq2`.`ROWID` DESC  limit 1");
if ($result1->num_rows > 0) {
    $row=$result1->fetch_assoc();
    $smoke=$row['GAS_LEVEL'];
}else{
    $smoke=False;
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
                        <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
                        <li><a href="statistics.php">Usage Statistics</a></li>
                        <li><a href="control.php">System Control</a></li>
                        <li><a href="admin.php">Admin Panel</a></li>
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h1 class="page-header">Dashboard</h1>

                    <div class="row placeholders">
                        <div class="col-xs-12 col-sm-4 placeholder">
                            <div id="chart_div"></div>
                            <h4>SMOKE</h4>
                            <span class="text-muted">Smoke in the Room in Units </span>
                        </div>
                        <div class="col-xs-12 col-sm-4 placeholder">
                            <div id="chart_div2"></div>
                            <h4>Temperature</h4>
                            <span class="text-muted">Room Temperature in Celcius</span>
                        </div>
                        <div class="col-xs-12 col-sm-4 placeholder">
                            <div id="chart_div3"></div>
                            <h4>Humidity</h4>
                            <span class="text-muted">Humidity in units</span>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <script src="../assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script>
            google.charts.load('current', {
                packages: ['gauge']
            });
            google.charts.setOnLoadCallback(drawBackgroundColor);

            function drawBackgroundColor() {

                var data1 = google.visualization.arrayToDataTable([
              ['Label', 'Value'],
              ['Smoke', <?=$smoke?>],
            ]);
                var options1 = {
                    width: 300,
                    height: 300,
                    greenFrom: 0,
                    greenTo: 100,
                    redFrom: 200,
                    redTo: 300,
                    min: 0,
                    max: 300,
                    majorTicks: [<?php for($i=0;$i<=300;$i+=20)  echo "'{$i}'," ?>],
                    minorTicks: 10
                };

                var chart1 = new google.visualization.Gauge(document.getElementById('chart_div'));
                chart1.draw(data1, options1);
                //            setInterval(function() {
                //              data1.setValue(0, 1, 10 + Math.round(40 * Math.random()));
                //              chart1.draw(data1, options1);
                //            }, 5000);
                //            



                var data2 = google.visualization.arrayToDataTable([
              ['Label', 'Value'],
              ['Temp', <?=$temp ?>],
            ]);
                var options2 = {
                    width: 300,
                    height: 300,
                    greenColor: "#0000FF",
                    greenFrom: -10,
                    greenTo: 5,
                    redFrom: 50,
                    redTo: 80,
                    min: -10,
                    max: 80,
                    majorTicks: [<?php for($i=-10;$i<=80;$i+=10)  echo "'{$i}'," ?>],
                    minorTicks: 10
                };

                var chart2 = new google.visualization.Gauge(document.getElementById('chart_div2'));
                chart2.draw(data2, options2);
                //            setInterval(function() {
                //              data2.setValue(0, 1, 10 + Math.round(40 * Math.random()));
                //              chart2.draw(data2, options2);
                //            }, 5000);





                var data3 = google.visualization.arrayToDataTable([
              ['Label', 'Value'],
              ['Hum', <?=$hum?>],
            ]);
                var options3 = {
                    width: 300,
                    height: 300,
                    greenFrom: 40,
                    greenTo: 70,
                    min: 0,
                    max: 150,
                    majorTicks: [<?php for($i=0;$i<=150;$i+=15) echo "'{$i}'," ?>],
                    minorTicks: 15
                };

                var chart3 = new google.visualization.Gauge(document.getElementById('chart_div3'));
                chart3.draw(data3, options3);
                //            setInterval(function() {
                //              data3.setValue(0, 1, 20 + Math.round(100 * Math.random()));
                //              chart3.draw(data3, options3);
                //            }, 5000);



                setInterval(function () {
                    //ajax code here
                    var xmlhttp = new XMLHttpRequest();
                    var jsonobj;
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            jsonobj= JSON.parse(this.responseText);
                            console.log('FIle recieved');
                            console.log('temp='+jsonobj.temp);
                            console.log('hum='+jsonobj.hum);
                            data1.setValue(0, 1, jsonobj.smoke);
                            data2.setValue(0, 1, jsonobj.temp);
                            data3.setValue(0, 1, jsonobj.hum);
                    
                        }
                    };
                    xmlhttp.open("GET", "values.php", true);
                    xmlhttp.send();
                    
                    
                    chart1.draw(data1, options1);
                    
                    chart2.draw(data2, options2);
                    
                    chart3.draw(data3, options3);

                }, 5000);

            }
        </script>

    </body>

    </html>