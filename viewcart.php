<?php
require_once('includes/config.inc.php');

$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die("Could not connect to host");
mysqli_select_db($link, DB_DATABASE) or die("Could not find database");

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
    <script type="text/javascript" src="web/js/simpleCart.js"></script>
    <script type="text/javascript" src="web/js/jquery.redirect.js"></script>
    <link href="web/css/table.css" rel="stylesheet" type="text/css" media="all"/>
    <script type="text/javascript">
        simpleCart({
            // array representing the format and columns of the cart,
            // see the cart columns documentation
            cartColumns: [
                {attr: "name", label: "Product"},
                {view: "currency", attr: "price", label: "Price"},
                {view: "decrement", label: "Decrease"},
                {attr: "quantity", label: "Quantity"},
                {view: "increment", label: "Increase"},
                {view: "currency", attr: "total", label: "SubTotal"},
                {view: "remove", text: "Remove", label: false}
            ],
            // "div" or "table" - builds the cart as a 
            // table or collection of divs
            cartStyle: "table",
            // how simpleCart should checkout, see the 
            // checkout reference for more info 
            checkout: {
                type: "PayPal",
                email: "you@yours.com"
            },
            // set the currency, see the currency 
            // reference for more info
            currency: "USD",
            // collection of arbitrary data you may want to store 
            // with the cart, such as customer info
        });
    </script>
    
    <script>
        function extractData() {
            /*The purpose of this function is to collect required data from viewcard.php and send it to checkout.php*/
            //gets table
            var mTable = document.getElementById('reciept');

            //gets rows of table
            var rowLength = mTable.rows.length
            var tableArray = [];

            //loops through rows    
            for (i = 0; i < rowLength; i++) {
                //gets cells of current row  
                var mCells = mTable.rows.item(i).cells;
                //gets amount of cells of current row
                var cellLength = mCells.length;
                
                var objAdd = {};
                if(i==0){
                    objAdd.Product = 'Product';
                    objAdd.Price = 'Price';
                    objAdd.Quantity = 'Quantity';
                    objAdd.TotalSum = 'Total';
                    tableArray.push(objAdd);
                }else{
                    objAdd.Product = mCells.item(0).innerHTML;
                    objAdd.Price = mCells.item(1).innerHTML;
                    objAdd.Quantity = mCells.item(3).innerHTML;
                    objAdd.TotalSum = mCells.item(5).innerHTML;
                    tableArray.push(objAdd);
                }
            }
            
            var sendData = JSON.stringify(tableArray);
            //document.write(sendData);
            $.redirect('checkoutpages.php', {'table': sendData});
            
        }
    </script>
</head>
<body>
    <div class="header" id="header">
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
                                <li><a href="#">Admin</a></li>
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
                                <li><a href="profile.php"><i class="fa fa-user"></i> <?php echo $_SESSION['username'];?></a></li>
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
            <div class="content">
                <div class="content_top">
                    <div class="back-links">
                        <p><a href="index.php">Home</a> &gt;&gt; <a href="#" class="active">Contact</a></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="section group" id="section-group">
                    <div class="simpleCart_items" id="cartItem">
                    </div>
                    <div style="clear:left"></div>            
                    SubTotal: <span class="simpleCart_total" id="subtotal"></span> <br />
<!--                    <span id="couponcode"></span><br />
                    Final Total: <span class="simpleCart_finalTotal"></span><br />-->
                </div>
            </div>
            <a href="javascript:;" onclick="extractData()">checkout</a><br/>
            
        </div>
    </div>
    <div class="footer">
       
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $().UItoTop({easingType: 'easeOutQuart'});

        });
    </script>
    <a href="#" id="toTop"><span id="toTopHover"> </span></a>
</body>
</html>

