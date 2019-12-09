<?php
//connect to database
    require('connect.php');

/*get variable from swift 
    $user = $_GET['user']; //传给我user id
    $type = $_GET['type'];
    $street = $_GET['street'];
    $street2 = $_GET['street2'];
    $zipcode = $_GET['zipcode'];
    $city =  $_GET['city'];
    $state = $_GET['state'];
    */

//Check if the zipcode matches city and state
    $sql = "SELECT * FROM `zipcodes` WHERE `zipcode` = '$zipcode'";
    $resultset = mysqli_query($connection, $sql) or die(mysqli_error());
    
    $r = mysqli_fetch_assoc($resultset);
    if ($r[city] == $city){
        if ($r[state] == $state){
            $query = "INSERT INTO `vendor_address` (`type_id`, `street`,`street2`, `zipcode`, `vendor_id`) VALUES ('$type', '$street', '$street2', '$zipcode', '$user')";
            mysqli_query($connection,$query) or die(mysqli_error());
            echo "Address added!";
        }
        else{
            echo "The state you entered does not match zipcode!";
        }
        
    }
    else{
        echo "The city you entered does not match zipcode!";
    }
    mysqli_free_result($resultset);
    
    
    mysqli_close($connection);

?>