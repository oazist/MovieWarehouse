<?php
// Start session 
session_start();
// Include required functions file 
require_once('functions.inc.php');
// If not logged in, redirect to login screen 
// If logged in, unset session variable and display logged-out message 

if (check_login_status() == false) {
    // Redirect to 
    redirect('login.php');
} else {
    // Kill session variables 
    unset($_SESSION['logged_in']);
    unset($_SESSION['username']);
    // Destroy session 
    session_destroy();
}
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-

    strict.dtd"> 

<html xml:lang="en" lang="en"> 

    <head> 

        <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                    <meta name="description" content="">
                        <meta name="author" content="">

                            <title>SB Admin 2 - Bootstrap Admin Theme</title>

                            <!-- Bootstrap Core CSS -->
                            <link href="../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

                                <!-- MetisMenu CSS -->
                                <link href="../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

                                    <!-- Custom CSS -->
                                    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

                                        <!-- Custom Fonts -->
                                        <link href="../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

                                            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
                                            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
                                            <!--[if lt IE 9]>
                                                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                                                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
                                            <![endif]-->

                                            </head> 

                                            <body> 

                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-md-4 col-md-offset-4">
                                                            <div class="login-panel panel panel-default">
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
                                                <script src="../../bower_components/jquery/dist/jquery.min.js"></script>

                                                <!-- Bootstrap Core JavaScript -->
                                                <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

                                                <!-- Metis Menu Plugin JavaScript -->
                                                <script src="../../bower_components/metisMenu/dist/metisMenu.min.js"></script>

                                                <!-- Custom Theme JavaScript -->
                                                <script src="../../dist/js/sb-admin-2.js"></script>


                                            </body> 

                                            </html>