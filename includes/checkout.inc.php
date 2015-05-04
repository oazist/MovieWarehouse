<?php

/* 
 * Instruction
 * 1. decode object from $_POST using json_decode
 * 2. get product name of each object then query the database to get the amount of stock
 * 3. stock update will be current stock - purchasing quantity
 * 4. update the database
 * 5. redirect to my account page when finished
 */

$obj = json_decode($_POST['updateObject']);
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

    for($i=0;$i<$obj_length;$i++){
        $product = $obj[$i]->Product;
        $query = "SELECT stock FROM movie WHERE title='".$product."'";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result);
        
        /*Update stock*/
        $buyQuantity = intval($obj[$i]->Quantity);
        $curStock = intval($row['stock']);
        $updateStock = $curStock - $buyQuantity;
        
        $queryUpdate = "UPDATE movie SET stock=".$updateStock." WHERE title='".$product."'";
        mysqli_query($link, $queryUpdate);
    }

    
    redirect("../index.php");
}
?>

