<?php
//connect to database
    require('connect.php');

//get variable from swift 
//M = Monday. T = Tuesday. W = Wednesday. R = Thursday. F = Friday. S = Saturday. U = Sunday.
    $b_hour = json_decode($_GET["businesshour"]);//format should be 'day'(single vachart as 'M'),'s_time'(4 digit int as 1100), 'e_time'(4 digit int as 1700)
    $r_id = $_GET['r_id'];
    
//data validation
    $bool = 0;
    $len = count($b_hour);
    //check if there is any overlapping
    for ($i = 0; $i < $len; $i++){
        for ($j = $i+1; $j <= $len; $j++){
            if ($b_hour[$i][day] == $b_hour[$j][day]){
                if($b_hour[$i][s_time] <= $b_hour[$j][e_time] and $b_hour[$i][e_time] >= $b_hour[$j][s_time]){
                    $bool = 1;
                    echo "Same day hours cannot overlap!";
                    echo trim(json_encode($b_hour[$i]));
                    break 2;
                } 
            }
        }
    }

//insert business hour
    if ($bool == 0){
            foreach ($b_hour as $a){
            $sql = "INSERT INTO `business_hour`(`restaurant_id`, `day`, `start_time`, `end_time`) VALUES ('$r_id', '$a[day]','$a[s_time]','$a[e_time]')";
            mysqli_query($connection, $sql) or die(mysqli_error());
        }
    }
    
    mysqli_close($connection);

?>