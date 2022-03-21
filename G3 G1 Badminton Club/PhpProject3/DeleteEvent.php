<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <title>Delete Event</title>
        
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
                $event = trim($_GET['event']);

                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $event  = $con->real_escape_string($event);
                $sql = "SELECT * FROM event WHERE Event_name = '$event'";
                $result = $con->query($sql);
                if ($row = $result->fetch_object())
                {
                    // Record found. Read field values.
                    $event      = $row->Event_name;
                    $date    = $row->Date;
                    $GT  = $row->Gathering_time;
                    $venue = $row->Venue;
                    $RF     = $row->Registration_fees;
                    $CI    = $row->Category_included;
                    $DL  = $row->Deadline;
                    $BTBC = $row->Benefit;
                    $attention = $row->Attention;
                    printf('
                        <p>
                            Are you sure you want to delete the following Event?
                        </p>
                        <table border="1" cellpadding="5" cellspacing="0">
                            <tr>
                                <td>Event Name :</td>
                                <td>%s</td>
                            </tr>
                            <tr>
                                <td>Date :</td>
                                <td>%s</td>
                            </tr>
                            <tr>
                                <td>Gathering Time :</td>
                                <td>%s</td>
                            </tr>
                            <tr>
                                <td>Venue :</td>
                                <td>%s</td>
                            </tr>
                            <tr>
                                <td>Registration Fees :</td>
                                <td>%s</td>
                            </tr>
                            <tr>
                                <td>Category Included :</td>
                                <td>%s</td>
                            </tr>
                            <tr>
                                <td>Deadline Of Registration :</td>
                                <td>%s</td>
                            </tr>
                            <tr>
                                <td>Benefit To Become Committee :</td>
                                <td>%s</td>
                            </tr>
                            <tr>
                                <td>Attention :</td>
                                <td>%s</td>
                            </tr>
                        </table>
                        <form action="" method="post">
                            <input type="hidden" name="event" value="%s" />
                            <input type="hidden" name="date" value="%s" />
                            <input type="hidden" name="GT" value="%s" />
                            <input type="hidden" name="venue" value="%s" />
                            <input type="hidden" name="RF" value="%s" />
                            <input type="hidden" name="CI" value="%s" />
                            <input type="hidden" name="DL" value="%s" />
                            <input type="hidden" name="BTBC" value="%s" />
                            <input type="hidden" name="attention" value="%s" /><br>
                            <input type="submit" name="yes" value="Yes" />
                            <input type="button" value="Cancel"
                                   onclick="location=\'ListingEvent.php\'" />
                        </form>',
                        $event, $date, $GT, $venue, $RF, $CI, $DL, $BTBC, $attention,
                        $event, $date, $GT, $venue, $RF, $CI, $DL, $BTBC, $attention);
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
                $event      = trim($_POST['event']);
                //$date    = trim($_POST['date']);
                $GT  = trim($_POST['GT']);
                $venue = trim($_POST['venue']);
                $RF = trim($_POST['RF']);
                $CI = trim($_POST['CI']);
                //$DL = trim($_POST['DL']);
                $BTBC = trim($_POST['BTBC']);
                $attention = trim($_POST['attention']);
                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                // SELECT * FROM
                // INSERT INTO
                // UPDATE TABLE
                // DELETE FROM

                $sql = '
                    DELETE FROM event
                    WHERE Event_name = ?
                ';
                $stm = $con->prepare($sql);
                $stm->bind_param('s', $event);
                $stm->execute();
                if ($stm->affected_rows > 0)
                {
                    printf('
                        <div class="info">
                        Event <strong>%s</strong> has been deleted.
                        [ <a href="ListingEvent.php">Back to list</a> ]
                        </div>',
                        $event);
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