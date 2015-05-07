<?php
require_once('includes/config.inc.php');

session_start();
$mid = $_GET['mid'];

$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die("Could not connect to host");
mysqli_select_db($link, DB_DATABASE) or die("Could not find database");

/* Fetch Movie From Database */
$queryMovie = "SELECT * FROM movie WHERE mid='" . $mid . "'";
$resultMovie = mysqli_query($link, $queryMovie) or die("Movie not found");
$rowMovie = mysqli_fetch_array($resultMovie);

/* Fetch catagory that related to the movie */
$queryCat = "SELECT catalogue_name FROM catalogue WHERE cid=" . $rowMovie['cid'];
$resultCat = mysqli_query($link, $queryCat) or die("Catagory not found");
$rowCat = mysqli_fetch_array($resultCat);

/* Fetch other movies */
$queryOther = "SELECT * FROM movie WHERE mid!='" . $mid . "' && cid=" . $rowMovie['cid'] . " LIMIT 5";
$resultOther = mysqli_query($link, $queryOther);
?>
<head>
    <title>Movie Warehouse</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="web/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link rel="stylesheet" href="web/css/font-awesome.css">
    <script type="text/javascript" src="web/js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="web/js/auth.js"></script>
    <script type="text/javascript" src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>

    <script type="text/javascript" src="web/js/move-top.js"></script>
    <script type="text/javascript" src="web/js/easing.js"></script>
    <script type="text/javascript" src="web/js/simpleCart.js"></script>
    <script>
        function ClientAPIHandler(videoId, videoTitle) {
            document.getElementById("videoHeader").innerHTML = videoTitle;
            document.getElementById("youtube").src = "http://www.youtube.com/embed/" + videoId + "?autoplay=1";
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
                                <li><a href="profile.php"><i class="fa fa-user"></i> <?php echo $_SESSION['username']; ?></a></li>
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
                    <a href="javascript:;" onclick="revertStock()" class="simpleCart_empty" ><FONT COLOR='#a8a8a8' SIZE='4'>Empty Cart</FONT></a> 
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
                <script>
                    function compareStock(input){
                        var stock = document.getElementById('stock').innerHTML;
                        if(input > stock){
                            document.getElementById('warning').style.visibility = "visible";
                            document.getElementById('button').style.visibility = "hidden";
                        }else{
                            document.getElementById('warning').style.visibility = "hidden";
                            document.getElementById('button').style.visibility = "visible";
                        }
                    }
                </script>
                
                <script>
                    function reduceStock(){
                        var stock = document.getElementById('stock').innerHTML;
                        stock--;
                        document.getElementById('stock').innerHTML = stock;
                    }
                    
                    function revertStock(){
                        var defaultStock = document.getElementById('stocklist').value;
                        document.getElementById('stock').innerHTML = defaultStock;
                    }
                </script>

                <div class="clear"></div>
            </div>     				
        </div>
    </div>
    <div class="main">
<!--        <button id="login-link">login</button>-->
        <div class="wrap">
            <div class="content_top">
                <div class="back-links">
                    <p><a href="index.php">Home</a> &gt;&gt; <a href="#" class="active">Preview</a></p>
                </div>
                <div class="clear"></div>
            </div>
            <div class="section group">
                <div class="cont-desc span_1_of_2">
                    <div class="simpleCart_shelfItem">
                        <div class="product-details">				
                            <div class="grid images_3_of_2">
                                <img src="<?php echo $rowMovie['coverpic']; ?>" alt="" />
                            </div>
                            <div class="desc span_3_of_2">
                                <FONT COLOR='white' SIZE='6'><h2 class="item_name" id="title"><?php echo $rowMovie['title']; ?></h2></FONT>
                                <p></p>					
                                <div class="price">
                                    <FONT COLOR='white' SIZE='5'>Price: <span class="item_price">$<?php echo $rowMovie['price']; ?></span></FONT>
                                </div>
                                <div class="available">
                                    <ul>
                                        <li><FONT COLOR='white' SIZE='3'>Movie ID :</FONT> &nbsp; <?php echo $rowMovie['mid']; ?></li>
                                        <li><FONT COLOR='white' SIZE='3'>Category :</FONT>&nbsp; <?php echo $rowCat['catalogue_name'] ?></li>
                                        <li id="stocklist" value="<?php echo $rowMovie['stock'];?>"><FONT COLOR='white' SIZE='3'>Units in Stock :</FONT>&nbsp; <span id="stock" style="color:#707070;"><?php echo $rowMovie['stock']; ?></span></li>
                                    </ul>
                                </div>
                                <div class="share-desc">
<!--                                    <div class="share">
                                       <FONT COLOR='white' SIZE='3'>Number of units : </FONT><input class="item_quantity" id="unit" class="text_box" type="number" min="0" onchange="compareStock(this.value)">
                                    </div>-->
    <!--                                <div class="button"><span><a href="javascript:;" onclick="simpleCart.add('name=<?php echo $rowMovie['title']; ?>',
                                                    'price=<?php echo $rowMovie['price']; ?>',
                                                    'quantity='+document.getElementById('unit').value)">Add to Cart</a></span></div>					-->
                                    <div class="button" id="button"><span><a href="javascript:;" onclick="reduceStock()" class="item_add">Add to Cart</a></span></div>
                                    <br/>
                                    <p style="color:red;visibility: hidden;" id="warning">The input is exceeding current stock</p>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="product_desc">	
                        <FONT COLOR='white' SIZE='5'>Plot Summary :</FONT>
                        <p align="justify"><?php echo $rowMovie['plot']; ?></p>
                    </div>
                </div>

                <div class="rightsidebar span_3_of_1 sidebar">
                    <h2>Related Movies</h2>
                    <?php
                    while ($rowOther = mysqli_fetch_array($resultOther)) {
                        ?>
                        <div class="special_movies">
                            <div class="movie_poster">
                                <a href="preview.php?mid=<?php echo $rowOther['mid']; ?>"><img src="<?php echo $rowOther['picture']; ?>" alt="" /></a>
                            </div>
                            <div class="movie_desc">
                                <h3><a href="preview.php?mid=<?php echo $rowOther['mid']; ?>"><?php echo $rowOther['title']; ?></a></h3><br>
                                <FONT COLOR='white' SIZE='3'>&nbsp;$<?php echo $rowOther['price']; ?></FONT>
                                <div class="add-cart">
                                <h6><a href="preview.php?mid=<?php echo $rowOther['mid']; ?>">Preview</a></h6>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <div class="cont-desc span_1_of_2">
                    <div id="container">
                        <FONT COLOR='#FC7D01' SIZE='5'><h1 id="videoHeader"></h1></FONT><br>
                        <iframe width ="720" height="480" id="youtube">
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
