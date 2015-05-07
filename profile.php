<?php
require_once('includes/config.inc.php');
require_once('includes/functions.inc.php');

session_start();

/* Get all movie from database */
if (!isset($_SESSION['logged_in'])) {
    redirect("login.php");
} else {
    $uid = $_SESSION['uid'];
    $link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die("Could not connect to host");
    mysqli_select_db($link, DB_DATABASE) or die("Could not find database");
    $queryUser = "SELECT * FROM user WHERE uid=" . $uid;
    $resultUser = mysqli_query($link, $queryUser) or die("Data not found");
    $rowUser = mysqli_fetch_array($resultUser);
}
?>

<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<head>
    <title>Movie WareHouse</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="web/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link rel="stylesheet" href="web/css/font-awesome.css">
    <script type="text/javascript" src="web/js/jquery-1.11.2.min.js"></script> 
    <script type="text/javascript" src="web/js/move-top.js"></script>
    <script type="text/javascript" src="web/js/easing.js"></script>
    <link rel="stylesheet" href="web/css/font-awesome.css">
    <link rel="stylesheet" href="web/css/button.css">
</head>
<body>
    <div class="header">
        <div class="headertop_desc">
            <div class="wrap">
                <div class="nav_list">
                    <ul>
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                    </ul>
                </div>
                <div class="account_desc">
                    <ul>
                        <li><a href="profile.php"><i class="fa fa-user"></i> <?php echo $rowUser['username']; ?></a></li>
                        <li><a href="viewcart.php"><i class="fa fa-shopping-cart"></i> Shopping Cart</a></li>
                        <li><a href="includes/logout.inc.php"><i class="fa fa-sign-out"></i> Log Out</a></li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="wrap">
            <div class="header_top">
                <div class="logo">
                    <a href="index.php"><img src="web/images/logo.png" alt="" /></a>
                </div>
                <div class="header_top_right">
                   <FONT COLOR='white' SIZE='4'>Cart :</FONT> <FONT COLOR='white' SIZE='4'><span class="simpleCart_total"></span></FONT> <FONT COLOR='#fc6910' SIZE='4'>(<span class="simpleCart_quantity"></span> items)</FONT> <br/>
                    <a href="javascript:;" class="simpleCart_empty" ><FONT COLOR='#a8a8a8' SIZE='4'>Empty Cart</FONT></a> 
                    <a href="viewcart.php" class="viewcart"><FONT COLOR='#fc6910' SIZE='4'>Viewcart</FONT></a>
                    <div class="clear"></div>
                </div>
                <script type="text/javascript">
                    function DropDown(el) {
                        this.dd = el;
                        this.initEvents();
                    }
                    DropDown.prototype = {
                        initEvents: function () {
                            var obj = this;

                            obj.dd.on('click', function (event) {
                                $(this).toggleClass('active');
                                event.stopPropagation();
                            });
                        }
                    }

                    $(function () {

                        var dd = new DropDown($('#dd'));

                        $(document).click(function () {
                            // all dropdowns
                            $('.wrapper-dropdown-2').removeClass('active');
                        });

                    });
                </script>
                <div class="clear"></div>
            </div>     				
        </div>
    </div>
    <div class="main">
        <div class="wrap">
            <div class="section group">
                <div class="desc span_3_of_2">
                    <h2><?php echo $rowUser['name']; ?></h2>
                    <div class="col-left-profile">
                        <div class="dl-horizontal">
                            <dt class="font14">Email Address: </dt>
                            <dd class="font13"><?php echo $rowUser['email']; ?></dd>
                            <dt class="font14">Credit Card: </dt>
                            <dd class="font13"><?php echo $rowUser['creditcard']; ?></dd>
                            <dt class="font14">Account Type: </dt>
                            <?php
                            if ($rowUser['account'] == 1) {
                                ?>
                                <dd class="font13">Normal Account</dd>
                                <?php
                            } else {
                                ?>
                                <dd class="font14">VIP Account</dd>
                                <?php
                            }
                            ?>
                            <dt class="font14">External Links: </dt>
                            <dd class="font13">
                                <a href="www.facebook.com"><i class="fa fa-facebook-official fa-2x"></i>    </a>
                                <a href="www.twitter.com"><i class="fa fa-twitter-square fa-2x" style="color:lightblue">    </i></a>
                                <a href="www.plus.google.com"i class="fa fa-google-plus-square fa-2x" style="color:crimson">    </i></a>
                            </dd>
                        </div>
                    </div>

                </div>
            </div>
            <div class="panel panel-default" style="margin:10px">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Transactions Panel</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th><i class="fa fa-file-text-o"></i> Order Number</th>
                                    <th><i class="fa fa-calendar"></i> Date and Time</th>
                                    <th><i class="fa fa-credit-card"></i> Credit Card</th>
                                    <th><i class="fa fa-money"></i> Amount (USD)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //Query Transaction
                                $queryTrans = "SELECT * FROM transaction WHERE uid=" . $uid;
                                $resultTrans = mysqli_query($link, $queryTrans);
                                while ($rowTrans = mysqli_fetch_array($resultTrans)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $rowTrans['tid']; ?></td>
                                        <td><?php echo $rowTrans['date']; ?></td>
                                        <td><?php echo $rowTrans['creditcard']; ?></td>
                                        <td><?php echo $rowTrans['amount']; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right">
                        <a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="footer">
<!--        <div class="wrap">	
            <div class="section group">
                <div class="col_1_of_4 span_1_of_4">
                    <h4>Information</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Customer Service</a></li>
                        <li><a href="#">Advanced Search</a></li>
                        <li><a href="#">Orders and Returns</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col_1_of_4 span_1_of_4">
                    <h4>Why buy from us</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Customer Service</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="contact.html">Site Map</a></li>
                        <li><a href="#">Search Terms</a></li>
                    </ul>
                </div>
                <div class="col_1_of_4 span_1_of_4">
                    <h4>My account</h4>
                    <ul>
                        <li><a href="contact.html">Sign In</a></li>
                        <li><a href="index.php">View Cart</a></li>
                        <li><a href="#">My Wishlist</a></li>
                        <li><a href="#">Track My Order</a></li>
                        <li><a href="contact.html">Help</a></li>
                    </ul>
                </div>
                <div class="col_1_of_4 span_1_of_4">
                    <h4>Contact</h4>
                    <ul>
                        <li><span>+91-123-456789</span></li>
                        <li><span>+00-123-000000</span></li>
                    </ul>
                    <div class="social-icons">
                        <h4>Follow Us</h4>
                        <ul>
                            <li><a href="#" target="_blank"><img src="web/images/facebook.png" alt="" /></a></li>
                            <li><a href="#" target="_blank"><img src="web/images/twitter.png" alt="" /></a></li>
                            <li><a href="#" target="_blank"><img src="web/images/skype.png" alt="" /> </a></li>
                            <li><a href="#" target="_blank"> <img src="web/images/linkedin.png" alt="" /></a></li>
                            <div class="clear"></div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="copy_right">
                <p>Company Name © All rights Reseverd | Design by  <a href="http://w3layouts.com">W3Layouts</a> </p>
            </div>			
        </div>-->
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $().UItoTop({easingType: 'easeOutQuart'});

        });
    </script>
    <a href="#" id="toTop"><span id="toTopHover"> </span></a>
</body>
</html>
