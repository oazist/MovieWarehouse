<?php
require_once('includes/config.inc.php');
require_once('includes/functions.inc.php');

session_start();

/* Get all movie from database */
$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die("Could not connect to host");
mysqli_select_db($link, DB_DATABASE) or die("Could not find database");
$query = "SELECT * FROM movie";
$result = mysqli_query($link, $query) or die("Data not found");

$uid = $_SESSION['uid'];
$queryUser = "SELECT username FROM user WHERE uid=".$uid;
$resultUser = mysqli_query($link, $queryUser);
$rowUser = mysqli_fetch_array($resultUser);
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
    <link rel="stylesheet" href="web/css/font-awesome.css">
    <script type="text/javascript" src="web/js/jquery-1.11.2.min.js"></script> 
    <script type="text/javascript" src="web/js/move-top.js"></script>
    <script type="text/javascript" src="web/js/easing.js"></script>
    <script type="text/javascript" src="web/js/jquery.nivo.slider.js"></script>
    <script type="text/javascript" src="web/js/simpleCart.js"></script>
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
                <?php
                if (isset($_SESSION['logged_in'])) {
                    if ($_SESSION['uid'] == 1) {
                        ?>
                        <div class="nav_list">
                            <ul>
                                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                            </ul>
                        </div>
                        <div class="account_desc">
                            <ul>
                                <li><a href="adminpanel.html"><i class="fa fa-user"></i> Admin Panel</a></li>
                                <li><a href="includes/logout.inc.php"><i class="fa fa-sign-out"></i> Log Out</a></li>
                            </ul>
                        </div>
                        <div class="clear"></div>

                    <?php } else {
                        ?>
                        <div class="nav_list">
                            <ul>
                                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                            </ul>
                        </div>
                        <div class="account_desc">
                            <ul>
                                <li><a href="profile.php"><i class="fa fa-user"></i> <?php echo $rowUser['username'];?></a></li>
                                <li><a href="viewcart.php"><i class="fa fa-shopping-cart"></i> Shopping Cart</a></li>
                                <li><a href="includes/logout.inc.php"><i class="fa fa-sign-out"></i> Log Out</a></li>
                            </ul>
                        </div>
                        <div class="clear"></div>
                        <?php
                    }
                } else {
                    ?>
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
                    <?php
                }
                ?>
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

                    <!--                <div class="cart">
                                        <p><span>Cart</span>
                                            <span class="simpleCart_total"></span>(<span class="simpleCart_quantity"></span> items) <br/>
                                        <div class="clear"></div>
                                    </div>-->
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
                                    <p><span class="rupees"><?php echo "Prices $" . $row['price']; ?></span></p>
                                </div>
                                <div class="add-cart">	


                                    <?php
                                    if (isset($_SESSION['logged_in'])) {
                                        if ($_SESSION['uid'] == 1) {
                                            ?>
                                            <h4><a href="adminpanel.html?mid=<?php echo $row['mid']; ?>">Edit</a></h4><br>
                                            <h5><a href="delete.php?mid=<?php echo $row['mid']; ?>">Delete</a></h5>
                                        <?php } else {
                                            ?>
                                            <h6><a href="preview.php?mid=<?php echo $row['mid']; ?>">Preview</a></h6>
                                            <?php
                                        }
                                    } 
                                    
                                    else {
                                        ?>
                                            <h6><a href="preview.php?mid=<?php echo $row['mid']; ?>">Preview</a></h6>
                                        <?php
                                    }
                                    ?>
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
            </div>
        </div>
    </div>
    
    <div class='footer'>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $().UItoTop({easingType: 'easeOutQuart'});

        });
    </script>
    <a href="#" id="toTop"><span id="toTopHover"> </span></a>
</body>
</html>


