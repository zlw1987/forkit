<?php
//connect to database
    require('connect.php');

//get variable from swift 
    $username = $_GET['username'];
    $pass = $_GET['pass'];
    //$username = 'test6';
    //$pass = 'test6';
    
    // echo 'user:'.$username.'pass:'.$pass;
    $sql = "SELECT * FROM `users` WHERE `user_login` = '$username' AND `user_pass` = '$pass'";
    
    $resultset = mysqli_query($connection, $sql);
    $records = array();
    while($r = mysqli_fetch_assoc($resultset)){
        $records[] = $r;
         }
         
    $n = count($records);
    if ($n == 0){
        echo "Wrong username/password combination";
    }
    elseif ($n == 1){
       // echo "Login succesful!";
        echo trim(json_encode($records));
    }
    else {
        echo "Sorry. Something went wrong. Please try again.";
    }

    mysqli_close($connection);
?>