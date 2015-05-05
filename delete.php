<?php
	require_once('includes/config.inc.php');

	$md = $_GET['mid'];
	
	//connect Database
	$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die("Could not connect to host");
	mysqli_select_db($link, DB_DATABASE) or die("Could not find database");

        $sql = "DELETE FROM `moviestore`.`movie` WHERE `movie`.`mid` = '".$md."'";
	
	$result = mysqli_query($link, $sql) or die("Data not found");

	header("location:index.php");
?>

