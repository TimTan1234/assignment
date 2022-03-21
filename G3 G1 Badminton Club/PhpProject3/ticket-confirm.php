<?php 
    require_once("includes/helper.php");
    
    function detectError() {
        global $studname, $id, $qty;
        
        $error = array();
        
        if ($id == null) {
            $error["id"] = 'Please enter Student ID.';
        }
        else if (!preg_match('/^\d{7}$/', $id)) {
            $error["id"] = 'Invalid format Student ID. Format: 9999999.';
        }
        else if (notStudentIDExist($id)) {
            $error["id"] = 'Pls register an account first.';
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
        
        if ($qty < 1) {
            $error["qty"] = 'Please select a quantity';
        }
        
        return $error;
    }
?> 
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ticket Confirmation</title>
    </head>
    <style>
        body {
             background-image: url('image/badminton.jpg');
         }
         
        .table {
             position: absolute;
           
             left: 40%;
             top: 40%;
             text-align: center;
             bottom: 37%;
             background: #A9A9A9;
             text-align: center;
         }
         
        .table td {
            color: white;
        }
         
        .table input[type = "submit"] {
             position: absolute;
             left: 40%;
             top: 105%;
         }
    </style>
    <body>
        
        <?php
            include('includes/navigation.php');
            $hideForm = false;
            
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            
                $event = strtoupper(trim($_GET['event']));

                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $event  = $con->real_escape_string($event);
                $sql = "SELECT * FROM event WHERE Event_name = '$event'";

                $price = "";
                if($result = $con->query($sql)){
                     if ($row = $result->fetch_object())
                    {
                        $event = $row->Event_name;
                        $price = $row->Price; 
                    }
                    else
                    {
                        echo '
                            <div class="error">
                            Opps. Record not found.
                            [ <a href="ticket-selling.php">Back to ticket selling</a> ]
                            </div>
                            ';

                        $hideForm = true;
                    }
                }
                   
               
                $con->close();
            }
            
            $id       = '';
            $studname = '';
            $qty      = '';
            $amount   = '';
            
            
            if (!empty($_POST)) {
                    $id       = strtoupper(trim($_POST['id']));
                    $studname = trim($_POST['studname']);
                    $event    = trim($_POST['event']);
                    $price    = trim($_POST['price']);
                    $qty      = trim($_POST['qty']);
                    $error = detectError();
                    $amount = ((int)$qty * (int)$price);
                    $ID = uniqid();

                    if (empty($error))
                    {
                        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                        $sql = '
                            INSERT INTO Ticket (StudentID, StudentName, Event, Quantity, Amount,ticket_id)
                            VALUES (?, ?, ?, ?, ?,?)
                        ';
                        $stm = $con->prepare($sql);
                        $stm->bind_param('sssiis', $id, $studname, $event, $qty, $amount,$ID);
                        $stm->execute();
                        if ($stm->affected_rows > 0)
                        {
                            printf('
                                <div class="info">
                                Thanks for joining our event. The total amount is RM%d.
                                [ <a href="ticket-selling.php">Back to list</a> ]
                                </div>',$amount);
                        }
                        else
                        {
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
        <?php if ($hideForm == false) : ?>
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
                            echo $error['id'] = unvalidateStudentID($id);
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
                        <?php echo $event ?>
                        <?php htmlInputHidden('event', $event) ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="price">Price :</label></td>
                    <td>
                        <?php echo $price ?>
                        <?php htmlInputHidden('price', $price) ?>
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
        <input type="submit" name="submit" value="Pay" class="pay" onclick="return confirm('Are you sure to pay for this?')"/>
            </table>
        </form>
        </div>
        <?php endif ?>
    </body>
    
</html>