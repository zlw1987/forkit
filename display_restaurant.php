<?php
    //database info
    require('connect.php');
    
    //get all restaurants info
    $query = "SELECT * FROM `restaurants`";
    $resultset = mysqli_query($connection, $query) or die(mysqli_error());
    $records = array();
    while ($r = mysqli_fetch_assoc($resultset)){
        $records[] = $r;
    }
    
    $restaurant = array();
    //get the dishes info per restaurant
    foreach ($records as $r){
        $query = "SELECT `dish_id`,`dish_name`,`price`,`discription` FROM `dishes` WHERE `restaurant_id` = '$r[restaurant_id]'";
        $resultset = mysqli_query($connection, $query) or die(mysqli_error());
        $result = array();
        while ($d = mysqli_fetch_assoc($resultset)){
            $result[] = $d;
        }
        //get pictures for each dish
        $dishes = array();
        foreach ($result as $d){
            $sql = "SELECT `pic_url` FROM `dish_pics` WHERE `dish_id` = '$d[dish_id]'";
            $dp_result = mysqli_query($connection, $sql) or die(mysqli_error());
            $dp = array();
            while ($ddp = mysqli_fetch_assoc($dp_result)){
                $dp[] = $ddp;
            }
            $d[pic] = $dp;
            $dishes[] = $d;
        }
        
        $r[dishes] = $dishes;
        $restaurant[] = $r;
    }
    
    echo trim(json_encode($restaurant));
    
    mysqli_free_result($result);
    mysqli_free_result($resultset);
    mysqli_free_result($dp_result);
    mysqli_close($connection);
?>