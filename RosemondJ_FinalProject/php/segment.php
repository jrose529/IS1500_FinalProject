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
    <style>
      body {
        background:url(https://images.pexels.com/photos/531880/pexels-photo-531880.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500) no-repeat;
        padding-top: 100px;
        background-size: cover;
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
          <li class="nav-item active">
            <a class="nav-link" href="http://is1500-rosemondj-fp.atwebpages.com/bootstrap/php/segment.php">Weekly Segments</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://is1500-rosemondj-fp.atwebpages.com/bootstrap/html/studio.html">Studio Reservations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://is1500-rosemondj-fp.atwebpages.com/bootstrap/php/store.php">Store</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://is1500-rosemondj-fp.atwebpages.com/bootstrap/html/blog.html">Community</a>
          </li>
        </ul>
      </nav>
     
      <p>&nbsp</p>
      <p>&nbsp</p>
   
<?php
$hostname = "fdb22.awardspace.net";
$username = "3166491_boatventures";
$passwd = "FinalProj29!";
$database = "3166491_boatventures";
$port = "3306";
$latestFlag = 0;

$connection = mysqli_connect($hostname, $username, $passwd, $database, $port)
   or die("Connection failed: " . mysqli_connect_error());

$sql = "SELECT * FROM segment ORDER BY seg_date DESC";
$result = $connection->query($sql);

if ($result->num_rows > 0)
{
   echo "<h1 class=\"text-center\">This Week's Spotlight</h1>";
   echo "<p>&nbsp</p>";
   
   //Latest spotlight will be displayed first, and then the older posts.
   $dbRow = $result->fetch_assoc();
   displayRow($dbRow);
   echo "<h1 class=\"text-center\">Past Spotlights</h1>";
   echo "<p>&nbsp</p>";
   
   while($dbRow = $result->fetch_assoc())
   {
      displayRow($dbRow);
   }
}
else
{
   echo "No results";
}

function displayRow($row)
{
   echo "<div class=\"row align-items-center\">";
   echo "<div class=\"col-1\"></div>";
   
   //Video and description
   echo "<div class=\"col\"><iframe width=\"480\" height=\"360\" src=\"";
   echo $row["seg_vid"] . "\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\"></iframe></div>"; 
   echo "<div class=\"col\">";
   echo "<h3 class=\"text-center\">" . $row["seg_name"] . "</h3>";
   echo "<p class=\"text-center\">" . $row["seg_artist"] . "  ||  " . $row["seg_date"] . "</p>";
   echo "<p class=\"text-center\">" . $row["seg_desc"] . "</p></div>";
   
   echo "<div class=\"col-1\"></div></div>";
   echo "<hr>";
}
?>
      
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