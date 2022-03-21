<html>
    <head>
        <meta charset="UTF-8">
        <title>Delete Booking</title>
        <h1>Delete Booking</h1>
    </head>
    <style>
        body {
             background-image: url('image/badminton.jpg');
         }
         
         .p {
             position: relative;
             right: 70px;
             top: 50px;
             text-align: center;
             bottom: 200px;
             color: red;
         }
         
         .table {
             position: relative;
             left: 560px;
             top: 50px;
             text-align: center;
             bottom: 200px;
             color: white;
         }
         
         table{
             background-color: #808080;
             color: white;
         }
         
         .submit {
             position: relative;
             right: 140px;
             top: 50px;
             text-align: center;
             bottom: 200px;
             color: white;
         }
    </style>
    <body>
        <?php
          include('includes/backnav.php');
        ?>
        <?php 
            require_once('includes/helper.php');
    
            if ($_SERVER['REQUEST_METHOD'] == 'GET')
            {
                $id = strtoupper(trim($_GET['id']));

                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $id  = $con->real_escape_string($id);
                $sql = "SELECT * FROM Ticket WHERE StudentID = '$id'";

                $result = $con->query($sql);
                if ($row = $result->fetch_object())
                {  
                    $id       = $row->StudentID;
                    $studname = $row->StudentName;
                    $event    = $row->Event;
                    $qty      = $row->Quantity;
                    $amount   = $row->Amount;
                    printf('
                        <div class="p">
                        <p>
                            Are you sure you want to delete the following record?
                        </p>
                        </div>
                        <div class="table">
                        <form class="box" action="" method="post">
                        <table border="5" cellpadding="5" cellspacing="0">
                            <tr>
                                <td>Student ID :</td>
                                <td>%s</td>
                            </tr>
                            <tr>
                                <td>Student Name :</td>
                                <td>%s</td>
                            </tr>
                            <tr>
                                <td>Event :</td>
                                <td>%s</td>
                            </tr>
                            <tr>
                                <td>Quantity :</td>
                                <td>%s</td>
                            </tr>
                            <tr>
                                <td>Amount :</td>
                                <td>%s</td>
                            </tr>
                        </table>
                        </form>
                        </div>
                        <div class="submit">
                        <form action="" method="post">
                            <input type="hidden" name="id" value="%s" />
                            <input type="hidden" name="studname" value="%s" />
                            <input type="submit" name="yes" value="Yes" />
                            <input type="button" value="Cancel"
                                   onclick="location=\'booking-details.php\'" />
                        </form>
                        </div>',
                        $id, $studname, $event, $qty, $amount,
                        $id, $studname);
                }
                else
                {
                    echo '
                        <div class="error">
                        Opps. Record not found.
                        [ <a href="booking-details.php">Back to list</a> ]
                        </div>
                        ';
                }

                $result->free();
                $con->close();
            } 
            else
            {
                $id   = strtoupper(trim($_POST['id']));
                $studname = trim($_POST['studname']);

                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $sql = '
                    DELETE FROM Ticket
                    WHERE StudentID = ?
                ';
                $stm = $con->prepare($sql);
                $stm->bind_param('s', $id);
                $stm->execute();
                if ($stm->affected_rows > 0)
                {
                    printf('
                        <div class="info">
                        Student <strong>%s</strong> booking details has been deleted.
                        [ <a href="booking-details.php">Back to list</a> ]
                        </div>',
                        $studname);
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
    </body>
</html>