<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <title>Delete Register</title>
        
        <style>
            body{
                background-color: whitesmoke;
                font-family: Comic Sans MS;
            }
            header{
                background-color: white;
            }
            
          
            
            .data{
                margin-left: 10%;
            }
            
            .blank{
                margin: 50px;
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
        
        <h3>Delete :</h3>
        
        <div class="data"> 
        <?php
            require_once('includes/uploadhelper.php');
            require_once('includes/database.php');

            // --> Retrieve Student record based on the passed StudentID.
            if ($_SERVER['REQUEST_METHOD'] == 'GET')
            {
                $id = trim($_GET['id']);

                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $id  = $con->real_escape_string($id);
                $sql = "SELECT * FROM register WHERE Register_ID = '$id'";
                $result = $con->query($sql);
                if ($row = $result->fetch_object())
                {
                    // Record found. Read field values.
                    $id        =$row->Register_ID;
                    $name      = $row->Student_name;
                    $phone    = $row->Phone_number;
                    $gender  = $row->Gender;
                    $email = $row->Email;
                    $from     = $row->Which_event;
                    printf('
                        <p>
                            Are you sure you want to delete the following Student?
                        </p>
                        <table border="1" cellpadding="5" cellspacing="0">
                            <tr>
                                <td>Register ID :</td>
                                <td>%s</td>
                            </tr>
                            
                            <tr>
                                <td>Student Name :</td>
                                <td>%s</td>
                            </tr>
                            <tr>
                                <td>Phone Number :</td>
                                <td>%s</td>
                            </tr>
                            <tr>
                                <td>Gender :</td>
                                <td>%s</td>
                            </tr>
                            <tr>
                                <td>Email :</td>
                                <td>%s</td>
                            </tr>
                            <tr>
                                <td>Which Event :</td>
                                <td>%s</td>
                            </tr>
                        </table>
                        <form action="" method="post">
                            <input type="hidden" name="id" value="%s" />
                            <input type="hidden" name="name" value="%s" />
                            <input type="hidden" name="phone" value="%s" />
                            <input type="hidden" name="gender" value="%s" />
                            <input type="hidden" name="email" value="%s" />
                            <input type="hidden" name="from" value="%s" />
                            <br>
                            <input type="submit" name="yes" value="Yes" />
                            <input type="button" value="Cancel"
                                   onclick="location=\'ListingEvent.php\'" />
                        </form>',
                        $id, $name, $phone, $gender, $email, $from,
                        $id, $name, $phone, $gender, $email, $from);
                }
                else
                {
                    echo '
                        <div class="error">
                        Opps. Record not found.
                        [ <a href="ListingEvent.php">Back to list</a> ]
                        </div>
                        ';
                }

                $result->free();
                $con->close();
            }
            // POST METHOD ////////////////////////////////////////////////////////////
            // --> Update the record.   
            else
            {
                $id         =trim($_POST['id']);
                $name      = trim($_POST['name']);
                $phone  = trim($_POST['phone']);
                $gender = trim($_POST['gender']);
                $email = trim($_POST['email']);
                $from = trim($_POST['from']);
            
                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                // SELECT * FROM
                // INSERT INTO
                // UPDATE TABLE
                // DELETE FROM

                $sql = '
                    DELETE FROM register
                    WHERE Register_ID = ?
                ';
                $stm = $con->prepare($sql);
                $stm->bind_param('s', $id);
                $stm->execute();
                if ($stm->affected_rows > 0)
                {
                    printf('
                        <div class="info">
                        Student <strong>%s</strong> has been deleted.
                        [ <a href="RegisterList.php">Back to list</a> ]
                        </div>',
                        $name);
                }
                else
                {
                    echo '
                        <div class="error">
                        Opps. Database issue. Record not deleted.
                        </div>
                        ';
                }
                $stm->close();
                $con->close();
            }

            ?>
        </div>
        
        
        <div class="blank"></div>
        <footer></footer>
        
    </body>
    
</html>