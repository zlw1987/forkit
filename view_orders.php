<?php
//connect to database
    require('connect.php');
    
//get user id
    $id = $_POST['id'];

    //get all the orders
    $sql = "SELECT * FROM `orders` WHERE `user_id` = '$id'";
    $resultset = mysqli_query($connection, $sql) or die(mysqli_error());
    
    $results = array();
    while ($r = mysqli_fetch_assoc($resultset)){
        $results[] = $r;
    }
    
    //get all the dishes per order
    $orders = array();
    foreach ($results as $o){
        
        //get the restaurant name
        $r_id = $o[restaurant_id];
        $sql = "SELECT `name` FROM `restaurants` WHERE `restaurant_id` = '$r_id'";
        $resultset = mysqli_query($connection, $sql) or die(mysqli_error());
        while ($r = mysqli_fetch_assoc($resultset)){
            $rest[] = $r;
        }
        foreach ($rest as $r){
            $o[restaurant] = $r[name];
        }
        
        //get the dishes in the order
        $o_id = $o[order_id];
        $sql = "SELECT d.dish_name, do.dish_price, do.quantity, do.price, do.comment FROM dish_order as do, dishes as d WHERE do.dish_id = d.dish_id AND do.order_id = '$o_id'";
        $resultset = mysqli_query($connection, $sql) or die(mysqli_error());
        $dish = array();
        while ($d = mysqli_fetch_assoc($resultset)){
            $dish[] = $d;
        }
        $o[dishes] = $dish;
        
        $orders[] = $o;
        
    }
    
    echo trim(json_encode($orders));
    
    mysqli_free_result($resultset);
    mysqli_close($connection);
?>