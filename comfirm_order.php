<?php
    //database connection info
    require('connect.php');
    
    $order = $_POST['order_id'];
    $confirm = $POST['confirm'];//2 for Confirmed, 3 for Ready for pick up, 4 for Completed, 5 for Canceled, 6 for declined
    
    switch ($confirm){
        case 2: 
            $sql = "UPDATE `orders` SET `status`= '$confirm',`status_update`= CURRENT_TIMESTAMP() WHERE `order_id` = '$order'";
            mysqli_query($connection, $sql) or die(mysqli_error());
            echo 'Order '.$order. 'has been confirmed!';
        case 3: 
            $sql = "UPDATE `orders` SET `status`= '$confirm',`status_update`= CURRENT_TIMESTAMP() WHERE `order_id` = '$order'";
            mysqli_query($connection, $sql) or die(mysqli_error());
            echo 'Order '.$order. 'is ready for pickup!';
        case 4: 
            $sql = "UPDATE `orders` SET `status`= '$confirm',`status_update`= CURRENT_TIMESTAMP() WHERE `order_id` = '$order'";
            mysqli_query($connection, $sql) or die(mysqli_error());
            echo 'Order '.$order. 'now is completed!';
        case 5: 
            $sql = "UPDATE `orders` SET `status`= '$confirm',`status_update`= CURRENT_TIMESTAMP() WHERE `order_id` = '$order'";
            mysqli_query($connection, $sql) or die(mysqli_error());
            echo 'Order '.$order. 'has been cancelled!';
        case 6: 
            $sql = "UPDATE `orders` SET `status`= '$confirm',`status_update`= CURRENT_TIMESTAMP() WHERE `order_id` = '$order'";
            mysqli_query($connection, $sql) or die(mysqli_error());
            echo 'Order '.$order. 'has been declined!';
    }
    
    mysqli_close($connection);

?>