<?php 
    require_once('connect.php');
    
    if(!isset($_GET['led']) and !isset($_GET['value'])) die();
    
    $led=$_GET['led'];
    $value=$_GET['value'];
    //echo "UPDATE `sensordata`.`led` SET `value` = {$value} WHERE `led`.`id` = {$led};";
    $conn->query("UPDATE `sensordata`.`led` SET `value` = {$value} WHERE `led`.`id` = {$led};");
?>