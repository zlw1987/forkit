<?php
// Database credentials
 $host = 'localhost';
 $user = 'capstone';
 $password = 'capstone';
 $dbname = 'swe690capstone';
 
//connect to database 
 $connection = mysqli_connect($host,$user,$password,$dbname) or die('Connection Fail!'. mysqli_connect_error());
?>