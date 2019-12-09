<?php
    //connect to database
    require('connect.php');

/*get variable from swift 
    $ingredient = $_GET['ingredient']; 
    $dish = $_GET['dish'];
    */
    
    $ingredient = 12; 
    $dish = 1;


    //Check if the ingredient exists already
    $sql = "SELECT * FROM dish_ingredient WHERE dish_id = '$dish' AND ingredient_id = '$ingredient'";
    mysqli_query($connection,$sql) or die(mysqli_error());
    $n = mysqli_affected_rows($connection);

    switch ($n){
        case 1:
            echo "You have added the ingredient already!";
            break;
        case 0:
            $sql = "INSERT INTO `dish_ingredient`(`dish_id`, `ingredient_id`) VALUES ('$dish','$ingredient')";
            mysqli_query($connection, $sql) or die(mysqli_error());
            // get the dish id
            $last_id = mysqli_insert_id($connection) or die(mysqli_error());
            echo 'You have add the ingredient to the dish!';
            break;
        default:
            echo "Sorry, something went wrong. Please try again.";
    }
    
    mysqli_close($connection);

?>