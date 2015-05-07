<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('config.inc.php');
require_once('functions.inc.php');

$tid = $_GET['tid'];
$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die("Could not connect to host");
mysqli_select_db($link, DB_DATABASE) or die("Could not find database");
$query = "SELECT * FROM history WHERE tid=".$tid;
$result = mysqli_query($link, $query) or die("Can't find Transaction ID");
$respond = array();
while($row = mysqli_fetch_array($result)){
    $result_arr['mid'] = $row['mid'];
    $result_arr['title'] = $row['title'];
    $result_arr['amount'] = $row['amount'];
    array_push($respond,$result_arr);
}
echo json_encode($respond);
?>