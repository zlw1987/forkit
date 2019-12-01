<?php
//connect to database
    require('connect.php');

    //get all the ingredients
    $sql = "SELECT * FROM `ingredients`";
    $resultset = mysqli_query($connection, $sql) or die(mysqli_error());
    
    $results = array();
    while ($r = mysqli_fetch_assoc($resultset)){
        $results[] = $r;
    }   
    
    echo trim(json_encode($results));

    mysqli_free_result($resultset);
    mysqli_close($connection);
?>