<?php
    //database info
    require('connect.php');
    
    $restaurant = $_GET['store_id'];
    //$restaurant =1;
    
    
    //get restaurant info add address and tax rate based on zipcode
    $sql = "SELECT r.restaurant_id, r.vendor_id, r.name , r.phone , r.description , r.street , r.street2 , z.city , z.state, r.zipcode , t.tax_rate FROM restaurants AS r, zipcodes AS z, tax AS t WHERE r.restaurant_id = '$restaurant' AND z.zipcode = r.zipcode AND t.zipcode = r.zipcode";
    $result = mysqli_query($connection, $sql) or die(mysqli_error());
    $rest_info = array();
    while ($r = mysqli_fetch_assoc($result)){
        $rest_info[] = $r;
    }
    
    //get the restaurant dishes list
    $sql = "SELECT `dish_id`,`dish_name`,`price`,`discription` FROM `dishes` WHERE `restaurant_id` = '$restaurant'";
    $result = mysqli_query($connection, $sql);
    $dishes = array();
    while ($r = mysqli_fetch_assoc($result)){
        $dishes[] = $r;
    }
    $dish = array();
    foreach ($dishes as $d){
        $sql = "SELECT `pic_url` FROM `dish_pics` WHERE `dish_id` = '$d[dish_id]'";
        $result = mysqli_query($connection,$sql);
        $url = array();
        while ($u = mysqli_fetch_assoc($result)){
            $url[] = $u;
        }
        $d[pic] = $url;
        $dish[] = $d;
    }
    $rest_info[0][dish] = $dish;
    
    //get the business hour
    $sql = "SELECT `day`,`start_time`,`end_time` FROM `business_hour` WHERE `restaurant_id` = '$restaurant'";
    $result = mysqli_query($connection, $sql);
    $bhour = array();
    while ($r = mysqli_fetch_assoc($result)){
        $bhour[] = $r;
    }
    $rest_info[0][business_hour] = $bhour;

    
    
    echo trim(json_encode($rest_info));

    
    mysqli_close($connection);
?>