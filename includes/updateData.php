<?php

require_once('config.inc.php');
require_once('functions.inc.php');

/* Update selected movie to database */
$column = $_POST['name'];
$mid = $_POST['pk'];
$val = $_POST['value'];

$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die("Could not connect to host");
mysqli_select_db($link, DB_DATABASE) or die("Could not find database");
$query = "UPDATE movie SET " . $column . "='" . $val . "' WHERE mid='" . $mid . "' ";
mysqli_query($link, $query) or die("Can't update data");

