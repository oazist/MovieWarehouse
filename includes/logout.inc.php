<?php
// Start session 
session_start();
// Include required functions file 
require_once('functions.inc.php');
// If not logged in, redirect to login screen 
// If logged in, unset session variable and display logged-out message 

if (check_login_status() == false) {
    // Redirect to 
    redirect('../login.php');
} else {
    // Kill session variables 
    unset($_SESSION['logged_in']);
    unset($_SESSION['username']);
    unset($_SESSION['uid']);
    // Destroy session 
    session_destroy();
}
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-

    strict.dtd"> 

<html xml:lang="en" lang="en"> 

    <head> 

        <!--        <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                            <meta name="description" content="">
                                <meta name="author" content="">-->

        <title>Sign Out</title>

        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" type="text/css" href="../web/css/bootstrap.css"/>
        <!-- Custom Fonts -->
        <link rel="stylesheet" type="text/css" href="../web/css/font-awesome.css"/>

    </head> 

    <body> 

        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <img src="../web/images/logo.png" width="100%" />

                        </div>
                        <div class="panel-body">
                            <h2>Logged Out</h2> 
                            <p>You have successfully logged out. Back to <a href="../login.php">login</a> screen.</p> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="../web/js/jquery-1.11.2.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../web/js/bootstrap.js"></script>


    </body> 

</html>