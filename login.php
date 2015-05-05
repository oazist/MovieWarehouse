<?php
require_once('includes/config.inc.php');
require_once('includes/functions.inc.php');

session_start();

if (isset($_SESSION['logged_in'])) {
    redirect("index.php");
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
    <script type="text/javascript" src="web/js/jquery-1.9.0.min.js"></script> 
    <script type="text/javascript" src="web/js/move-top.js"></script>
    <script type="text/javascript" src="web/js/easing.js"></script>
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
                        <li><a href="register.html"><i class="fa fa-plus"></i> Register</a></li>
                        <li><a href="login.php"><i class="fa fa-sign-in"></i> Login</a></li>
                        <li><a href="viewcart.php"><i class="fa fa-shopping-cart"></i> Shopping Cart</a></li>
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
                    <!--                    <div class="cart">
                                            <p><span>Cart</span><div id="dd" class="wrapper-dropdown-2"> (empty)
                                                <ul class="dropdown">
                                                    <li>you have no items in your Shopping cart</li>
                                                </ul></div></p>
                                        </div>
                                        <div class="search_box">
                                            <form>
                                                <input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {
                                                                                                this.value = 'Search';
                                                                                            }"><input type="submit" value="">
                                            </form>
                                        </div>
                                        <div class="clear"></div>-->
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
            <div class="content">
                <div class="content_top">
                    <div class="back-links">
                        <p><a href="index.php">Home</a> &gt;&gt; <a href="#" class="active">Log In</a></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="section group">
                    <div class="col span_2_of_3">
                        <div class="contact-form">
                            <h2>Login</h2>
                            <form method="post" action="includes/login.inc.php">
                                <div>
                                    <span><label>ID</label></span>
                                    <span><input  placeholder="Username" name="username" type="text" class="textbox"  autofocus ></span>
                                </div>
                                <div>
                                    <span><label>PASSWORD</label></span>
                                    <span><input  placeholder="Password" name="password" type="password" class="textbox"></span>
                                </div>

                                <div>
                                    <span><input type="submit" name="login" id="login" value="Log in"  class="mybutton"></span>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>		
            </div> 
        </div>
    </div>

    <div class="footer">
        <div class="wrap">	
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
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $().UItoTop({easingType: 'easeOutQuart'});

        });
    </script>
    <a href="#" id="toTop"><span id="toTopHover"> </span></a>
</body>
</html>