<?php
//connect to database
    require_once('connect.php');

//get variable from swift 
    $username = $_POST[''];
    $pass = $_POST[''];
    $phone = $_POST[''];
    $email = $_POST[''];
    $Dname = $_POST[''];
    $Fname = $_POST[''];
    $Lname = $_POST[''];
    
//chenk if username, phone, email is unique
    $sql = "SELECT * FROM `vendors` WHERE `vendor_login` = '$username'";
    mysqli_query($connection,$sql);
    $user_count = mysqli_affected_rows($connection);
    $sql = "SELECT * FROM `vendors` WHERE `email` = '$email'";
    mysqli_query($connection,$sql);
    $email_count = mysqli_affected_rows($connection); 
    $sql = "SELECT * FROM `vendors` WHERE `phone` = '$phone'";
    mysqli_query($connection,$sql);
    $phone_count = mysqli_affected_rows($connection);  

    
    if ($user_count == 1){
        echo "This username is already taken.";
    }
    elseif ($email_count == 1){
        echo "This Email address has been used.";
    }
    elseif ($phone_count == 1){
        echo "This phone number has been used";
    }
    elseif ($user_count == 0 && $email_count == 0 && $phone_count == 0){
        $sql = "INSERT INTO `vendors` (`vendor_login`, `vendor_pass`, `email`, `phone`, `fname`, `lname`, `display_name`) VALUES ('$username', '$pass', '$email', '$phone', '$Fname', '$Lname', '$Dname')";
        mysqli_query($connection,$sql) or die(mysqli_error());
        echo "Registration Succeed!";
        echo $sql;
    }
    else{
        echo "Sorry. Something went wrong, please try again.";
    }

    mysqli_close($connection);
?>