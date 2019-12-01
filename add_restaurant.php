<?php
//connect to database
    require('connect.php');

/*get variable from swift 
    $vendor = $_POST['']; //传给我vendor id
    $name = $_POST[''];
    $phone = $_POST[''];
    $description = $_POST[''];
    $street = $_POST[''];
    $street2 = $_POST[''];
    $zipcode = $_POST[''];
    $latitude = $_POST[''];
    $longitude = $_POST[''];
    */
    
    
    $vendor = 2; //会传给我vendor id还是login id?
    $name = 'Taiwanese Porridge Kingdom';
    $phone = '4089359369';
    $description = 'Snug counter serve offering porridge, dumplings & other standard Chinese dishes in a mellow setting.';
    $street = '1706 N Milpitas Blvd';
    $street2 = '';
    $zipcode = '95035';
    $latitude = 37.455420;
    $longitude = -121.911020;
    
//check if the restaurant existed
    $sql = "SELECT * FROM `restaurants` WHERE `vendor_id` = '$vendor' AND `name`='$name' AND `street`='$street'";
    mysqli_query($connection,$sql) or die(mysqli_error());
    $n = mysqli_affected_rows($connection);

    switch($n){
        case 1:
            echo "The restaurant exists. Please check!";
            break;
        case 0:
            //add restaurant
            $sql = "INSERT INTO `restaurants`(`vendor_id`, `name`, `phone`, `description`, `latitude`, `longitude`, `street`, `street2`, `zipcode`) VALUES ('$vendor','$name','$phone','$description','$latitude','$longitude','$street','$street2','$zipcode')";
            mysqli_query($connection, $sql) or die(mysqli_error());
    

            //return restaurant info  
            $last_id = mysqli_insert_id($connection);
            $query = "SELECT * FROM `restaurants` WHERE `restaurant_id` = '$last_id'";
            $resultset = mysqli_query($connection, $query) or die(mysqli_error());
            //process data to joson readable format
            $records = array();
            while($r = mysqli_fetch_assoc($resultset)){
                $records[] = $r;
            }
            echo trim(json_encode($records));
            echo "Restaurant added!";
            mysqli_free_result($resultset);
            break;
        default:
            echo "Sorry, something went wrong. Please try again.";
    }


    
    mysqli_close($connection);

?>