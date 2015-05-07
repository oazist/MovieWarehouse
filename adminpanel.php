<?php
require_once('includes/config.inc.php');
require_once('includes/functions.inc.php');

session_start();
if (isset($_SESSION['logged_in'])) {
    if ($_SESSION['uid'] == 1) {
        
    } else {
        redirect("profile.php");
    }
} else {
    redirect("login.php");
}
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Administration Panel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel = "stylesheet" type='text/css' href='web/css/bootstrap.css'>
        <link rel = "stylesheet" type='text/css' href='web/css/bootstrap-editable.css'>
        <link rel="stylesheet" href="web/css/font-awesome.css">
        <script src='web/js/jquery-1.11.2.min.js'></script>
        <script src='web/js/bootstrap.js'></script>
        <script src='web/js/bootstrap-editable.js'></script>
        <script src="web/js/validator.js"></script>
        <script>
            $(document).ready(function () {
                $.post("includes/listMovie.php")
                        .done(function (result) {
                            var respond = JSON.parse(result);
                            for (i = 0; i < respond.length; i++) {
                                var mRow = document.createElement("tr");
                                var mTd = document.createElement("td");
                                mTd.innerHTML = respond[i].mid;
                                mRow.appendChild(mTd);
                                //Title
                                var mTd = document.createElement("td");
                                var tagA = document.createElement("a");
                                var t = document.createTextNode(respond[i].title);
                                tagA.setAttribute('data-type', 'text');
                                tagA.setAttribute('data-validate','');
                                tagA.setAttribute('data-pk', respond[i].mid);
                                tagA.setAttribute('data-url', 'includes/updateData.php');
                                tagA.setAttribute('data-name', 'title');
                                tagA.setAttribute('id', 'title' + i);
                                tagA.appendChild(t);
                                mTd.appendChild(tagA);
                                mRow.appendChild(mTd);
                                //Category
                                var mTd = document.createElement("td");
                                var tagA = document.createElement("a");
                                tagA.setAttribute('data-type', 'select');
                                tagA.setAttribute('data-pk', respond[i].mid);
                                tagA.setAttribute('data-name', 'cid');
                                tagA.setAttribute('data-url', 'includes/updateData.php');
                                tagA.setAttribute('id', 'cid' + i);
                                mTd.appendChild(tagA);
                                mRow.appendChild(mTd);
                                //stock
                                var mTd = document.createElement("td");
                                var tagA = document.createElement("a");
                                var t = document.createTextNode(respond[i].stock);
                                tagA.setAttribute('data-type', 'number');
                                tagA.setAttribute('data-min', '0');
                                tagA.setAttribute('data-pk', respond[i].mid);
                                tagA.setAttribute('data-name', 'stock');
                                tagA.setAttribute('data-url', 'includes/updateData.php');
                                tagA.setAttribute('id', "stock" + i);
                                tagA.appendChild(t);
                                mTd.appendChild(tagA);
                                mRow.appendChild(mTd);
                                //price
                                var mTd = document.createElement("td");
                                var tagA = document.createElement("a");
                                var t = document.createTextNode(respond[i].price);
                                tagA.setAttribute('data-type', 'number');
                                tagA.setAttribute('data-step', '0.01');
                                tagA.setAttribute('data-min', '0');
                                tagA.setAttribute('data-pk', respond[i].mid);
                                tagA.setAttribute('data-name', 'price');
                                tagA.setAttribute('data-url', 'includes/updateData.php');
                                tagA.setAttribute('id', "price" + i);
                                tagA.appendChild(t);
                                mTd.appendChild(tagA);
                                mRow.appendChild(mTd);

                                var mTd = document.createElement("td");
                                var tagA = document.createElement("a");
                                tagA.setAttribute('href', 'delete.php?mid=' + respond[i].mid);
                                var mBtn = document.createElement("button");
                                var t = document.createTextNode("Delete");
                                mBtn.className = "btn btn-danger";
                                mBtn.appendChild(t);
                                tagA.appendChild(mBtn);
                                mTd.appendChild(tagA);
                                mRow.appendChild(mTd);
                                document.getElementById("table-body").appendChild(mRow);
                                //Implement x-editable library
                                $("#title" + i).editable({
                                    success: function (respond, newValue) {
                                        console.log(respond);
                                        console.log(newValue);
                                    }
                                });
                                var cid = 0;
                                if (respond[i].category == 'Action') {
                                    cid = 1;
                                } else if (respond[i].category == 'Drama') {
                                    cid = 2;
                                } else {
                                    cid = 3;
                                }

                                $("#cid" + i).editable({
                                    value: cid,
                                    source: [
                                        {value: 1, text: 'Action'},
                                        {value: 2, text: 'Drama'},
                                        {value: 3, text: 'Animation'}
                                    ]
                                });
                                $("#stock" + i).editable({
                                    success: function (respond, newValue) {
                                        console.log(respond);
                                        console.log(newValue);
                                    }
                                });
                                $("#price" + i).editable({
                                    success: function (respond, newValue) {
                                        console.log(respond);
                                        console.log(newValue);
                                    }
                                });
                            }

                        });

                $("form#data").submit(function (event) {
                    //disable the default form submission
                    event.preventDefault();
                    
                    /*User must enter all required field otherwise the record won't be added to database*/
                    var checkInput = 0;
                    var mid = document.getElementById("mid");
                    var title = document.getElementById("title");
                    var stock = document.getElementById("stock");
                    var price = document.getElementById("price");
                    var movieID = mid.value;
                    var re = new RegExp("^([a-z]{2}[0-9]{4})$");
                    
                    console.log(re.test(movieID));
                    
                    if(mid.value=="" || (!re.test(movieID))){
                        alert("Movie ID is invalid");
                        mid.required=true;
                        checkInput++;
                    }
                    
                    if(title.value==""){
                        title.required=true;
                        checkInput++;
                    }
                    
                    if(stock.value=="" || stock.value<0){
                        stock.required=true;
                        checkInput++;
                    }
                    
                    if(price.value=="" || price.value<0){
                        price.required=true;
                        checkInput++;
                    }
                    
                    //Every required input are enter
                    if (checkInput == 0) {
                        //grab all form data   
                        var formData = new FormData($(this)[0]);

                        $.ajax({
                            url: 'addData.php',
                            type: 'POST',
                            data: formData,
                            async: false,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (result) {
                                //On success Handler
                                var respond = JSON.parse(result);
                                console.log(respond);
                                var numRow = document.getElementById("mTable").rows.length;
                                var mRow = document.createElement("tr");
                                //Insert Movie ID into the row
                                var mTd = document.createElement("td");
                                mTd.innerHTML = respond[0];
                                mRow.appendChild(mTd);
                                //Insert Title into the row
                                mTd = document.createElement("td");
                                var tagA = document.createElement("a");
                                var t = document.createTextNode(respond[1]);
                                tagA.setAttribute('data-type', 'text');
                                tagA.setAttribute('data-pk', respond[0]);
                                tagA.setAttribute('data-url', 'includes/updateData.php');
                                tagA.setAttribute('data-name', 'title');
                                tagA.setAttribute('id', 'title' + numRow);
                                tagA.appendChild(t);
                                mTd.appendChild(tagA);
                                mRow.appendChild(mTd);
                                //Insert Movie's Category into the row
                                var cat = "";
                                if (respond[2] == 1) {
                                    cat = "Action";
                                } else if (respond[2] == 2) {
                                    cat = "Drama";
                                } else {
                                    cat = "Animation";
                                }
                                mTd = document.createElement("td");
                                var tagA = document.createElement("a");
                                var t = document.createTextNode(cat);
                                tagA.setAttribute('data-type', 'select');
                                tagA.setAttribute('data-pk', respond[0]);
                                tagA.setAttribute('data-url', 'includes/updateData.php');
                                tagA.setAttribute('data-name', 'cid');
                                tagA.setAttribute('id', 'cid' + numRow);
                                tagA.appendChild(t);
                                mTd.appendChild(tagA);
                                mRow.appendChild(mTd);
                                //Insert unit available into the row
                                mTd = document.createElement("td");
                                var tagA = document.createElement("a");
                                var t = document.createTextNode(respond[3]);
                                tagA.setAttribute('data-type', 'number');
                                tagA.setAttribute('data-min', '0');
                                tagA.setAttribute('data-pk', respond[0]);
                                tagA.setAttribute('data-url', 'includes/updateData.php');
                                tagA.setAttribute('data-name', 'stock');
                                tagA.setAttribute('id', 'stock' + numRow);
                                tagA.appendChild(t);
                                mTd.appendChild(tagA);
                                mRow.appendChild(mTd);

                                //Insert unit available into the row
                                mTd = document.createElement("td");
                                var tagA = document.createElement("a");
                                var t = document.createTextNode(respond[4]);
                                tagA.setAttribute('data-type', 'number');
                                tagA.setAttribute('data-step', '0.01');
                                tagA.setAttribute('data-min', '0');
                                tagA.setAttribute('data-pk', respond[0]);
                                tagA.setAttribute('data-url', 'includes/updateData.php');
                                tagA.setAttribute('data-name', 'price');
                                tagA.setAttribute('id', 'price' + numRow);
                                tagA.appendChild(t);
                                mTd.appendChild(tagA);
                                mRow.appendChild(mTd);

                                var mTd = document.createElement("td");
                                var tagA = document.createElement("a");
                                tagA.setAttribute('href', 'delete.php?mid=' + respond[0]);
                                var mBtn = document.createElement("button");
                                var t = document.createTextNode("Delete");
                                mBtn.className = "btn btn-danger";
                                mBtn.appendChild(t);
                                tagA.appendChild(mBtn);
                                mTd.appendChild(tagA);
                                mRow.appendChild(mTd);

                                //Append table-body with a newly created record
                                document.getElementById("table-body").appendChild(mRow);

                                //Implement x-editable library
                                $("#title" + numRow).editable({
                                    success: function (respond, newValue) {
                                        console.log(respond);
                                        console.log(newValue);
                                    }
                                });

                                $("#cid" + numRow).editable({
                                    value: respond[2],
                                    source: [
                                        {value: 1, text: 'Action'},
                                        {value: 2, text: 'Drama'},
                                        {value: 3, text: 'Animation'}
                                    ]
                                });
                                $("#stock" + numRow).editable({
                                    success: function (respond, newValue) {
                                        console.log(respond);
                                        console.log(newValue);
                                    }
                                });
                                $("#price" + numRow).editable({
                                    success: function (respond, newValue) {
                                        console.log(respond);
                                        console.log(newValue);
                                    }
                                });

                                $('#data').each(function () {
                                    this.reset();
                                });
                            }


                        });

                        return false;
                    }
                });

            });
        </script>


    </head>
    <body>
        <!-- Navigation Bar-->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <a href="adminpanel.html" class="navbar-brand"> MStore Admin Panel</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="index.php"><i class="fa fa-home"></i> Home</a>
                        </li>
                        <li>
                            <a href="includes/logout.inc.php"><i class="fa fa-sign-out"></i> Log Out</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
        <!---->
        <div class='container' style="margin-top:5%">
            <div class='content'>
                <div class='col-md-4'>
                    <div class="panel panel-primary">
                        <div class='panel-heading'>
                            Add Movie
                        </div>
                        <div class="panel-body">
                            <form id="data" enctype="multipart/form-data" method="post" data-toggle="validator">
                                <div class="form-group">
                                    <label for="mid" class="control-label">Movie ID</label>
                                    <input type="text" class="form-control" id="mid" name="mid" pattern="[a-z]{2}[0-9]{4}" placeholder="i.e. acXXXX, drXXXX, anXXXX">
