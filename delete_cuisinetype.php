<?php
    //database info
    require('connect.php');
    
    //get restaurant_cuisine id
    $id = $_GET['c_r_id'];
    
    $sql = "DELETE FROM `restaurant_cuisine` WHERE `id` = $id";
    mysqli_query($connection,$sql) or die(mysqli_error());
    echo "Record deleted successrully!";
    
    mysqli_close($connection);
?>