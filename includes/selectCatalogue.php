<?php

require_once('config.inc.php');

session_start();

$categories = $_GET['cat'];
$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die("Could not connect to host");
mysqli_select_db($link, DB_DATABASE) or die("Could not find database");
$queryMovie = "SELECT * FROM movie WHERE cid=" . $categories;
$queryCat = "SELECT catalogue_name FROM catalogue WHERE cid=" . $categories;

$resultMovie = mysqli_query($link, $queryMovie) or die("Movie not found");
$resultCat = mysqli_query($link, $queryCat) or die("Catalogue not found");
$rowCat = mysqli_fetch_array($resultCat);
/* Response will be generated here! */
$count = 0;
$response = "<div class='content_top'>
                <div class='heading'>
                    <h3>" . $rowCat['catalogue_name'] . "</h3>
                </div>
            </div>
            <div class='section group'>";
while ($rowMovie = mysqli_fetch_array($resultMovie)) {
    $response .= "<div class='grid_1_of_5 images_1_of_5' ";
    if($count%5 == 0){
        $response.="style='margin-left:0px'>";
    }else{
        $response.=">";
    }
    $response .= "<a href='preview.php?mid=".$rowMovie['mid']."'><img src='".$rowMovie['picture']."'></img></a>";
    $response .= "<h2><a href='preview.php?mid='".$rowMovie['mid']."'>".$rowMovie['title']."</a></h2>";
    $response .= "<div class='price-details'>";
    $response .= "<div class='price-number'>";
    $response .= "<p><span class='rupees'>Prices $".$rowMovie['price']."</span></p>";
    $response .= "</div>";
    $response .= "<div class='add-cart'>";
    if (isset($_SESSION['logged_in']))
     {
        if ($_SESSION['uid'] == 1) 
            {
                $response .= "<h4><a href='preview.php?mid=".$rowMovie['mid']."'> Edit</a></h4><br>";
                $response .= "<h4><a href='delete.php?mid=".$rowMovie['mid']."'>Delete</a></h4>";
            }
        else 
            {
                $response .= "<h4><a href='preview.php?mid=".$rowMovie['mid']."'>Preview</a></h4>";
            }
     }
    else 
     {
        $response .="<h4><a href='preview.php?mid='".$rowMovie['mid'].">Preview</a></h4>";                                    
     }
     
    $response .= "</div>";
    $response .= "<div class='clear'></div>";
    $response .= "</div>";
    $response .= "</div>";
    $count++;
}
$response .= "</div>";

echo $response;
?>