<?php
    //connect to database
    require('connect.php');

    //get variable from swift 
    $resp_json = $_GET['geo']; //post the result directly from google geocode api
    //$radius = $_GET['radius']; //radius should be miles
    $radius = 50;
    
    // decode the json
    $resp = json_decode($resp_json, true);
    // get the important data
    $latitude = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
    $longitude = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
    
    if ($lati && $longi){
            //get all the restaurant info
        $query = "SELECT * FROM `restaurants` WHERE `status` = 1";
        $resultset = mysqli_query($connection, $query) or die(mysqli_error());
        $records = array();
        while($r = mysqli_fetch_assoc($resultset)){
            //uses the Haversine Formula to calculate the distance between two coordinates
            $dlon = $longitude - $r[longitude];
            $dlat = $latitude - $r[latitude];
            $a = (sin($dlat/2)) ** 2 + cos($longitude) * cos($r[longitude]) * (sin($dlon/2)) ** 2;
            $c = 2 * atan2(sqrt($a),sqrt(1-$a));
            $distance = $c * 3958.8;
            //record the restaurants within the radius
            if ($distance <= $radius){
                $r[distance] = $distance;
                $records[] = $r;
            }
        }
        
        //sort the restaurant by distance
        $sort = array_column($data, 'distance');
        array_multisort($sort, SORT_ASC, $records);
        echo trim(json_encode($records));
        
        mysqli_free_result($resultset);
    } 
    else{
        echo "Sorry, something went wrong. Please try again.";
    }
    
    mysqli_close($connection);

?>