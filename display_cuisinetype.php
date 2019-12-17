<?php
    //get database info
    require('connect.php');
    
    $sql = "SELECT * FROM `cuisines`";
    $result = mysqli_query($connection,$sql) or die(mysqli_error());
    $cuisine = array();
    while ($r = mysqli_fetch_assoc($result)){
        $cuisine[] = $r;
    }
    echo trim(json_encode($cuisine));
    
    mysqli_close($connection);
?>