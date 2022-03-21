<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <title>Register List</title>
        
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
            
            th, tr, td{
                border: 1px solid black;
                background-color: white;
            }
            
            .listing th{
                color: slategrey;
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
        
        <h3>Register List:</h3>
        
        <div class="listing">
            <table>
                <tr>
                    <th>Register ID</th>
                    <th>Student Name</th>
                    <th>Phone Number</th>
                    <th>Gender</th>
                    <th>Email Address</th>
                    <th>Event</th>
                    <th></th>
                </tr>
                
                <?php
                    require_once('includes/uploadhelper.php');
                    require_once('includes/database.php');

                    // HUPM
                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                    // query
                    $sql = "SELECT * FROM register";

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
                                <td>
                                    <a href="EditRegister.php?id=%s" style="text-decoration: none; color: blue;">Edit</a>
                                    <br><br>
                                    <a href="DeleteRegister.php?id=%s" style="text-decoration: none; color: red;">Delete</a>
                                </td>
                                </tr>',
                                
                                $row->Register_ID,
                                $row->Student_name,
                                $row->Phone_number,
                                $row->Gender,
                                $row->Email,
                                $row->Which_event,
                                $row->Register_ID,
                                $row->Register_ID);
                        }
                    }
                                printf('
                                    <tr>
                                    <td colspan="11">
                                        Total %d Student(s) returned.
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