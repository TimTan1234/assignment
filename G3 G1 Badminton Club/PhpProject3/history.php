<html>
<head>
     <meta charset="utf-8">
    <title>History</title>

</head>
<body>
<header style="height: 325px;">
       
         <?php
       include('includes/navigation.php');
       ?>
    <style>
  .form1{
      border: outset;
      position: relative;
      width: 300px;
      height: 300px;
      top: 300px;
      left: 400px;
      border-width: 4px;
      text-align: center;
  }

  .form2{
      border: outset;
      position: relative;
      width: 300px;
      height: 300px;
      left: 800px;
      bottom: 384px;
      border-width: 4px;
      text-align: center;
  }

  .user{
      width: 200px;
      position: relative;
      left: 450px;
      top: 40px;
  }

  .society{
    width: 230px;
    position: relative;
    left: 850px;
    bottom: 660px;
  }

  .button1{
      position: relative;
      left: 480px;
      top: 110px;
      background-color: #4CAF50; /* Green */
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
  }

  .button1:hover{
    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
  }
  
  .button2{
    position: relative;
    left: 900px;
    top: 40px;
    background-color: #4CAF50; 
    color: white;
    padding: 15px 32px;
    text-align: center;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    border: none;
  }

  
  .button2:hover{
    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
  }

   footer {
            margin-left: auto;
            margin-right: auto;
            background-color: rgb(37, 37, 37);
            column-width: 300px;
            column-gap: 70px;
            height: 200px;
            padding-left: 1%;
            width: 100%;
        }
        
        footer:before {
            clear: both;
            order: 99;
        }
        
        footer h1 {
            color: rgb(56, 190, 179);
            font-size: 15px;
            margin: 10px 0px;
            padding-top: 5%;
        }
        
        .footernav a {
            color: white;
            font-size: 16px;
            display: block;
            text-decoration: none;
        }
        
        .footernav a:hover {
            color: rgb(146, 137, 137);
        }
        
        .footer::after {
            clear: both;
        }
        
        .content {
            height: 80%;
        }
        
        .footernav {
            width: 100%;
        }
        
        header:after {
            clear: both;
        }


    </style>
        <div class="form">
        <div class="img1">
         <h1 class="form1">User History</h1>
         <img src="image/profile2.png" class="user">
          <form action="userHistory.php" >
          <button type="submit" class="button1">Continue</button>
        </form>
         </div>
         <form action="clubHistory.php" >
          <button type="submit" class="button2">Click Me!</button>
        </form>
        
         <div class="img2">
         <h1 class="form2">Society History</h1>
          <img src="image/badminton.jpg" class="society">
       
         </div>
        </div>
      <?php
    require_once('includes/footer.php');
     ?>  
</body>

 
</html>