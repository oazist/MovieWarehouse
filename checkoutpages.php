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
            doc.save("reciept.pdf");
        }
        
        function updateDatabase(){
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
                        <li><a href="#"><?php echo $_SESSION['username'];?></a></li>
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
                        <label class="font12"><?php echo $row['name']; ?></Label><br>
                        <div class="available">
                            <ul><br>
                                <label class="font10"><span>Email:</span> &nbsp; <?php echo $row['email']; ?></label><br><br>
                                <label class="font10"><span>Credit Card:</span>&nbsp; <?php echo $row['creditcard']; ?></label>
                            </ul>
                        </div>
                    </div>
                    <br/>
                    <div id="cart-item">
                        <?php 
                        if(count($obj) > 0){
                        ?>
                        <table class="table2" id="cart-table">
                            
                            <thead>
                                <tr>
                                    <th><?php echo $obj[0]->Product;?></th>
                                    <th><?php echo $obj[0]->Price;?></th>
                                    <th><?php echo $obj[0]->Quantity;?></th>
                                    <th><?php echo $obj[0]->TotalSum;?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($i = 1; $i < count($obj); $i++) {
                                    ?>
                                    <tr>
                                        <td><?php echo $obj[$i]->Product;?></td>
                                        <td><?php echo $obj[$i]->Price;?></td>
                                        <td><?php echo $obj[$i]->Quantity;?></td>
                                        <td><?php echo $obj[$i]->TotalSum;?></td>
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


