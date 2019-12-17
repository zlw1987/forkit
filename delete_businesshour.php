<?php
    //database info
    require('connect.php');
    //get business hour id
    $id = $_GET['bh_id'];
    //$id = 11;
    
    $sql = "DELETE FROM `business_hour` WHERE `id` = '$id'";
    mysqli_query($connection,$sql) or die(mysqli_error());
    echo "Record deleted successrully!";

    mysqli_close($connection);
?>