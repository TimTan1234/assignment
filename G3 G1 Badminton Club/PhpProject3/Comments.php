<html>
    <title>Feedback</title>
    <body>
        <style>
              .trans_border {
    width: 1000px;
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
table,td,th{
    line-height: 20px;
    border: 2px solid white;
    border-collapse: collapse;
   padding: 10px;
    
}

table{
    left: 180px;
     position: relative;
}

.bad{
    position: relative;
    right: 10px;
    width: 150px;
}

.title{
    float: right;
    position: relative;
    bottom: 100px;
    right: 700px;
}

        </style>
        <header>
             <img src="image/badminton.jpg"  class="bad" alt="badminton">
                  
        </header>
        <?php
        include('includes/backnav.php');
        ?>
        <h1 class="title">Feedback</h1>
         <div class="trans_border">
             <table>
                 <tr>
                     <th>Name</th> 
                     <th>Phone</th>
                     <th>Email</th>
                     <th>Feedback</th>
                     <th>Comment ID</th>
                 </tr>
             <?php
             require_once ('includes/database.php');
              $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
              
                $sql = "SELECT * FROM feedback";
                
                if ($result = $con->query($sql))
                {
                    while ($row = $result->fetch_object())
                    {
             printf('<tr>
                     <td>%s</td>
                     <td>%s</td>
                     <td>%s</td>
                     <td>%s</td>
                     <td>%s</td>
                     </tr>
                     ',
                     $row->name,
                     $row->phone,
                     $row->email,
                     $row->comment,
                     $row->CommentID);
                    }
                }
                $con->close();
             ?>
         </div>
    </body>
</html>