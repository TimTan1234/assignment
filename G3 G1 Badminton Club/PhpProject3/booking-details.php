<html>
    <head>
        <meta charset="UTF-8">
        <title>Booking Details</title>
    </head>
    <style>
        body {
             background-image: url('image/badminton.jpg');
         }
         
         .table {
             position: relative;
             left: 460px;
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
             top: 30px;
             right: 700px;
             text-align: center;
         }
    </style>
    <body>
        <h1>Booking Details</h1>
        <?php
          include('includes/backnav.php');
        ?>
        <div class="table">
        <form action="" method="post">
        <table border="10" cellpadding="5" cellspacing="0">
            <tr>
                <th></th>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Event</th>
                <th>Quantity</th>
                <th>Total Amount(RM)</th>
                <th>Ticket ID</th>
                <th></th>
            </tr> 
            <?php
                require_once('includes/helper.php');
                
                if (isset($_POST['delete']))
                    {
                        $checked = $_POST['checked'];

                        if (!empty($checked)) 
                        {
                            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                            foreach ($checked as $id)
                            {
                                $escaped[] = $con->real_escape_string($id);
                            }

                            $sql = "DELETE FROM Ticket WHERE StudentID IN ('" .
                                   implode("','", $escaped) . "')";

                            if ($con->query($sql))
                            {
                                printf('
                                    <strong>%d</strong> record(s) has been deleted.',
                                    $con->affected_rows);
                            }

                            $con->close();
                        }
                    }
                
                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $sql = "SELECT * FROM Ticket";
                
               if ($result = $con->query($sql))
                    {
                        while ($row = $result->fetch_object())
                        {
                            printf('
                                <tr>
                                <td>
                                    <input type="checkbox" name="checked[]" value="%s" />
                                </td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s.00</td>
                                <td>%s</td>
                                <td>
                                    <a href="edit-booking.php?id=%s">Edit</a> |
                                    <a href="delete-booking.php?id=%s">Delete</a>
                                </td>
                                </tr>',
                                $row->StudentID,
                                $row->StudentID,
                                $row->StudentName,
                                $row->Event,
                                $row->Quantity,
                                $row->Amount,
                                $row->ticket_id,
                                $row->StudentID,
                                $row->StudentID);
                        }
                    }
            printf('
                <tr>
                <td colspan="7">
                %d record(s) returned.
                [ <a href="insert-booking.php">Insert</a> ]
                </tr>',
                    $result->num_rows);

            $result->free();
            $con->close();
        ?>
        </table>
        <div class="submit">
        <input type="submit" name="delete" value="Delete Selected" onclick="return confirm('This will delete all checked records.\nAre you sure?')" />
        </div>
        </form>
        </div> 
    </body>
</html>