<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <title>Edit Event</title>
        
        <style>
            body{
                background-color: whitesmoke;
            }
            header{
                background-color: white;
            }
            
         
            .title{
                font-size: large;
                font-family: Comic Sans MS;
                margin-bottom: 10px;
            }
            
            .edit{
                border: 4px solid black;
                width: 40%;
                margin-left: 30%;
                height: 650px;
                display: flex;
                background-color: white;
            }
            
            .editInfor{
                border: 2px solid black;
                width: 100%;
                margin: 10px;
            }
            
            .editInfor form{
                margin: 5px;
                font-family: Comic Sans MS;
                font-size: 15px;
            }
            
            .save{
                margin-left: 400px;
            } 
            
            footer{
                margin-top: 20px; 
                background: #2b2b2b;
                padding: 20px;
            }
            
            strong{
                color: red;
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
        
        <div class="title">
            <h3>Edit Event:</h3>
          
            <?php
            require_once('includes/uploadhelper.php');
            require_once('includes/database.php');
            
            $hideForm = false;
    
            // --> Retrieve Student record based on the passed StudentID.
            if ($_SERVER['REQUEST_METHOD'] == 'GET')
            {
                // Read query string --> Event_name
                $event = trim($_GET['event']);

                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $event  = $con->real_escape_string($event);
                $sql = "SELECT * FROM event WHERE Event_name = '$event'";
                $result = $con->query($sql);
                if ($row = $result->fetch_object())
                {
                    $event      = $row->Event_name;
                    $date    = $row->Date;
                    $GT = $row->Gathering_time;
                    $venue = $row->Venue;
                    $RF = $row->Registration_fees;
                    $CI = $row->Category_included;
                    $DL = $row->Deadline;
                    $BTBC = $row->Benefit;
                    $attention = $row->Attention;
                }
                else
                {
                    echo '
                        <div class="error">
                        Opps. Record not found.
                        [ <a href="ListingEvent.php">Back to list</a> ]
                        </div>
                        ';

                    $hideForm = true; // Flag, "true" to hide the form.
                }
                $result->free();
                $con->close();
            }

            // --> Update the record.
            else
            {
                $event      = trim($_POST['event']);
                $date    = trim($_POST['date']);
                $GT  = trim($_POST['GT']);
                $venue = trim($_POST['venue']);
                $RF = trim($_POST['RF']);
                $CI = trim($_POST['CI']);
                $DL = trim($_POST['DL']);
                $BTBC = trim($_POST['BTBC']);
                $attention = trim($_POST['attention']);
                // Validations:
                
                $error['date']    = validateDate($date);
                $error['GT']  = validateGatheringTime($GT);
                $error['venue'] = validateVenue($venue);
                $error['RF'] = validateRegistrationFees($RF);
                $error['CI'] = validateCategoryIncluded($CI);
                $error['DL'] = validateDate($DL);
                $error['BTBC'] = validateBenefit($BTBC);
                $error['attention'] = validateAttention($attention);
                $error = array_filter($error); // Remove null values.
                
                
                
                if (empty($error))
                {
                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    $sql = '
                        UPDATE event
                        SET Date = ?, Gathering_time = ?, Venue = ?, Registration_fees = ?, Category_included = ?,
                            Deadline = ?, Benefit = ?, Attention = ?
                        WHERE Event_name = ?
                    ';
                    $stm = $con->prepare($sql);
                    $stm->bind_param('sssssssss', $date, $GT, $venue, $RF, $CI, $DL, $BTBC, $attention, $event);
                    if($stm->execute())
                    {
                        printf('
                            <div class="info">
                            Event <strong>%s</strong> has been updated.
                            [ <a href="ListingEvent.php">Back to list</a> ]
                            </div>',
                            $event);
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
                else
                {
                    // Validation failed. Display error message.
                    echo '<ul class="error">';
                    foreach ($error as $value)
                    {
                        echo "<li>$value</li>";
                    }
                    echo '</ul>';
                }
            }
            ?>
          
        </div>
        
        <?php if ($hideForm == false) : // Hide or show the form.  ?>
    
        <div class="edit">
            
            
            <div class="editInfor">
            <form action="" method="post">
                <table cellpadding="10" cellspacing="0">
                    <tr>
                        <td><label for="event">Event Name :</label></td>
                        <td>
                            <?php echo $event ?>
                            <?php htmlInputHidden('event', $event) // Hidden field. ?>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="date">Date :</label></td>
                        <td>
                            <?php htmlInputText('date', $date, 50) ?>
                        </td>
                    </tr>
                    <tr>
                        <td><laber for="GT">Gathering Time:</laber></td>
                        <td>
                            <?php htmlInputText('GT', $GT, 50) ?>
                        </td>
                    </tr>
                    <tr>
                        <td><laber for="venue">Venue :</laber></td>
                        <td>
                            <?php htmlInputText('venue', $venue, 50)?>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="RF">Registration Fees :</label></td>
                        <td>
                            <?php htmlInputText('RF', $RF, 50) ?>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="CI">Category Included :</label></td>
                        <td>
                            <?php htmlInputTextArea('CI', $CI, 1000) ?>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="DL">Deadline for Registration :</label></td>
                        <td>
                            <?php htmlInputText('DL', $DL, 50) ?>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="BTBC">Benefit to become committees :</label></td>
                        <td>
                            <?php htmlInputTextArea('BTBC', $BTBC, 1000) ?>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="attention">Attention :</label></td>
                        <td>
                            <?php htmlInputTextArea('attention', $attention, 1000) ?>
                        </td>
                    </tr>
                </table>
                <br />
                <input type="submit" name="update" value="Update" />
                <input type="button" value="Cancel" onclick="location='ListingEvent.php'" />
            </form>
                   </div>
        </div>

        <?php endif ?>
               
              
        <footer></footer>
        
    </body>
    
</html>