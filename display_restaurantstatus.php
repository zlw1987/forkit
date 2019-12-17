<?php
    //get database info
    require('connect.php');
    
    $sql = "SELECT * FROM `restaurant_status`";
    $result = mysqli_query($connection,$sql) or die(mysqli_error());
    $status = array();
    while ($r = mysqli_fetch_assoc($result)){
        $status[] = $r;
    }
    echo trim(json_encode($status));
    
    mysqli_close($connection);
?>