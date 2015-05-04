<?php
//Get JSON from viewcard.php using $_POST
$obj = json_decode($_POST['table']);
require_once('includes/config.inc.php');
require_once('includes/functions.inc.php');
session_start();
if (!isset($_SESSION['logged_in'])) {
    redirect("login.php");
} else {
    /* Get user information using uid stored in $_SESSION */
    $link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die("Could not connect to host");
    mysqli_select_db($link, DB_DATABASE) or die("Could not find database");
    $query = "SELECT * FROM user WHERE uid=" . $_SESSION['uid'];
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
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
    <title>Movie Warehouse</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="web/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <script type="text/javascript" src="web/js/jquery-1.9.0.min.js"></script> 
    <script type="text/javascript" src="web/js/move-top.js"></script>
    <script type="text/javascript" src="web/js/easing.js"></script>
    <script type="text/javascript" src="web/js/simpleCart.js"></script>
    <script type = "text/javascript" src = "web/js/jsPDF/jspdf.js"></script>
    <script type = "text/javascript" src = "web/js/jsPDF/jspdf.plugin.from_html.js"></script>
    <script type = "text/javascript" src = "web/js/jsPDF/jspdf.plugin.split_text_to_size.js"></script>
    <script type = "text/javascript" src = "web/js/jsPDF/jspdf.plugin.standard_fonts_metrics.js"></script>
    <script type = "text/javascript" src = "web/js/jsPDF/jspdf.plugin.cell.js"></script>
    <script type = "text/javascript" src = "web/js/jsPDF/jspdf.plugin.addimage.js"></script>
    <script type = "text/javascript" src = "web/js/jsPDF/jspdf.plugin.javascript.js"></script>
    <script type = "text/javascript" src = "web/js/jsPDF/jspdf.plugin.sillysvgrenderer.js"></script>
    <script type = "text/javascript" src = "web/js/jsPDF/jspdf.plugin.javascript.js"></script>
    <script type = "text/javascript" src = "web/js/jsPDF/jspdf.PLUGINTEMPLATE.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
    <script>
        function printPDF() {

            var doc = new jsPDF();

            var elementHandler = {
                '#header': function (element, renderer) {
                    return true;
                }
            };
            var source = $('#print-pdf').html();
            var margins = {
                top: 15,
                bottom: 15,
                left: 15,
                width: 522
            };
            // all coords and widths are in jsPDF instance's declared units
            // 'inches' in this case
            doc.fromHTML(
                    source, // HTML string or DOM elem ref.
                    margins.left, // x coord
                    margins.top, {// y coord
                        'width': margins.width, // max width of content on PDF
                        'elementHandlers': elementHandler
                    });
            doc.output("dataurlnewwindow");
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
                        <li><a href="#">My Account</a></li>
                        <li><a href="viewcart.php">Shopping Cart</a></li>
                        <li><a href="includes/logout.inc.php">Log Out</a></li>
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
                        <p><a href="index.php">Home</a> &gt;&gt; <a href="viewcart.php">view cart</a>&gt;&gt; <a href="" class="active">checkout</a</p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="section group" id="print-pdf">
                    <div id="user-info">
                        <h2><?php echo $row['name']; ?></h2>
                        <div class="available">
                            <ul>
                                <li><span>Email:</span> &nbsp; <?php echo $row['email']; ?></li>
                                <li><span>Credit Card:</span>&nbsp; <?php echo $row['creditcard']; ?></li>
                            </ul>
                        </div>
                    </div>
                    <br/>
                    <div id="cart-item">
                        <table id="cart-table">
                            <thead>
                                <tr>
                                    <th><?php echo $obj[0]->Product; ?></th>
                                    <th><?php echo $obj[0]->Price; ?></th>
                                    <th><?php echo $obj[0]->Quantity; ?></th>
                                    <th><?php echo $obj[0]->TotalSum; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($i = 1; $i < count($obj); $i++) {
                                    ?>
                                    <tr>
                                        <td> <?php echo $obj[$i]->Product; ?> </td>
                                        <td> <?php echo $obj[$i]->Price; ?> </td>
                                        <td> <?php echo $obj[$i]->Quantity; ?> </td>
                                        <td> <?php echo $obj[$i]->TotalSum; ?> </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <br/>
                    <div id="total">
                        <div style="clear:left"></div>            
                        SubTotal: <span class="simpleCart_total" id="subtotal"></span> <br />
                    </div>
                </div>
                <input type="button" onclick="updateDatabase()" value="Confirm Purchase"/>
                <input type="button" onclick="printPDF()" value="Print Reciept"/>
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


