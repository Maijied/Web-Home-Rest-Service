
 <?php
  
  include("connect.php");
  include("function.php");

   

  $error = "";


  if(isset($_POST['submit']))
  {
    $location =mysql_real_escape_string( $_POST['location']);
    $htype = mysql_real_escape_string($_POST['htype']);
    $hdetails = mysql_real_escape_string($_POST['hdetails']);
    $haddress = mysql_real_escape_string($_POST['haddress']);
    $contact = mysql_real_escape_string($_POST['contact']);
    $rent = mysql_real_escape_string($_POST['rent']);

    $himage = $_FILES['himage']['name'];
    $tmp_himage = $_FILES['himage']['tmp_name'];
    $himageSize = $_FILES['himage']['size'];

    




    
    
    
     if ($himage == "") 
    {
      $error = "Please Upload Your Image";
    }
    else if ($himageSize>10485760) 
          {
            $error ="Image Size Must be Less Than 10 MB";
          }
     
    else
    {

      

      $himageExt = explode(".", $himage);
      $himageExtension = $himageExt[1];

      if ($himageExtension == "PNG" || $himageExtension == "png" || $himageExtension == "JPG" || $himageExtension == "jpg" || $himageExtension == "JEPG" || $himageExtension == "jepg") 
      {
       

      $himage = rand(0,100000).rand(0,100000).rand(0,100000).time().".".$himageExtension ;
      


      $insertQuery = "INSERT INTO home(location,htype,hdetails,haddress,contact,rent,himage) VALUES ('$location','$htype','$hdetails','$haddress','$contact','$rent','$himage') " ;
      if(mysqli_query($sylcon,$insertQuery))
        {
           move_uploaded_file($tmp_himage,"himages/$himage");
          
          
          
        }
      }
      

    }

    /*echo $firstName."<br/>".$lastName."<br/>".$email."<br/>".$password."<br/>".$passwordConfirm."<br/>".$image."<br/>".$imageSize ; */
  }

?>






<!DOCTYPE html>
<html lang="en">
<head>
  <title>Syl-Rent</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/homestyle.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
  </style>
</head>
<body>


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Syl-Rent</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
      <li class="active"><a href="home.php">Home</a></li>
        <li class="active"><a href="profile.php">Profile</a></li>
        <li><a href="search.html">Search ADS </a></li>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> logout</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <p><a href="#">Familly House</a></p>
      <p><a href="#">Couple House</a></p>
      <p><a href="#">Single(Mess)</a></p>
    </div>
    
    <div class="col-sm-8 text-left"> 
     
      <h1>Post Your Ad:</h1>
      

       <div id="addDiv">
      <form method="POST" action="home.php" enctype="multipart/form-data">
      
       <label>Location:</label> <br/>
      <input type="text" name="location" class="inputFields" placeholder="Ambarkhana,Surma etc.." required /> <br/><br/>

      <label>House Type:</label> <br/>
      <input type="text" name="htype" class="inputFields" placeholder="Familly,Bechelor etc.." required /> <br/><br/>

      <label>House Details:</label> <br/>
      <input type="text" name="hdetails" class="inputFields" placeholder="3 bedroom,1 dining etc.." required /> <br/><br/>

       <label>House Address:</label> <br/>
      <input type="text" name="haddress" class="inputFields" placeholder="102/k Housing Estate etc.." required /> <br/><br/>
      
      <label>Contact Number:</label> <br/>
      <input type="text" name="contact" class="inputFields" placeholder="01*********" required /> <br/><br/>

      <label>Rent Per Month:</label> <br/>
      <input type="text" name="rent" class="inputFields" placeholder="12000 tk etc" required /> <br/><br/>

      <label>House Image:</label> <br/>
      <input type="file" name="himage" id="imageupload" /> <br/>
      
      

      <input type="submit" name="submit" value="Submit" class="theButtons" /> <br/><br/>

     </form>
    
    </div>


      <hr>
      <h3>Available Houses</h3>
     <?php  echo $location."<br/>".$htype."<br/>".$hdetails."<br/>".$haddress."<br/>".$contact."<br/>".$rent."<br/>".$himage ;   ?>
    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
       



        <p><canvas id="canvas" width="170" height="170"
style="background-color:#333">
</canvas>

<script>
var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var radius = canvas.height / 2;
ctx.translate(radius, radius);
radius = radius * 0.90
setInterval(drawClock, 1000);

function drawClock() {
  drawFace(ctx, radius);
  drawNumbers(ctx, radius);
  drawTime(ctx, radius);
}

function drawFace(ctx, radius) {
  var grad;
  ctx.beginPath();
  ctx.arc(0, 0, radius, 0, 2*Math.PI);
  ctx.fillStyle = 'white';
  ctx.fill();
  grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
  grad.addColorStop(0, '#333');
  grad.addColorStop(0.5, 'white');
  grad.addColorStop(1, '#333');
  ctx.strokeStyle = grad;
  ctx.lineWidth = radius*0.1;
  ctx.stroke();
  ctx.beginPath();
  ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
  ctx.fillStyle = '#333';
  ctx.fill();
}

function drawNumbers(ctx, radius) {
  var ang;
  var num;
  ctx.font = radius*0.15 + "px arial";
  ctx.textBaseline="middle";
  ctx.textAlign="center";
  for(num = 1; num < 13; num++){
    ang = num * Math.PI / 6;
    ctx.rotate(ang);
    ctx.translate(0, -radius*0.85);
    ctx.rotate(-ang);
    ctx.fillText(num.toString(), 0, 0);
    ctx.rotate(ang);
    ctx.translate(0, radius*0.85);
    ctx.rotate(-ang);
  }
}

function drawTime(ctx, radius){
    var now = new Date();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();
    //hour
    hour=hour%12;
    hour=(hour*Math.PI/6)+
    (minute*Math.PI/(6*60))+
    (second*Math.PI/(360*60));
    drawHand(ctx, hour, radius*0.5, radius*0.07);
    //minute
    minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
    drawHand(ctx, minute, radius*0.8, radius*0.07);
    // second
    second=(second*Math.PI/30);
    drawHand(ctx, second, radius*0.9, radius*0.02);
}

function drawHand(ctx, pos, length, width) {
    ctx.beginPath();
    ctx.lineWidth = width;
    ctx.lineCap = "round";
    ctx.moveTo(0,0);
    ctx.rotate(pos);
    ctx.lineTo(0, -length);
    ctx.stroke();
    ctx.rotate(-pos);
}
</script></p>




      </div>
      <div class="well">
        <p>ADS</p>
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
<p>Developed By MajhiOla Team</p>
  <a href="contact.html">Contact With Us</a>
</footer>

</body>
</html>
