<?php

require_once('connect.php');

   /* $restaurant = array();
    
    $query = "SELECT * FROM `restaurants`";
    $result = mysqli_query($connection, $query) or die(mysqli_error());
    $rest = array();
    while ($r = mysqli_fetch_assoc($result)){
        $rest[] = $r;
    }
    foreach ($rest as $a){
        $id = $a[vendor_id];
        $sql = "SELECT * FROM `vendors` WHERE `ID` = '$id'";
        $result = mysqli_query($connection, $sql) or die(mysqli_error());
        $re = array();
        while ($r = mysqli_fetch_assoc($result)){
            $re[] = $result;
        }
        $a[user] = $re;
        $restaurant[] = $a;
        
    }
    
    echo trim(json_encode($restaurant));
    

    
    //get restaurant info add address and tax rate based on zipcode
    $restaurant = 1;
    $sql = "SELECT r.restaurant_id, r.vendor_id, r.name , r.phone , r.description , r.street , r.street2 , z.city , z.state, r.zipcode , t.tax_rate FROM restaurants AS r, zipcodes AS z, tax AS t WHERE r.restaurant_id = $restaurant AND z.zipcode = r.zipcode AND t.zipcode = r.zipcode";
    $result = mysqli_query($connection, $sql) or die(mysqli_error());
    $rest_info = array();
    while ($r = mysqli_fetch_assoc($result)){
        $rest_info[] = $r;
    }
    
    //get the restaurant dishes list
    $sql = "SELECT `dish_id`,`dish_name`,`price`,`discription` FROM `dishes` WHERE `restaurant_id` = '$restaurant'";
    $result = mysqli_query($connection, $sql);
    $dishes = array();
    while ($r = mysqli_fetch_assoc($result)){
        $dishes[] = $r;
    }
    
    
    echo trim(json_encode($rest_info));
    echo trim(json_encode($dishes)); 
        
        
         $query = "SELECT `type_id` FROM `address_type`";
         
         $resultset = mysqli_query($connection, $query);
         
         $records = array();
         $a = 5;
         
         while($r = mysqli_fetch_assoc($resultset)){
             echo "Name: ".$r[type_id]."<br>";
             $r[distance] = $a;
             $a= $a - 1;
             $records[] = $r;
             $b = $r[type_id];
             $ids = join(",",$r[type_id]);
            echo "<br>".$r[type_id];
         }
        foreach ($records as $aaa){
            $b[]= $aaa[type_id];
        }
        echo join(',',$b);
        $aa = 'distance';
        $dis = array_column($records, $aa);
        echo trim(json_encode($dis));
        array_multisort($dis, SORT_ASC, $records);
        
         echo trim(json_encode($records));
         
         
         
    
        foreach ($records as $aaa) {
             if ($aaa[type_name] == 'Customer address'){
                $sdfa = $aaa[type_id];
             }
        
        }
        echo "<br> ID is: ". $sdfa;
        
        
        mysqli_free_result($resultset)
         
        $sql = "SELECT * FROM users WHERE user_login = 'test1'";
        $result = mysqli_query($connection,$sql) or die(mysqli_error());
        echo $result;
        $num = mysqli_num_rows($result);
        echo "<br>" ."asdas: ";
        echo $num; */
 /*       
    $username = 'Jack';
    $pass = 'jackcheng';
    $phone = '9186558134';
    $email = 'jack@test.com';
    $Dname = 'Jack';
    $Fname = 'Jack';
    $Lname = 'Cheng';
    
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
    
    
    if ($user_count == 0 && $email_count == 0 && $phone_count == 0){
        $sql = "INSERT INTO `users` (`user_login`, `user_pass`, `user_email`, `phone`, `fname`, `lname`, `display_name`) VALUES ('$username', '$pass', '$email', '$phone', '$Fname', '$Lname', '$Dname')";
        mysqli_query($connection,$sql) or die(mysqli_error());
        echo "Registration Succeed!";
        echo $sql;
        $last_id = mysqli_insert_id($connection);
    echo "New record created successfully. Last inserted ID is: " . $last_id;
    }
    else{
        echo "Sorry. Something went wrong, please try again.";
    }

         if ($stmt = mysqli_prepare($connection, $sql)){
             if(mysqli_stmt_execute($stmt)){
                 $a = mysqli_stmt_num_rows($stmt);
                 echo $a;
             }
         }
    
        
         



//get variable from swift 
    $username = 'test192';
    $pass = 'test10';
    
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
        echo "Login succesful!";
        echo trim(json_encode($records));
    }
    else {
        echo "Sorry. Something went wrong. Please try again.";
    }
   

// add address for user 此 case 不过 
    $user = '7'; //会传给我user id还是login id？
    $type = '2';
    $street2 ='102 Lincoln Blvd';
    $street2 = ' ';
    $zipcode = '90010';
    $city =  'Los Angeles';
    $state = 'CA';
     //会传给我user id还是login id？
    

//Check if the zipcode matches city and state
    $sql = "SELECT * FROM `zipcodes` WHERE `zipcode` = '$zipcode'";
    $resultset = mysqli_query($connection, $sql) or die(mysqli_error());
    
    $r = mysqli_fetch_assoc($resultset);
    if ($r[city] == $city){
        if ($r[state] == $state){
            $query = "INSERT INTO `user_address` (`type_id`, `street`, `street2`,`zipcode`, `user_id`) VALUES ('$type', '$street', '$street2,'$zipcode', '$user')";
            mysqli_query($connection,$query) or die(mysqli_error());
            echo "Address added!";
        }
        else{
            echo "The state you entered does not match zipcode!";
        }
        
    }
    else{
        echo "The city you entered does not match zipcode!";
    }
    mysqli_free_result($resultset);
  
 
// add address for vendor
  $user = '6'; //会传给我user id还是login id？
    $type = '2';
    $street2 ='110Lincoln Blvd';
    $street2 = ' ';
    $zipcode = '90010';
    $city =  'Los Angeles';
    $state = 'CA';
    


//Check if the zipcode matches city and state
    $sql = "SELECT * FROM `zipcodes` WHERE `zipcode` = '$zipcode'";
    $resultset = mysqli_query($connection, $sql) or die(mysqli_error());
    
    $r = mysqli_fetch_assoc($resultset);
    if ($r[city] == $city){
        if ($r[state] == $state){
            $query = "INSERT INTO `vendor_address` (`type_id`, `street`,`street2`, `zipcode`, `vendor_id`) VALUES ('$type', '$street', '$street2', '$zipcode', '$user')";
            mysqli_query($connection,$query) or die(mysqli_error());
            echo "Address added!";
        }
        else{
            echo "The state you entered does not match zipcode!";
        }
        
    }
    else{
        echo "The city you entered does not match zipcode!";
    }
    mysqli_free_result($resultset);

   
   //add restuarant 

    $vendor = '2'; //会传给我vendor id还是login id?
    $name = 'Easterly Santa Clara';
    $phone = '2839192930';
    $description = 'Chinese Cusine';
    $street = '102 Linkin Blvd';
    $street2 = '201';
    $zipcode = '94503';
    $latitude = '41.71727401';
    $longitude = '-75.00898606';
    

    $sql = "INSERT INTO `restaurants` (`vendor`,`name`,`phone`,`description`, `street`, `street2`,`zipcode`, `latitude`,`longitude`) VALUES ('$vendor', '$name', '$phone','$description','$street','$street2,'$zipcode', '$latitude','$longitude')";
    mysqli_query($connection, $sql) or die(mysqli_error());

//return restaurant info  
    $last_id = mysqli_insert_id($connection);
    $query = "SELECT * FROM `restaurants` WHERE `restaurant_id` == '$last_id'";
    $resultset = mysqli_query($connection, $query) or die(mysqli_error());
//process data to joson readable format
    $records = array();
    while($r = mysqli_fetch_assoc($resultset)){
        $records[] = $r;
    }
    echo trim(json_encode($records));
    echo "Restaurant added!";
    
    mysqli_free_result($resultset);
    */
    $name = 'Prown Cracker'; 
    $price = '18.9';
    $description = 'Prwons with spicy seasoning';
    $r_id = '1';
    

    //Check if the dish is upload already
    $sql = "SELECT * FROM `dishes` WHERE `dish_name` = '$name'";
    mysqli_query($connection,$sql) or die(mysqli_error());
    $n = mysqli_affected_rows($connection);
    
    if ($n == 1){
        echo "You have added the dish already!";
    }
    //create dish
    elseif ($n == 0){
        $sql = "INSERT INTO `dishes` (`dish_name`,`price`,`description`,`restaurant_id`) VALUES ('$name','$price','$description','$r_id')";
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
    }
    else {
        echo "Sorry. Something went wrong. Please try again.";
    }
    
      
         
    mysqli_close($connection)

?>