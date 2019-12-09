<?php
//connect to database
    require_once('connect.php');

//get variable from swift 
    $username = $_POST['username'];
    $pass = $_GET['pass'];
    $phone = $_GET['phone'];
    $email = $_GET['email'];
    $Dname = $_GET['Dname'];
    $Fname = $_GET['Fname'];
    $Lname = $_GET['Lname'];
    
/*$username ='test1';
    $pass = 'test1';
    $phone = '8183858175';
    $email = 'test1@test.com';
    $Dname = 'testdisplay';
    $Fname = 'testfirst';
    $Lname = 'testlast';    */
    
//chenk if username, phone, email is unique
    $sql = "SELECT * FROM `users` WHERE `user_login` = '$username'";
    mysqli_query($connection,$sql);
    $user_count = mysqli_affected_rows($connection);
    $sql = "SELECT * FROM `users` WHERE `user_email` = '$email'";
    mysqli_query($connection,$sql);
    $email_count = mysqli_affected_rows($connection); 
    $sql = "SELECT * FROM `users` WHERE `phone` = '$phone'";
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
        $sql = "INSERT INTO `users` (`user_login`, `user_pass`, `user_email`, `phone`, `fname`, `lname`, `display_name`) VALUES ('$username', '$pass', '$email', '$phone', '$Fname', '$Lname', '$Dname')";
        mysqli_query($connection,$sql) or die(mysqli_error());
        echo "Registration Succeed!";
        echo $sql;
    }
    else{
        echo "Sorry. Something went wrong, please try again.";
    }

    mysqli_close($connection);
?>