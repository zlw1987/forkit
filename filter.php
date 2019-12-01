<?php
    //connect to database
    require('connect.php');
    
    //get the restaurant list and decode
    $data = json_decode($_POST["restaurant"]);
    //get the filter criteria
    $filter = $_POST['filter'];
    
    //find the cuisine id
    $sql = "SELECT * FROM `cuisines` WHERE `cuisine_type` = '$filter'";
    $resultset = mysqli_query($connection, $sql);
    while($r = mysqli_fetch_assoc($resultset)){
        $id = $r[cuisine_id];
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