<?php 
    require_once("includes/helper.php");
    
    function detectError() {
        global $event, $qty, $amount;
        
        $error = array();
        
        if ($event == null) {
            $error["event"] = 'Please enter an event.';
        }
        
        if ($qty < 1) {
            $error["qty"] = 'Please select a quantity';
        }
        
        if ($amount == null) {
            $error["amount"] = 'Please enter an amount.';
        }
        
        return $error;
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Booking Details</title>
    </head>
    <style>
        body {
             background-image: url('image/badminton.jpg');
         }
         
         .table {
             position: absolute;
             
             left: 30%;
             top: 35%;
             text-align: center;
             bottom: 33%;
             background: #A9A9A9;
             text-align: center;
         }
         
        .table h1 {
            color: black;
            position: center;
            font-weight: 500;
        }
         
        .table input[type = "submit"] {
            position: absolute;
            left: 1%;
            top: 110%;
        }
         
        .table input[type="button"] {
            position: absolute;
            left: 23%;
            top: 110%;
        }
    </style>
    <body>
          <?php
          include('includes/backnav.php');
        ?>
    <?php
    
        $hideForm = false;
    
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
            }
            else
            {
                echo '
                    <div class="error">
                    Opps. Record not found.
                    [ <a href="booking-details.php">Back to list</a> ]
                    </div>
                    ';

                $hideForm = true;
            }
            $result->free();
            $con->close();
        }

        else
        {
            $id       = strtoupper(trim($_POST['id']));
            $studname = trim($_POST['studname']);
            $event    = trim($_POST['event']);
            $qty      = trim($_POST['qty']);
            $amount   = trim($_POST['amount']);
            $error['event']  = '';
            $error['qty']    = '';
            $error['amount']    = '';
            $error = detectError();

            if (empty($error))
            {
                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $sql = '
                    UPDATE Ticket
                    SET Event = ?, Quantity = ?, Amount = ?
                    WHERE StudentID = ?
                ';
                $stm = $con->prepare($sql);
                $stm->bind_param('siis', $event, $qty, $amount, $id);
                if($stm->execute())
                {
                    printf('
                        <div class="info">
                        Student <strong>%s</strong> booking details has been updated.
                        [ <a href="booking-details.php">Back to list</a> ]
                        </div>',
                        $studname);
                }
                else
                {
                    echo '
                        <div class="error">
                        Opps. Database issue. Record not updated.
                        </div>
                        ';
                }
                $stm->close();
                $con->close();
            }
        }
        ?>
            <?php if ($hideForm == false) : ?>

        <div class="table">
        <h1>Edit Booking Details</h1>
        <form action="" method="post">
            <table cellpadding="5" cellspacing="0">
                <tr>
                    <td><label for="id">Student ID :</label></td>
                    <td>
                        <?php echo $id ?>
                        <?php htmlInputHidden('id', $id) ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="studname">Student Name :</label></td>
                    <td>
                        <?php echo $studname ?>
                        <?php htmlInputHidden('studname', $studname) ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="event">Event :</label></td>
                    <td>
                        <?php htmlInputText('event', $event, 20) ?>
                    </td>
                    <td>
                           <?php if(isset($error['event']))  {
                            echo $error['event'];
                            }
                       ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="qty">Quantity :</label></td>
                    <td>
                        <?php htmlSelect('qty', $QTY, $qty, '0')?>
                    </td>
                    <td>
                           <?php if(isset($error['qty']))  {
                            echo $error['qty'];
                            }
                       ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="amount">Amount :</label></td>
                    <td>
                        <?php htmlInputText('amount', $amount, 5) ?>
                    </td>
                    <td>
                           <?php if(isset($error['amount']))  {
                            echo $error['amount'];
                            }
                       ?>
                    </td>
                </tr>
            </table>
        <input type="submit" name="update" value="Update" />
        <input type="button" value="Cancel" onclick="location='booking-details.php'" />
        </form>
        </div>
        
        <?php endif ?>
    </body>
</html>