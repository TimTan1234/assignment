<?php 
    require_once("includes/helper.php");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ticket Selling</title>
    <h1 class="ticket">Ticket Selling</h1>
    </head>
    <style>
        body {
             background-color: antiquewhite;
         }
         
         .table {
             position: relative;
             left: 310px;
             top:10px;
             text-align: center;
             color: red;
         }
         
         .ticket{
             border: 1px solid blue;
             width: 100px;
             background-color: brown;
         }
         
         img{
             position: relative;
             left: 200px;
             bottom: 20px;
             top: 10px;
             width:25%;
            margin: 20px;
         }
         
    </style>
    <body>
        <?php
       
         $StuudentID;
      
     
  
           include('includes/navigation.php');
           require_once('includes/helper.php');
        
                         foreach (glob('uploads/*.{jpg,jpeg,gif,png}', GLOB_BRACE) as $file){
                        $basename = pathinfo($file, PATHINFO_BASENAME);
            $path_parts = pathinfo($file, PATHINFO_FILENAME);
            printf('<img src="uploads/%s" />',$basename);
                         }
                          
                    
                    
            
        
           
           ?>
    <div class="table">
    <form action="" method="post">
        <table border="10" cellpadding="5" cellspacing="0">
            <tr>
                <th>Event</th>
                <th>Price(RM)</th>
                <th>Time</th> 
                <th>Date</th>
                <th></th>
            </tr>    
            <?php 
                

                if (!empty($_POST)) {
                    $studname = trim($_POST['studname']);
                    $id       = trim($_POST['id']);
                    $Quantity = trim($_POST['Quantity']);
                    
                if (empty($error)) {
                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    $sql = '
                        INSERT INTO Ticket (StudentID, StudentName, Event, Quantity, Amount)
                        VALUES (?, ?, ?, ?, ?)
                        ';
                    $stm = $con->prepare($sql);
                    $stm->bind_param('sssss', $id, $studname, $event, $qty, $amount);
                    $stm->execute();

                    echo "<script>alert('Thanks for joining our event.')</script>";

                }
                else {
                    echo '<ul class="error">';
                    foreach ($error as $value) {
                        echo "<li>$value</li>";
                        }
                        echo '</ul>';
                        }
                }
            ?>
            <?php 
                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $sql = "SELECT Event_name,Price,Gathering_time,Date FROM Event Where Status = 'Ongoing' ";
                if ($result = $con->query($sql))
                {
                    while ($row = $result->fetch_object())
                    {
                        printf('
                                <tr>
                                <td>%s</td>
                                <td>%s.00</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>
                                    <a href="ticket-confirm.php?event=%s">Book</a>
                                </td>
                                </tr>',
                                $row->Event_name,
                                $row->Price,
                                $row->Gathering_time,
                                $row->Date,
                                $row->Event_name);
                    }
                }
                
                 
                $con->close(); 
            ?>  
        </table>
        </form>
    </div>
        
       
    </body>
            <?php
    require_once('includes/footer.php');
?>
      
       
</html>