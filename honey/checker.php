<?php
function generateRandomString($length = 6) {
    srand(time(0));
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
session_start();
    require_once("connect.php");
    if(empty($_POST) or !isset($_POST['username']) or !isset($_POST['password'])) die("Oops something went wrong. Please try signing up or logging in again");
    $user=mysql_escape_string(trim($_POST['username']));
    $pass=mysql_escape_string(trim($_POST['password']));
    
    $sql="SELECT * FROM `users` WHERE `username` = '{$user}'";
    $result1=$conn->query($sql);
    if ($result1->num_rows == 0) {header("Location:../login.php?invalid=1");die();}
    $user_details=$result1->fetch_assoc();
    session_start();
    $_SESSION=array();
    if($user_details['status']=='0'){
        $_SESSION['username']=$user;
        $_SESSION['status']='0';
        header("Location:../otp.php");
        die();
    }
    $sql="SELECT * FROM `passfile` WHERE `username` = '{$user}' and `password` = '".md5($pass,TRUE)."' ;";
    $result2=$conn->query($sql);
    if ($result2->num_rows == 0) {header("Location:../login.php?invalid=1");die();}
    $pass_details=$result2->fetch_assoc();
    if($pass_details['index']!=$user_details['key']){
        $sql="UPDATE `sensordata`.`users` SET `status` = '0' WHERE `users`.`username` = {$user};";
        $conn->query($sql);
        $_SESSION['username']=$user;
        $_SESSION['status']='0';
        header("Location:../otp.php");
        die();
    }else{
        $_SESSION['username']=$user;
        $_SESSION['status']=$user_details['status'];
        $_SESSION['OTP']=generateRandomString();
        //email/sms OTP code here
        //$msg = "Your OTP is ".$_SESSION['OTP'];
        //mail($user_details['email'],"Home Automation OTP",$msg);
         header("Location:../otp.php");
        die();
    }
?>