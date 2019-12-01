<?php
    
    //get the restaurant list and decode
    $data = json_decode($_POST["restaurant"]);
    //get the sort by criteria
    $sortby = $_POST['sort'];
    
    $sort = array_column($data, $sortby);
    array_multisort($sort, SORT_ASC, $data);
    echo trim(json_encode($data));
?>