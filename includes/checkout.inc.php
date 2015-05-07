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
    
    /*get the credit card detail*/
    $uid = $_SESSION['uid'];
    $queryCredit = "SELECT creditcard FROM user WHERE uid=".$uid;
    $resultCredit = mysqli_query($link, $queryCredit);
    $row = mysqli_fetch_array($resultCredit);
    
    /*gathering all required data*/
    $credit = $row['creditcard'];
    
    $subtotal = $_POST['subtotal'];
    
    $subtotal = substr($subtotal, 1);
    
    $uid = $_SESSION['uid'];
    $date = date_create()->format('Y-m-d H:i:s');
    
    //Create Transaction
    $create_transaction = "INSERT INTO transaction (`uid`, `amount`, `date`, `creditcard`) "."VALUES (".$uid.",'".$subtotal."','".$date."','".$credit."'".");";
    mysqli_query($link, $create_transaction) or die("Can't add transaction");
    
    //Get newly created transaction ID
    $getTID = "SELECT tid FROM transaction WHERE date='".$date."'";
    $resultTID = mysqli_query($link, $getTID) or die("Can't find transaction ID");
    $rowTID = mysqli_fetch_array($resultTID);
    $tid = $rowTID['tid'];
    
    //Create Purchasing History
    for($i=0;$i<$obj_length;$i++){
        $title = $obj[$i]->Product;
        $amount = $obj[$i]->Quantity;
        
        //Get Movie ID
        $getMID = "SELECT mid FROM movie WHERE title='".$title."'";
        $resultMID = mysqli_query($link, $getMID) or die("Can't find movie ID");
        $rowMID = mysqli_fetch_array($resultMID);
        $mid = $rowMID['mid'];
        
        $create_history = "INSERT INTO history (`tid`, `uid`, `mid`, `title`, `amount`)"."VALUES (".$tid.",".$uid.",'".$mid."','".$title."','".$amount."');";
        mysqli_query($link,$create_history) or die("Can't create history");
        
    }
    
    mysqli_close($link);
    redirect("../profile.php");
}
?>

