
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>User History</title>
    </head>
    <body>
          
    <style>
        html{
   background-color: rgba(39, 36, 36, 0.486);
   
}
.trans_border {
    width: 800px;
    height: 1000px;
    margin: auto;
    margin-top: 3%;
    text-align: center;
    border: 20px double rgba(0, 0, 0, .4);
    background: rgba(0, 0, 0, .4);
    background-clip: padding-box;
    border-radius: 5px;
    padding: 5px;
}

 table, th, td{
 border-bottom: 1px solid black;
 font-size: 20px;

 }
 
 td{
     color: white;
 }
 
    </style>
        <header>
             <?php
       include('includes/navigation.php');
       ?>
        </header>
         <div class="images">
             <div class="trans_border">
               
        <h1>Transaction History</h1>
        <style>
         .images {
  background-image: url('image/shakehand1.jpg');
  background-size: 1550px 500px;
  background-repeat: no-repeat;
        }
        
        </style>
        <div class="a">
            <table style="width:100%">
  <tr>
    <th>Student ID</th>
    <th>Detail</th> 
    <th>Quantity</th>
    <th>ID</th>
  </tr>
<?php
session_start();
 require_once('includes/database.php');

        $ID = "";
        $ID = $_SESSION['id'];
        
               $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $sql="SELECT * FROM ticket WHERE StudentID = $ID";
                
                if ($result = $con->query($sql)){
                     while ($row = $result->fetch_object()){
                           printf('<tr>
                           <td>%s</td>
                           <td>%s</td>
                           <td>%d</td>
                           <td>%s</td>
                           </tr>',
        $row->StudentID,
        $row->Event,
        $row->Quantity,
        $row->ticket_id);
    }
}
    ;
    $con->close();	
     ?>
  
 
</table>
            </div>       
                        </div>
             </div>
    </body>
  
    <?php
    require_once('includes/footer.php');
?>
</html>
