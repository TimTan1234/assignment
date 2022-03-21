<?php 
    require_once("includes/helper.php");
    
    function detectError() {
        global $id, $studname, $event, $qty, $amount;
        
        $error = array();
        
        if ($id == null) {
            $error["id"] = 'Please enter student id.';
        }
        else if (!preg_match('/^\d{7}$/', $id)) {
            $error["id"] = 'Invalid format student id. Format: 9999999.';
        }
        
        if ($studname == null) {
            $error["studname"] = 'Please enter your student name.';
        }
        else if (strlen($studname) > 20) {
            $error["studname"] = 'Student name must not more than 20 letters.';
        }
        else if (!preg_match('/^[A-Za-z @,\'\.\-\/]+$/', $studname)) {
            $error["studname"] = 'There are some invalid letters in student name.';
        }
        
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
    
    function validateID($ID){
   
    $exist = false;

    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $ID  = $con->real_escape_string($ID);
    $sql = "SELECT * FROM ticket WHERE ticket_id = 'ID'";

    if ($result = $con->query($sql))
    {
        if ($result->num_rows > 0)
        {
            $exist = false;
        }
    }

   
    $con->close();

    return $exist;
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Insert Booking</title>
    </head>
    <style>
        body {
             background-image: url('image/badminton.jpg');
         }
         
         .p {
             position: relative;
             right: 220px;
             top: 300px;
             text-align: center;
             bottom: 200px;
         }
         
         .table {
             position: absolute;
             padding: 10px;
             left: 40%;
             top: 35%;
             text-align: center;
             bottom: 42%;
             background: #A9A9A9;
             text-align: center;
         }
         
         .table input[type = "submit"] {
             position: absolute;
             left: 1%;
             top: 110%;
         }
         
         .table input[type="button"] {
             position: absolute;
             left: 19%;
             top: 110%;
         }
         
         .info{
             position: relative;
             left: 600px;
             bottom: 200px;
         }
    </style>
    <body>
        <h1>Insert Booking</h1>
        <?php
              include('includes/backnav.php');
            $id       = '';
            $studname = '';
            $event    = '';
            $qty      = '';
            $amount   = '';
        
            if (!empty($_POST))
            {
                $id       = strtoupper(trim($_POST['id']));
                $studname = trim($_POST['studname']);
                $event    = trim($_POST['event']);
                $qty      = trim($_POST['qty']);
                $amount   = trim($_POST['amount']);
                
                $error['id']       = '';
                $error['studname'] = '';
                $error['event']    = '';
                $error['qty']      = '';
                $error['amount']   = '';
                $error = detectError();
                
                if (empty($error))
                {
                    $ID = uniqid();
                    $error['id'] = validateID($ID);
                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                                        
                    $sql = '
                        INSERT INTO Ticket (StudentID, StudentName, Event, Quantity, Amount,ticket_id)
                        VALUES (?, ?, ?, ?, ?,?)
                    ';
                    $stm = $con->prepare($sql);
                    $stm->bind_param('sssiis', $id, $studname, $event, $qty, $amount,$ID);
                    $stm->execute();
                    if ($stm->affected_rows > 0) {
                        printf('
                            <div class="info">
                            Student <strong>%s</strong> booking has been inserted.
                            [ <a href="booking-details.php">Back to list</a> ]
                            </div>',
                            $studname);
                    }
                    else {
                        echo '
                            <div class="error">
                            Something went wrong. Record not inserted. Pls try again
                            </div>
                            ';
                    }
                    
                        $stm->close();
                        $con->close();    
                    }  
            }
        ?>
        <div class="table">
        <form action="" method="post">
            <table cellpadding="5" cellspacing="0">
                <tr>
                    <td><label for="id">Student ID :</label></td>
                    <td>
                        <?php htmlInputText('id', $id, 10) ?>
                    </td>
                    <td>
                        <?php if(isset($error['id'])) {
                            echo $error['id'];
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="studname">Student Name :</label></td>
                    <td>
                        <?php htmlInputText('studname', $studname, 20) ?>
                    </td>
                    <td>
                        <?php if(isset($error['studname']))  {
                            echo $error['studname'];
                            }
                        ?>
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
            <input type="submit" name="insert" value="Insert" />
            <input type="button" value="Cancel" onclick="location='booking-details.php'" />
        </form>
        </div>
    </body>
</html>