<?php
    
    //get the restaurant list and decode
    $data = json_decode($_GET["restaurant"]);
    //get the sort by criteria
    $sortby = $_GET['sort'];
    
    $sort = array_column($data, $sortby);
    array_multisort($sort, SORT_ASC, $data);
    echo trim(json_encode($data));
?>