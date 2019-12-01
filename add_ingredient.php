<?php
    //connect to database
    require('connect.php');

//get variable from swift 
   // $name = $_POST['']; 
  
    $name = 'fish'; 
    
    //Check if the dish is upload already
    $sql = "SELECT * FROM `ingredients` WHERE `ingredient` = '$name'";
    mysqli_query($connection,$sql) or die(mysqli_error());
    $n = mysqli_affected_rows($connection);

    switch ($n){
        case 1:
            echo "The ingredient exists!";
            break;
        case 0:
            $sql = "INSERT INTO `ingredients`(`ingredient`) VALUES ('$name')";
            mysqli_query($connection, $sql) or die(mysqli_error());
            echo 'Ingredient added!';
            break;
        default:
            echo "Sorry, something went wrong. Please try again.";
    }
    
    mysqli_close($connection);

?>