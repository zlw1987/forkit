<?php
    //database info
    require('connect.php');
    
    $restaurant = $_GET['store_id'];
    //$restaurant =1;
    
    
    //get restaurant info add address and tax rate based on zipcode
    $sql = "SELECT r.status AS 'status id', rs.name AS 'status', r.restaurant_id, r.vendor_id, r.name , r.phone , r.description , r.street , r.street2 , z.city , z.state, r.zipcode , t.tax_rate FROM restaurants AS r, zipcodes AS z, tax AS t, restaurant_status AS rs WHERE r.restaurant_id = '$restaurant' AND z.zipcode = r.zipcode AND t.zipcode = r.zipcode AND r.status = rs.id";
    $result = mysqli_query($connection, $sql) or die(mysqli_error());
    $rest_info = array();
    while ($r = mysqli_fetch_assoc($result)){
        $rest_info[] = $r;
    }
    
    //get the restaurant dishes list
    $sql = "SELECT `dish_id`,`dish_name`,`price`,`discription` FROM `dishes` WHERE `restaurant_id` = '$restaurant'";
    $result = mysqli_query($connection, $sql) or die(mysqli_error());
    $dishes = array();
    while ($r = mysqli_fetch_assoc($result)){
        $dishes[] = $r;
    }
    $dish = array();
    foreach ($dishes as $d){
        $sql = "SELECT `id`,`pic_url` FROM `dish_pics` WHERE `dish_id` = '$d[dish_id]'";
        $result = mysqli_query($connection,$sql) or die(mysqli_error());
        $url = array();
        while ($u = mysqli_fetch_assoc($result)){
            $url[] = $u;
        }
        $d[pic] = $url;
        $dish[] = $d;
    }
    $rest_info[0][dish] = $dish;
    
    //get the cuisine type
    $sql = "SELECT `id`,`cuisine_id` FROM `restaurant_cuisine` WHERE `restaurant_id` = '$restaurant'";
    $result = mysqli_query($connection, $sql) or die(mysqli_error());
    $cuisine_id = array();
    while ($r = mysqli_fetch_assoc($result)){
        $cuisine_id[] = $r;
    }
    //echo trim(json_encode($cuisine_id));
    $cuisine = array();
    foreach($cuisine_id as $c){
        $sql = "SELECT `cuisine_type` FROM `cuisines` WHERE `cuisine_id` = '$c[cuisine_id]'";
        $result = mysqli_query($connection,$sql) or die(mysqli_error());
        while ($type = mysqli_fetch_assoc($result)){
            $c[cuisine_type] = $type[cuisine_type];
        }
        //echo trim(json_encode($c));
        $cuisine[] = $c;
    }
    $rest_info[0][cuisine] = $cuisine;
    
    //get the business hour
    $sql = "SELECT `id`,`day`,`start_time`,`end_time` FROM `business_hour` WHERE `restaurant_id` = '$restaurant'";
    $result = mysqli_query($connection, $sql) or die(mysqli_error());
    $businesshour = array();
    while ($r = mysqli_fetch_assoc($result)){
        $businesshour[] = $r;
    }
    //process the business hour
    $bhour = array();
    $hour = array();
    $format="%H:%M";
    foreach($businesshour as $bd){
        $hour[id] = $bd[id];
        $hour[start_time] = date('g:i A', strtotime($bd[start_time]));
        $hour[end_time] = date('g:i A', strtotime($bd[end_time]));
        switch ($bd[day]){
            case 'M':
                $bhour[Monday][] = $hour;
                break;
            case 'T':
                $bhour[Tuesday][] = $hour;
                break;
            case 'W':
                $bhour[Wednesday][] = $hour;
                break;
            case 'R':
                $bhour[Thursday][] = $hour;
                break;
            case 'F':
                $bhour[Friday][] = $hour;
                break;
            case 'S':
                $bhour[Saturday][] = $hour;
                break;
            case 'U':
                $bhour[Sunday][] = $hour;
                break;
        }
    }
    //echo trim(json_encode($bhour));
    $rest_info[0][business_hour] = $bhour;

    
    
    echo trim(json_encode($rest_info));

    
    mysqli_close($connection);
?>