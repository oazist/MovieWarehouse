<?php
require_once('includes/config.inc.php');

/* Get all movie from database */
$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die("Could not connect to host");
mysqli_select_db($link, DB_DATABASE) or die("Could not find database");
$query = "SELECT * FROM movie";
$result = mysqli_query($link, $query) or die("Data not found");
?>
<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<!DOCTYPE HTML>
<head>
    <title>Movie Warehouse</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="web/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="web/css/slider.css" rel="stylesheet" type="text/css" media="all"/>
    <script type="text/javascript" src="web/js/jquery-1.9.0.min.js"></script> 
    <script type="text/javascript" src="web/js/move-top.js"></script>
    <script type="text/javascript" src="web/js/easing.js"></script>
    <script type="text/javascript" src="web/js/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
        $(window).load(function () {
            $('#slider').nivoSlider();
        });
    </script>
    <script>
        function getMovieCatalogue(val) {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("movie-panel").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "includes/selectCatalogue.php?cat=" + val, true);
            xmlhttp.send();
        }
    </script>
</head>
<body>
    <div class="header">
        <div class="headertop_desc">
            <div class="wrap">
                <div class="nav_list">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                    </ul>
                </div>
                <div class="account_desc">
                    <ul>
                        <li><a href="contact.html">Register</a></li>
                        <li><a href="contact.html">Login</a></li>
                        <li><a href="#">Checkout</a></li>
                        <li><a href="#">My Account</a></li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="wrap">
            <div class="header_top">
                <div class="logo">
                    <a href="index.html"><img src="web/images/logo.png" alt="" /></a>
                </div>
                <div class="header_top_right">
                    <div class="cart">
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
            <div class="header_bottom">
                <div class="header_bottom_left">				
                    <div class="categories">
                        <ul>
                            <h3>Categories</h3>
                            <li><a href="index.php">All</a></li>
                            <li><a onclick="getMovieCatalogue(1)">Action</a></li>
                            <li><a onclick="getMovieCatalogue(2)">Drama</a></li>
                            <li><a onclick="getMovieCatalogue(3)">Animation</a></li>
                        </ul>
                    </div>					
                </div>

                <div class="header_bottom_right">					 
                    <!------ Slider ------------>
                    <div class="slider">
                        <div class="slider-wrapper theme-default">
                            <div id="slider" class="nivoSlider">
                                <img src="web/images/1.jpg" data-thumb="web/images/1.jpg" alt="" />
                                <img src="web/images/2.jpg" data-thumb="web/images/2.jpg" alt="" />
                                <img src="web/images/3.jpg" data-thumb="web/images/3.jpg" alt="" />
                                <img src="web/images/4.jpg" data-thumb="web/images/4.jpg" alt="" />
                                <img src="web/images/5.jpg" data-thumb="web/images/5.jpg" alt="" />
                            </div>
                        </div>
                    </div>
                    <!------End Slider ------------>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <!------------End Header ------------>
    <div class="main">
        <div class="wrap">
            <div id="movie-panel" class="content">
                <div class="content_top">
                    <div class="heading">
                        <h3>All Movies</h3>
                    </div>
                </div>
                <div class="section group">
                    <?php
                    $count = 0;
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <div class="grid_1_of_5 images_1_of_5" <?php if ($count % 5 == 0) { ?> style="margin-left: 0px" <?php } ?>>
                            <a href="preview.php?mid=<?php echo $row['mid']; ?>"><img src="<?php echo $row['picture']; ?>" alt="" /></a>
                            <h2><a href="preview.php?mid=<?php echo $row['mid']; ?>"><?php echo $row['title']; ?></a></h2>
                            <div class="price-details">
                                <div class="price-number">
                                    <p><span class="rupees"><?php echo "$" . $row['price']; ?></span></p>
                                </div>
                                <div class="add-cart">								
                                    <h4><a href="preview.php?mid=<?php echo $row['mid']; ?>">Preview</a></h4>
                                </div>
                                <div class="clear"></div>
                            </div>					 
                        </div>
                        <?php
                        $count++;
                    }
                    
                    mysqli_close($link);
                    ?>
                </div>
                <!--                <div class="content_bottom">
                                    <div class="heading">
                                        <h3>Feature Products</h3>
                                    </div>
                                </div>
                                <div class="section group">
                                    <div class="grid_1_of_5 images_1_of_5">
                                        <a href="preview.html"><img src="web/images/cover_pic/beauty_and_the_beast.jpg" alt="" /></a>
                                        <h2><a href="preview.html">Beauty and the beast</a></h2>
                                        <div class="price-details">
                                            <div class="price-number">
                                                <p><span class="rupees">$620.87</span></p>
                                            </div>
                                            <div class="add-cart">								
                                                <h4><a href="preview.html">Add to Cart</a></h4>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                
                                    </div>
                                    <div class="grid_1_of_5 images_1_of_5">
                                        <a href="preview.html"><img src="web/images/cover_pic/Eclipse.jpg" alt="" /></a>
                                        <h2><a href="preview.html">Eclipse</a></h2>
                                        <div class="price-details">
                                            <div class="price-number">
                                                <p><span class="rupees">$620.87</span></p>
                                            </div>
                                            <div class="add-cart">								
                                                <h4><a href="preview.html">Add to Cart</a></h4>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                
                                    </div>
                                    <div class="grid_1_of_5 images_1_of_5">
                                        <a href="preview.html"><img src="web/images/cover_pic/Coraline.jpg" alt="" /></a>
                                        <h2><a href="preview.html">Coraline</a></h2>
                                        <div class="price-details">
                                            <div class="price-number">
                                                <p><span class="rupees">$899.75</span></p>
                                            </div>
                                            <div class="add-cart">								
                                                <h4><a href="preview.html">Add to Cart</a></h4>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                
                                    </div>
                                    <div class="grid_1_of_5 images_1_of_5">
                                        <a href="preview.html"><img src="web/images/cover_pic/Unstoppable.jpg" alt="" /></a>
                                        <h2><a href="preview.html">Unstoppable</a></h2>
                                        <div class="price-details">
                                            <div class="price-number">
                                                <p><span class="rupees">$599.00</span></p>
                                            </div>
                                            <div class="add-cart">								
                                                <h4><a href="preview.html">Add to Cart</a></h4>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                    <div class="grid_1_of_5 images_1_of_5">
                                        <a href="preview.html"><img src="web/images/cover_pic/Priest.jpg" alt="" /></a>
                                        <h2><a href="preview.html">Priest 3D</a></h2>
                                        <div class="price-details">
                                            <div class="price-number">
                                                <p><span class="rupees">$679.87</span></p>
                                            </div>
                                            <div class="add-cart">								
                                                <h4><a href="preview.html">Add to Cart</a></h4>
                                            </div>
                                            <div class="clear"></div>
                                        </div>				     
                                    </div>
                                </div>-->
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
                        <li><a href="index.html">View Cart</a></li>
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


