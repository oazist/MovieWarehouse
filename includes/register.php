<?php

	//include
	require_once('includes/config.inc.php');

    
        $current = $_POST['userName'];
        $current2 = $_POST['userId'];
        $current3 = $_POST['userPass'];
        $current4 = $_POST['userEmail'];
        $current5 = $_POST['userCredit'];
	
	//connect Database
	$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die("Could not connect to host");
	mysqli_select_db($link, DB_DATABASE) or die("Could not find database");
	
	$sql = "INSERT INTO `user` (`name`, `username`, `password`, `email`, `creditcard`, `accountType`) "
               ."VALUES ( '".$current."','".$current2."','".$current3."','".$current4."','".$current5."', '1');";
        
        $result = mysqli_query($link,$sql)or die("Data not found");
        mysqli_close($link);
                
        //header("location:login.php");
	
?>