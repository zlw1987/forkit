<?php
    //get database info
    require('connect.php');
    
    $bh = json_decode($_GET["$b_hour"]);
    
    foreach ($bh as $r){
        $sql = "UPDATE `business_hour` SET `day` = '$r[day]', `start_time` = '$r[start_time]',`end_time` = '$r[end_time]' WHERE `id` = '$r[id]'";
        mysqli_query($connection,$sql) or die(mysqli_error());
    }
    
    echo "Your records has been updated";

    mysqli_close($connection);
?>