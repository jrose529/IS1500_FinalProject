<!DOCTYPE html>
<!-- This file combines segment.html and segmentQuery.php files. iframe wasn't working in the HTML -->
<html lang ="en">
  <head>
    <title>152Ent.</title>
    <meta charset="utf-8">
    <meta name="description" content="152 Enterprises Website made by Jensen Rosemond for Louie Hernandez">
    <meta name="keywords" content="152 Enterprises, 152Ent, Long Island, New York, Music, Rap, Hip-Hop">
    <meta name="author" content="Jensen Rosemond">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <!-- For some reason, file in directory wasn't working -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="http://is1500-rosemondj-fp.atwebpages.com/bootstrap/css/customStyle.css" />
    <!-- Social media icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Additional icons (cart) -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
      body {
        background:url(https://images.pexels.com/photos/531880/pexels-photo-531880.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500) no-repeat;
        padding-top: 100px;
        background-size: cover;
      }
      .span.newLine {
        display: block;
      }
    </style>
  </head>
  
  <body class="py-0">  
    <div class="container container-custom">
      <nav class="navbar navbar-expand-sm navbar-custom fixed-top">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="navbar-brand" href="#">152Enterprises</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://is1500-rosemondj-fp.atwebpages.com/bootstrap/html/index.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://is1500-rosemondj-fp.atwebpages.com/bootstrap/php/segment.php">Weekly Segments</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://is1500-rosemondj-fp.atwebpages.com/bootstrap/html/studio.html">Studio Reservations</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="http://is1500-rosemondj-fp.atwebpages.com/bootstrap/php/store.php">Store</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://is1500-rosemondj-fp.atwebpages.com/bootstrap/html/blog.html">Community</a>
          </li>
        </ul>
      </nav>
     
      <p>&nbsp</p>
      <p>&nbsp</p>
      
      <h1 class="display-4">STORE</h1>
   
<?php
$hostname = "fdb22.awardspace.net";
$username = "3166491_boatventures";
$passwd = "FinalProj29!";
$database = "3166491_boatventures";
$port = "3306";

$connection = mysqli_connect($hostname, $username, $passwd, $database, $port)
   or die("Connection failed: " . mysqli_connect_error());

$sql = "SELECT item_id, item_name, item_desc, item_sizeQuan, item_price, item_img FROM store";
$result = $connection->query($sql);
$modRows = $result->num_rows % 3;
$countRows = intdiv($result->num_rows, 3);

displayRow($countRows, 3, $result);

switch ($modRows)
{
  case 0:  //All rows filled, nothing to be done.
    break;
  case 1:  //Display one image on final row.
    displayRow(1, 1, $result);
    break;
  case 2:  //Display two images on final row.
    displayRow(1, 2, $result);
    break;
}

function displayImg($row)
{
  $sizeList = $row["item_sizeQuan"];
  $quanArr = explode(",", $sizeList); //Array of quantity per size. 0-5, xs-xxl
  $sizes = array("XS", "S", "M", "L", "XL", "XXL");
  
  echo "<div class=\"col-4\">";
  echo "<h4 class=\"text-center\">" . $row["item_name"] . "</h4>";
  
  //Image and descriptors.
  echo "<img class=\"pb-2\" src=\"";
  echo $row["item_img"] . "\" width=\"100%\" height=\"240\">";
  echo "<span class=\"pull-left\">" . $row["item_price"] . "  ";
  
  echo "<select id=\"sizeList\">";
  //Populate dropdown with sizes if theres stock
  for($x = 0; $x < 6; $x++){
    if($quanArr[$x] > 0 && $quanArr[$x] < 998){
      echo "<option id=\"s" . $x . "\">" . $sizes[$x] . "</option>";
    }
    //This is for items where there is no size. OoaK = One of a Kind
    else if($quanArr[$x] == 999){
      echo "<option id=\"OoaK\">1x</option>";
    }
  }
  echo "</select>";
  
  echo "</span>";
  echo "<span class=\"pull-right\"><button type=\"button\" class=\"btn\" data-toggle=\"popover\" title=\"Cart not yet implemented.\"><i class=\"material-icons\">add_shopping_cart</i></button></span>";
  echo "<p>&nbsp</p>";
  echo "<p>&nbsp</p>";
  echo "<p align=\"center\">" . $row["item_desc"] . "</p>";
  echo "</div>";
}

function displayRow($numRows, $numImg, $queryResult)
{
  for($a = 0; $a < $numRows; $a++){
    echo "<div class=\"row align-items-center\">";
  
    for($b = 0; $b < $numImg; $b++) {
      $dbRow = $queryResult->fetch_assoc();
      displayImg($dbRow);
    }
 
    echo "</div>";
  }
}
?>
      
      <p>&nbsp</p>
      <p>&nbsp</p>
      <p>&nbsp</p>

    </div>
    
    <div class="footer footer-custom">
      <p>&nbsp</p>   
      <div class="col text-center">
        <a href="https://soundcloud.com/louielulu152" class="fa fa-soundcloud"></a> 
        <a href="https://www.youtube.com/channel/UCaQuLXq4i8aPOGHqwR5kbcg" class="fa fa-youtube"></a>        
        <a href="https://www.instagram.com/louielou152/?hl=en" class="fa fa-instagram"></a>        
        <a href="https://open.spotify.com/artist/0MgbFzxLsBCeBMA15BsAnz?si=8meCQj7TS7u5l5q00XtcYA" class="fa fa-spotify"></a>     
      </div>
      <div class = "text-center">
        <p style="color: #D4AF37">&copy; 2019 152Ent. </p>
      </div>
    </div>
    
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>