<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("includes/config.inc.php");

$mid = $_POST['mid'];
$title = $_POST['title'];
$cid = $_POST['category'];
$stock = $_POST['stock'];
$price = $_POST['price'];
$plot = $_POST['plot'];
$plot = str_replace("'","''",$plot);

$poster_sourcePath = $_FILES['posterfile']['tmp_name'];       // Storing source path of the file in a variable
$poster_targetPath = "web/images/poster_pic/".$_FILES['posterfile']['name']; // Target path where file is to be stored
move_uploaded_file($poster_sourcePath,$poster_targetPath);    // Moving Uploaded file

$cover_sourcePath = $_FILES['coverfile']['tmp_name'];       // Storing source path of the file in a variable
$cover_targetPath = "web/images/cover_pic/".$_FILES['coverfile']['name']; // Target path where file is to be stored
move_uploaded_file($cover_sourcePath,$cover_targetPath);    // Moving Uploaded file

$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die("Could not connect to host");
mysqli_select_db($link, DB_DATABASE) or die("Could not find database");
$query = "INSERT INTO `movie` (`mid`, `cid`, `title`, `picture`, `coverpic`, `plot`, `stock`, `price`) "
        ."VALUES ( '".$mid."','".$cid."','".$title."','".$cover_targetPath."','".$poster_targetPath."','".$plot."', '".$stock."', '".$price."');";

mysqli_query($link, $query) or die("Can't add data");

$respond = [$mid,$title, $cid, $stock, $price];

echo json_encode($respond);

?>

