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

$json=array('temp'=>$temp,'hum'=>$hum,'smoke'=>$smoke);
$jsonstring = json_encode($json);
 echo $jsonstring;
?>