<?php

//update restaurant status including open, close

    //database info
    require('connect.php');
    
    //get restaurant id and status
    $id = $_GET['r_id'];
    $status = $_GET['status'];
    
    $sql = "UPDATE `restaurants` SET `status` = '$status' WHERE `restaurant_id` = '$id'";
    mysqli_query($connection, $sql) or die(mysqli_error());
    
    mysqli_close($connection);
?>