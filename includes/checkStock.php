<?php

$obj = json_decode($_GET['obj']);
require_once('config.inc.php');
require_once('functions.inc.php');
session_start();
$obj_length = count($obj);
if (!isset($_SESSION['logged_in'])) {
    redirect("../login.php");
} else {
    /* Get user information using uid stored in $_SESSION */
    $link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die("Could not connect to host");
    mysqli_select_db($link, DB_DATABASE) or die("Could not find database");
    
    $itemExceed = array();
    
    for($i=0;$i<$obj_length;$i++){
        $product = $obj[$i]->Product;
        $query = "SELECT stock FROM movie WHERE title='".$product."'";
        $result = mysqli_query($link, $query) or die("Can't find stock");
        $row = mysqli_fetch_array($result);
        
        /*Compare input with stock*/
        $buyQuantity = intval($obj[$i]->Quantity);
        $curStock = intval($row['stock']);
        
        if($curStock < $buyQuantity){
            $result_arr['title'] = $product;
            $result_arr['stock'] = $curStock;
            $result_arr['order'] = $buyQuantity;
            array_push($itemExceed, $result_arr);
        }
    }

    if(count($itemExceed) > 0){
        echo json_encode($itemExceed);
    }else{
        echo "success";
    }
}

?>