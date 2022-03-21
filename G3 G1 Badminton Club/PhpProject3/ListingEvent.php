<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <title>Event Listing</title>
        
        <style>
            body{
                background-color: whitesmoke;
            }
            header{
                background-color: white;
            }
            
          
            h3{
                font-size: large;
                font-family: Comic Sans MS;
                margin-bottom: 10px;
            }
         
            .listing table{
                border: 1px solid black;
                text-align: center;
                background-color: black;
                font-size: large;   
                width: 100%;
            }
            
            .listing th{
                color: slategrey;
            }
            
            th, tr, td{
                border: 1px solid black;
                background-color: white;
            }
            
            .listing img{
                width: 250px;
                margin: 3px;
            }
            
            footer{
                margin-top: 20px; 
                background: #2b2b2b;
                padding: 20px;
            }   
        </style>
        
        
        
    </head>

    
    <body>
        <header>
            <a><img src="image/Logo.png" alt="TARUC Badminton Club KL" width="150px;"/></a>
        </header>
        
       <?php
        include('includes/backnav.php');
        ?>
        
        <h3>Listing Event:</h3>
        
        <div class="listing">
            <table>
                <tr>
                    <th>Event Name</th>
                    <th>Date</th>
                    <th>Gathering Time</th>
                    <th>Venue</th>
                    <th>Registration Fees</th>
                    <th>Category Included</th>
                    <th>Deadlines of Register</th>
                    <th>Benefit</th>
                    <th>Attention</th>
                    <th></th>
                </tr>
                
                <?php
                    require_once('includes/uploadhelper.php');
                    require_once('includes/database.php');

                    // HUPM
                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                    // query
                    $sql = "SELECT * FROM event";

                    if ($result = $con->query($sql))
                    {
                        
                        while ($row = $result->fetch_object())
                        {
                            
                            printf('
                                <tr>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>
                                    <a href="EditEvent.php?event=%s" style="text-decoration: none; color: blue;">Edit</a>
                                    <br><br>
                                    <a href="DeleteEvent.php?event=%s" style="text-decoration: none; color: red;">Delete</a>
                                </td>
                                </tr>',

                                $row->Event_name,
                                $row->Date,
                                $row->Gathering_time,
                                $row->Venue,
                                $row->Registration_fees,
                                $row->Category_included,
                                $row->Deadline,
                                $row->Benefit,
                                $row->Attention,
                                $row->Event_name,
                                $row->Event_name);
                            }
                        
                    }
                                printf('
                                    <tr>
                                    <td colspan="11">
                                        Total %d event(s) returned.
                                        [ <a href="uploadEvent.php" style="text-decoration: none; color: blue;">Upload Event</a> ]
                                    </td>
                                    </tr>',
                            $result->num_rows);

                    $result->free();
                    $con->close();
                ?>
            </table>
               
        
        <footer></footer>
        
    </body>
    
</html>