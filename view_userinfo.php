<?php
    //database info
    require('connect.php');
    
    $user = $_GET['user_id'];
    //$user = 3;
    
    //get the user info
    $sql = "SELECT * FROM `users` WHERE `ID` = '$user'";
    $result = mysqli_query($connection, $sql) or die(mysqli_error());
    $user_info = array();
    while ($r = mysqli_fetch_assoc($result)){
        $user_info[] = $r;
    }
    
    //get the user address
    $sql = "SELECT type_id AS type, `street`, `street2`, `zipcode` FROM `user_address` WHERE `user_id` = '$user'";
    $result = mysqli_query($connection, $sql) or die(mysqli_error());
    $address = array();
    while ($r = mysqli_fetch_assoc($result)){
        $address[] = $r;
    }
    
    //echo trim(json_encode($address));

    
    //get the city and state
    $add = array();
    foreach ($address as $a){
        $sql = "SELECT `city`, `state` FROM `zipcodes` WHERE `zipcode` = '$a[zipcode]'";
        $result = mysqli_query($connection, $sql) or die(mysqli_error());
        $cs = array();
        while ($r = mysqli_fetch_assoc($result)){
            $cs[] = $r;
        }
        //echo trim(json_encode($cs));
        $a[city] = $cs[0][city];
        $a[state] = $cs[0][state];
        //echo trim(json_encode($a));
        $add[] = $a;
    }
    
    //echo trim(json_encode($add));    
    
    
    //get the address type
    $addresses = array();
    foreach ($add as $a){
        $sql = "SELECT `type_name` FROM `address_type` WHERE `type_id` = '$a[type]'";
        $result = mysqli_query($connection, $sql) or die(mysqli_error());
        $type = array();
        while ($r = mysqli_fetch_assoc($result)){
            $type[] = $r;
        }
        $a[type] = $type[0][type_name];
        $addresses[] = $a;
    }
    
    $user_info[0][address] = $addresses;
    
    echo trim(json_encode($user_info));

    mysqli_close($connection);

?>