<?php
    //database connection info
    require('connect.php');
    
    //get the order info
    $order = json_decode($_POST['order']);//dishes info(dish_id, dish_price, quantity, comment)
    $user = $_POST['user'];
    $restaurant = $_POST['r_id'];
    $pickup = $_POST['pickup'];
    $tips = $_POST['tip'];
    $comment = $_POST['comment'];
    
    //price calculation
    $sub = 0;
    foreach ($order as $dish){
        $sub = $total + $dish[dish_price] * $dish[quantity];
    }
    
    //get tax
    $sql = "SELECT `zipcode` FROM `restaurants` WHERE `restaurant_id` = '$restaurant'";
    $result = mysqli_query($connection, $sql) or die(mysqli_error());
    while ($r = mysqli_fetch_assoc($result)){
        $zipcode = $r[zipcode];
    }
    $sql = "SELECT `tax_rate` FROM `tax` WHERE `zipcode` = '$zipcode'";
    $result = mysqli_query($connection, $sql) or die(mysqli_error());
    while ($r = mysqli_fetch_assoc($result)){
        $tax_rate = $r[tax_rate];
    }
    $tax = $sub * $tax_rate;
    
    $total = $sub + $tax + $tips;
    
    //create order
    $sql = "INSERT INTO `orders` (`restaurant_id`,`user_id`,`pickup_time`,`price`,`tax`,`tips`,`final_price`,`comment`,`status`) VALUES ('$restaurant','$user','$pickup','$sub','$tax','$tips','$total','$comment',1)";
    mysqli_query($connection, $sql) or die(mysqli_error());
    
    //create order dish
    $order_id = mysqli_insert_id($connection);
    foreach ($order as $dish){
        $d_price = $dish[dish_price] * $dish[quantity];
        $sql = "INSERT INTO `dish_order` (`dish_id`,`order_id`,`quantity`,`dish_price`,`price`,`comment`) VALUES ('$dish[dish_id]','$order_id','$dish[quantity]','$dish[dish_price]','$d_price','$dish[comment]')";
        mysqli_query($connection, $sql) or dir(mysqli_error());
    }
    
    //return created order info
    $sql = "SELECT * FROM `orders` WHERE `order_id` = '$order_id'";
    $result = mysqli_query($connection, $sql) or die(mysqli_error());
    $order_info = array();
    
    while($r = mysqli_fetch_assoc($result)){
        $order_info[] = $r;
    }
    
    //return dish info in order
    $sql = "SELECT * FROM `dish_order` WHERE `order_id` = '$order_id'";
    $result = mysqli_query($connection, $sql) or die(mysqli_error());
    $dish_order = array();
    while ($r = mysqli_fetch_assoc($result)){
        $dish_order[] = $r;
    }
    mysqli_free_result($result);
    
    echo trim(json_encode($dish_order));
    echo trim(json_encode($order_info));
    
    mysqli_close($connection);
?>