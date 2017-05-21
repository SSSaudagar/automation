<?php 
session_start();
    if(empty($_SESSION) or !isset($_SESSION['username']) or !isset($_SESSION['status']) or !isset($_SESSION['LoggedIn'])) die("Oops something went wrong. Please try signing up or logging in again");
    if(!($_SESSION['status']>='1' and $_SESSION['LoggedIn']==TRUE and isset($_SESSION['OTP']))) die("Unauthorised Access Detected");
    require_once('connect.php');
    
    if(!isset($_GET['led']) and !isset($_GET['value'])) die();
    
    $led=$_GET['led'];
    $value=$_GET['value'];
    //echo "UPDATE `sensordata`.`led` SET `value` = {$value} WHERE `led`.`id` = {$led};";
    $conn->query("UPDATE `sensordata`.`led` SET `value` = {$value} WHERE `led`.`id` = {$led};");
?>