<!--                                    <p class="help-block">first 2 characters of movie's category follow by 4-digit-number i.e. acXXXX, drXXXX, anXXXX</p>-->
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="title" class="control-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" minlenght="1" placeholder="Enter Movie Title" >
                                    </div>
                                    <div class="form-group">

                                        <label for="dropdownMenu1" class="control-label">Select Movie Category </label>
                                        <select name="category" class="form-control" required>
                                            <option value="1" >Action</option>
                                            <option value="2" >Drama</option>
                                            <option value="3" >Animation</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="stock" class="control-label">Unit-In-Stock</label>
                                        <input type="number" class="form-control" id="stock" name="stock" min="0" placeholder="Unit Availables" >
                                    </div>
                                    <div class="form-group">
                                        <label for="price" class="control-label">Price</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                            <input type="number" class="form-control" id="price" name="price" min="0" step="0.01" placeholder="Price" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="coverphoto">Upload Cover Photo</label>
                                        <input type="file" name="coverfile" id="coverphoto">
                                        <p class="help-block">Image size should be 200x200 px</p>
                                    </div>

                                    <div class="form-group">
                                        <label for="posterphoto">Upload Poster Photo</label>
                                        <input type="file" name="posterfile" id="posterphoto">
                                        <p class="help-block">Image size should be 340x202 px</p>
                                    </div>

                                    <div class="form-group">
                                        <label for="plot">Plot Summary</label>
                                        <textarea rows="3" name="plot" class="form-control" id="plot"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-success" id="submitBtn" style="float: right" >Submit</button>
                            </form>
                            <!--End of Form-->
                        </div>
                    </div>
                    <!--End of col-md-4-->
                </div>
            </div>
            <div class='col-md-8'>
                <div class="panel-info panel">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> List of Movie</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table" id="mTable" style="text-align: center;">
                            <thead>
                            <th class="text-center">Movie ID</th>
                            <th class="text-center">Title</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Stock</th>
                            <th class="text-center">Price ($)</th>
                            <th></th>
                            </thead>
                            <tbody id="table-body">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

