<?php

require_once('config.inc.php');
require_once('functions.inc.php');

/* Get all movie from database */
$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die("Could not connect to host");
mysqli_select_db($link, DB_DATABASE) or die("Could not find database");
$query = "SELECT * FROM movie";
$result = mysqli_query($link, $query) or die("Data not found");
$respond = array();
while($row = mysqli_fetch_array($result)){
    $row_array['mid'] = $row['mid'];
    $row_array['title'] = $row['title'];
    $queryCat = "SELECT * FROM catalogue WHERE cid=".$row['cid'];
    $resultCat = mysqli_query($link, $queryCat) or die("Data not found");
    $rowCat = mysqli_fetch_array($resultCat);
    $row_array['category'] = $rowCat['catalogue_name'];
    $row_array['stock'] = $row['stock'];
    $row_array['price'] = $row['price'];
//    $row_array['picture'] = $row['picture'];
//    $row_array['coverpic'] = $row['coverpic'];
    array_push($respond, $row_array);
}

echo json_encode($respond);
?>

