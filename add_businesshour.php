<?php
//connect to database
    require('connect.php');

//get variable from swift 
    $b_hour = json_decode($_POST["businesshour"]);//format should be 'day'(single vachart as 'M'),'s_time'(4 digit int as 1100), 'e_time'(4 digit int as 1700)
    $r_id = $_POST['r_id'];
    
//data validation
    $bool = 0;
    foreach ($b_hour as $a){
        //check if there is any over lapping
        foreach($b_hour as $b){
            if ($a[day] ==$b[day]){
                if ($a[s_time] <= $b[e_time] and $a[e_time] >= $b[s_time]){
                    $bool = 1;
                    echo "Same day hours cannot overlapp!";
                    echo trim(json_encode($a));
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