<?php
require_once('includes/config.inc.php');

$mid = $_GET['mid'];

$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die("Could not connect to host");
mysqli_select_db($link, DB_DATABASE) or die("Could not find database");

/*Fetch Movie From Database*/
$queryMovie = "SELECT * FROM movie WHERE mid='" . $mid . "'";
$resultMovie = mysqli_query($link, $queryMovie) or die("Movie not found");
$rowMovie = mysqli_fetch_array($resultMovie);

/*Fetch catagory that related to the movie*/
$queryCat = "SELECT catalogue_name FROM catalogue WHERE cid=".$rowMovie['cid'];
$resultCat = mysqli_query($link, $queryCat) or die("Catagory not found");
$rowCat = mysqli_fetch_array($resultCat);

/*Fetch other movies*/
$queryOther = "SELECT * FROM movie WHERE mid!='" . $mid . "' && cid=".$rowMovie['cid']." LIMIT 5";
$resultOther = mysqli_query($link, $queryOther);

?>
<head>
    <title>Movie Warehouse</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="web/css/style.css" rel="stylesheet" type="text/css" media="all"/>
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
                    <a href="index.php"><img src="web/images/logo.png" alt="" /></a>
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
        </div>
    </div>
    <div class="main">
        <div class="wrap">
            <div class="content_top">
                <div class="back-links">
                    <p><a href="index.html">Home</a> &gt;&gt; <a href="#" class="active">English</a></p>
                </div>
                <div class="clear"></div>
            </div>
            <div class="section group">
                <div class="cont-desc span_1_of_2">
                    
                    <div class="product-details">				
                        <div class="grid images_3_of_2">
                            <img src="<?php echo $rowMovie['coverpic'];?>" alt="" />
                        </div>
                        <div class="desc span_3_of_2">
                            <h2><?php echo $rowMovie['title']; ?></h2>
                            <p></p>					
                            <div class="price">
                                <p>Price: <span>$<?php echo $rowMovie['price']; ?></span></p>
                            </div>
                            <div class="available">
                                <ul>
                                    <li><span>Movie ID:</span> &nbsp; <?php echo $rowMovie['mid']; ?></li>
                                    <li><span>Category:</span>&nbsp; <?php echo $rowCat['catalogue_name'] ?></li>
                                    <li><span>Units in Stock:</span>&nbsp; <?php echo $rowMovie['stock']; ?></li>
                                </ul>
                            </div>
                            <div class="share-desc">
                                <div class="share">
                                    <p>Number of units :</p><input id="unit" class="text_box" type="text">				
                                </div>
                                <div class="button"><span><a href="#">Add to Cart</a></span></div>					
                                <div class="clear"></div>
                            </div>
<!--                            <div class="wish-list">
                                <ul>
                                    <li class="wish"><a href="#">Add to Wishlist</a></li>
                                    <li class="compare"><a href="#">Add to Compare</a></li>
                                </ul>
                            </div>-->
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="product_desc">	
                        <h2>Plot Summary :</h2>
                        <p align="justify"><?php echo $rowMovie['plot']; ?></p>
                    </div>
                </div>
                
                <div class="rightsidebar span_3_of_1 sidebar">
                    <h2>Related Movies</h2>
                    <?php 
                    while($rowOther = mysqli_fetch_array($resultOther)){
                    ?>
                    <div class="special_movies">
                        <div class="movie_poster">
                            <a href="preview.php?mid=<?php echo $rowOther['mid']; ?>"><img src="<?php echo $rowOther['picture']; ?>" alt="" /></a>
                        </div>
                        <div class="movie_desc">
                            <h3><a href="preview.php?mid=<?php echo $rowOther['mid']; ?>"><?php echo $rowOther['title']; ?></a></h3>
                            <p>&nbsp; $<?php echo $rowOther['price']; ?></p>
                            <span><a href="preview.php?mid=<?php echo $rowOther['mid']; ?>">Preview</a></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php
                    }
                    ?>
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