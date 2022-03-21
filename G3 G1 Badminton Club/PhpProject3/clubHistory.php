<html>
<head>
<meta charset="utf-8">
    <title>Club History</title>
 
 <style>
        /* Slideshow container */
.slideshow {
    max-width: 1000px;
    position: relative;
    margin: auto;
  }

  img{
      height: 300px;
  }
  
  
  .active {
    background-color: #717171;
  }
  
  /* Fading animation */
  .fade {
    -webkit-animation-name: fade;
    -webkit-animation-duration: 1.5s;
    animation-name: fade;
    animation-duration: 1.5s;
  }
  
  @-webkit-keyframes fade {
    from {opacity: .4} 
    to {opacity: 1}
  }
  
  @keyframes fade {
    from {opacity: .4} 
    to {opacity: 1}
  }
  

  .event1{
      border: outset;
      height: 400px;
      width: 1100px;
      position: relative;
      left: 210px;
      background-color:rgb(141, 143, 14) ;
      
  }
  

  .image1{
      width: 450px;
      position: relative;
      left: 40px;
      
  }

  .content1{
      text-align: center;
  }

  .nav {
    height: 100%;
    width: 150px;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #333;
    overflow-x: hidden;
    padding-top: 20px;
  }
  
  .nav a {
    padding: 6px 6px 6px 32px;
    text-decoration: none;
    font-size: 25px;
    color: rgb(19, 226, 19);
    display: block;
  }
  
  .nav a:hover {
   text-decoration: none;
   border: 1px solid rgb(12, 255, 12);
   background-color: #111;;
  }
 
  
a{
  color: black;
}
a :hover{
  color: blue;
}


.Badminton{
  float: right;
  position: relative;
  bottom: 10px;
  
  
}

    </style>
    </head>
<body>
<header>
<div class="slideshow">

<div class="mySlides fade">
  <img src="image/slide1.jpg" style="width:100%">
</div>

<div class="mySlides fade">
  <img src="image/slide2.jpg" style="width:100%">
</div>

<div class="mySlides fade">
  <img src="image/slide3.jpg" style="width:100%">
</div>

</div>
<br>
<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
</div>

<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); 
}
</script>

</header>
<div class="nav">
  <a href="Home.php">Home</a>
  <a href="Event.php">Event</a>
  <a href="FAQ.php">FAQ</a>
  <a href="contactUs.php">Contact Us</a>
  <a href="aboutus.php">About Us</a>
  <a href="login.php">Login</a>
</div>
   


    <?php
    
     require_once('includes/database.php');

                // HUPM
                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                // query
                $sql = "SELECT Event_name,Date,Gathering_time,Venue,Registration_fees,Benefit FROM event WHERE Status = 'No'";

                if ($result = $con->query($sql))
                {
                    while ($row = $result->fetch_object())
                    {
                        printf('<div class="event1">
                                 <h1 class="content1">%s</h1>
                                  <img src="history/%s.jpg"  class="image1"/>
                                 <p class="Badminton">Date:<br>%s<br>Gathering Time:%s<br>Venue:<br>%s<br>Registration Fee:<br>%s<br>Benefit:<br>%s<br></p>
                                
                               
                               </div>
                                ' , 
                                $row->Event_name,
                                $row->Event_name,
                                $row->Date,
                                $row->Gathering_time,
                                $row->Venue,
                                $row->Registration_fees,
                                $row->Benefit);
                    }
                }
                
               
                 $con->close(); 
                                ?>

</body>



