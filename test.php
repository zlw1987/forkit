<?php

require_once('connect.php');

  /*
    
// display_restautant  不运行
    $restaurant = $_POST['100'];
    
    
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
    
    
    echo trim(json_encode($rest_info));
    echo trim(json_encode($dishes));
  
    
// sort by criteria运行结果null 没看懂怎么该条件
    //get the restaurant list and decode
    $data = json_decode($_POST["restaurant"]);
    //get the sort by criteria
    $sortby = $_POST['sort'];
    
    $sort = array_column($data, $sortby);
    array_multisort($sort, SORT_ASC, $data);
    echo trim(json_encode($data));

       
       
    //get the restaurant list and decode
    $data = json_decode($_POST["1"]);
    //get the filter criteria
    $filter = $_POST['filter'];
    
    //find the cuisine id
    $sql = "SELECT * FROM `cuisines` WHERE `cuisine_type` = '$filter'";
    $resultset = mysqli_query($connection, $sql);
    while($r = mysqli_fetch_assoc($resultset)){
        $id = $r[cuisine_id];
    }
    
    //get all the restaurant id from the restaurant list
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
    */
    
    
    //get the restaurant list and decode
    $data = json_decode($_POST["1"]);
    //get the filter criteria
    $filter = $_POST['Chinese'];
    
    //find the cuisine id
    $sql = "SELECT * FROM `cuisines` WHERE `cuisine_type` = '$filter'";
    $resultset = mysqli_query($connection, $sql);
    while($r = mysqli_fetch_assoc($resultset)){
        $id = $r['1'];
    }
    
    //get all the restaurant id from the restaurant list
    foreach ($data as $a){
            $b[]= $a[restaurant_id];
        }
    $r_ids = join(',',$b);
    
    //get the filted restaurant id
    $sql = "SELECT 	`restaurant_id` FROM `restaurant_cuisine` WHERE `cuisine_id` = '$id' and `restaurant_id` IN '$r_ids'";
    $resultset = mysqli_query($connection, $sql);
    $r_ids = array();
    while($r = mysqli_fetch_assoc($resultset)){
        $r_ids[] = $r;
    }
    
    mysqli_free_result($resultset);

    foreach($data as $check){
        foreach($r_ids as $id){
            if ($check[restaurant_id] == $id[restaurant_id]){
                $filtered[] = $check;
            }    
        }
        
    }
    
    if (count($filtered) > 0){
        echo trim(json_encode($filtered));
    }
    else {
        echo "No match found!";
    }
    
  
    
   
    
    mysqli_close($connection)

?>