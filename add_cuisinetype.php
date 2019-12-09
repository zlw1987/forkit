<?php
    //connect to database
    require('connect.php');

//get variable from swift 
   // $r_id = $_GET['rid']; 
   // $cuisine_id = $_GET['cid'];
  
    $r_id = '3';
    $cuisine_id = '4'; 
    
    //Check if the dish is upload already
    $sql = "SELECT * FROM `restaurant_cuisine` WHERE `restaurant_id` = '$r_id' and `cuisine_id` = '$cuisine_id'";
    mysqli_query($connection,$sql) or die(mysqli_error());
    $n = mysqli_affected_rows($connection);

    switch ($n){
        case 1:
            echo "The cuisine type exists for this restaurant!";
            break;
        case 0:
            $sql = "INSERT INTO `restaurant_cuisine`(`restaurant_id`, `cuisine_id`) VALUES ('$r_id', '$cuisine_id')";
            mysqli_query($connection, $sql) or die(mysqli_error());
            echo 'Cuisine Type added!';
            break;
        default:
            echo "Sorry, something went wrong. Please try again.";
    }
    
    mysqli_close($connection);

?>