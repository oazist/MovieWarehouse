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
    <link rel="stylesheet" href="web/css/font-awesome.css">
    <script type="text/javascript" src="web/js/jquery-1.11.2.min.js"></script> 
    <script type="text/javascript" src="web/js/move-top.js"></script>
    <script type="text/javascript" src="web/js/easing.js"></script>
    <script type="text/javascript" src="web/js/simpleCart.js"></script>
    <link rel="stylesheet" href="web/css/button.css">

    <script type = "text/javascript" src = "web/js/jsPDF/jspdf.js"></script>
    <script type = "text/javascript" src = "web/js/jsPDF/jspdf.plugin.from_html.js"></script>
    <script type = "text/javascript" src = "web/js/jsPDF/jspdf.plugin.split_text_to_size.js"></script>
    <script type = "text/javascript" src = "web/js/jsPDF/jspdf.plugin.standard_fonts_metrics.js"></script>
    <script type = "text/javascript" src = "web/js/jsPDF/jspdf.plugin.cell.js"></script>
    <script type = "text/javascript" src = "web/js/jsPDF/jspdf.plugin.addimage.js"></script>
    <script type = "text/javascript" src = "web/js/jsPDF/jspdf.plugin.javascript.js"></script>
    <script type = "text/javascript" src = "web/js/jsPDF/jspdf.plugin.sillysvgrenderer.js"></script>
    <script type = "text/javascript" src = "web/js/jsPDF/jspdf.PLUGINTEMPLATE.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>

    <script type="text/javascript" src="web/js/jquery.redirect.js"></script>
    <link href="web/css/table.css" rel="stylesheet" type="text/css" media="all"/>
    <script>
        function printPDF() {

            var doc = new jsPDF();
            var img = 'data:image/png;base64,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';
            doc.addImage(img, 'JPEG', 30, 15, 50, 25);

            var date = Date();
            var customer = document.getElementById("name").innerHTML;
            var email = document.getElementById('email').innerHTML;
            var credit = document.getElementById('credit-card').innerHTML;
            var total = document.getElementById('subtotal').innerHTML;
            doc.setFont("times");
            doc.setFontSize(24);
            doc.setTextColor(255, 0, 0);
            doc.setFontType("bolditalic");
            doc.text(100, 30, 'Transaction Bill');

            doc.setFontSize(18);
            doc.setFontType("bold");
            doc.setTextColor(0, 0, 0);
            doc.text(100, 45, 'Customer Information');
            doc.setFontSize(14);
            doc.text(100, 55, 'Name:  ' + customer);
            doc.text(100, 65, 'Email: ' + email);
            doc.text(100, 75, 'Credit Card: '+credit);
            doc.setFontSize(12);
            doc.text(30, 90, "Date Issue: " + date + "              " + "SubTotal: " + total);

            doc.setDrawColor(0, 0, 255);
            doc.setProperties({
                title: 'Invoice',
                subject: 'Transaction Bill',
                author: 'MStore',
            });

            var elementHandler = {
                '#user-info': function (element, renderer) {
                    return true;
                }

            };
            var source = $('#cart-item').html();
            var margins = {
                top: 95,
                bottom: 15,
                left: 30,
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
            doc.save("reciept-" + date + ".pdf");
        }

        function updateDatabase() {
            var mSubtotal = document.getElementById('subtotal').innerHTML;
            var mTable = document.getElementById('cart-table');

            //gets rows of table
            var rowLength = mTable.rows.length;
            var tableArray = [];

            //loops through rows    
            for (i = 1; i < rowLength; i++) {
                //gets cells of current row  
                var mCells = mTable.rows.item(i).cells;
                //gets amount of cells of current row
                var cellLength = mCells.length;

                var objAdd = {};
                objAdd.Product = mCells.item(0).innerHTML;
                objAdd.Quantity = mCells.item(2).innerHTML;
                tableArray.push(objAdd);
            }

            var sendData = JSON.stringify(tableArray);
            printPDF();
            simpleCart.empty();
            $.redirect('includes/checkout.inc.php', {'updateObject': sendData, 'subtotal': mSubtotal});
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
                        <li><a href="#"><?php echo $_SESSION['username']; ?></a></li>
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
                    <div id="user-info"><br>
                        <label class="font12" id="name"><?php echo $row['name']; ?></Label><br>
                        <div class="available">
                            <ul><br>
                                <label class="font10"><span>Email:</span> &nbsp<span id="email"><?php echo $row['email']; ?></span></label><br><br>
                                <label class="font10"><span>Credit Card:</span>&nbsp;<span id="credit-card"><?php echo $row['creditcard']; ?></span></label>
                            </ul>
                        </div>
                    </div>
                    <br/>
                    <div id="cart-item">
                        <?php
                        if (count($obj) > 0) {
                            ?>
                            <table class="table2" id="cart-table">

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
                                            <td><?php echo $obj[$i]->Product; ?></td>
                                            <td><?php echo $obj[$i]->Price; ?></td>
                                            <td><?php echo $obj[$i]->Quantity; ?></td>
                                            <td><?php echo $obj[$i]->TotalSum; ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                        }
                        ?>
                    </div>
                    <br/>
                    <div id="total">
                        <div style="clear:left"></div></br></br>            
                        <label class="font11">SubTotal: <span class="simpleCart_total" id="subtotal"></span></label> <br /><br /><br>
                    </div>
                </div>

            </div> 
            <br><br>
            <a href="javascript:;" class="Button2" onclick="updateDatabase()">Confirm Purchase</a><br/>
            </br></br> </br></br>
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


