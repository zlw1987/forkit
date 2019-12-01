<?php
    //connect to database
    require('connect.php');

/*get variable from swift 
    $name = $_POST['']; 
    $price = $_POST[''];
    $description = $_POST[''];
    $r_id = $_POST[''];
    */
    
    $name = 'beef'; 
    $price = 13.89;
    $description = 'beef with broccoli, less salt. chief special';
    $r_id = 2;

    //Check if the dish is upload already
    $sql = "SELECT * FROM `dishes` WHERE `dish_name` = '$name' AND `restaurant_id`=$r_id";
    mysqli_query($connection,$sql) or die(mysqli_error());
    $n = mysqli_affected_rows($connection);

    switch ($n){
        case 1:
            echo "You have added the dish already!";
            break;
        case 0:
            $sql = "INSERT INTO `dishes`(`dish_name`, `price`, `discription`, `restaurant_id`) VALUES ('$name','$price','$description','$r_id')";
            mysqli_query($connection, $sql) or die(mysqli_error());
            // get the dish id
            $last_id = mysqli_insert_id($connection) or die(mysqli_error());
        
            //upload dish pic
            $target_dir = "pic/" . strval($r_id) . "/";
            if(!file_exists($target_dir)){
                mkdir($target_dir);
            }
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, picture already exists.";
                $uploadOk = 0;
            }
            else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    //insert url info to the database
                    $url = "https://joinwebdesign.com/forkit/" . $target_dir;
                    $sql = "INSERT INTO `dish_pics` (`dish_id`,`pic_url`) VALUES ('$last_id','$url')";
                    mysqli_query($connection, $sql) or die(mysqli_error());
                    echo "The picture ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your picture.";
                }
            }
            break;
        default:
            echo "Sorry, something went wrong. Please try again.";
    }
    
    mysqli_close($connection);

?>