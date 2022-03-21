<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <title>Edit Register</title>
        
        <style>
            body{
                background-color: whitesmoke;
            }
            header{
                background-color: white;
            }
            
            nav{
                width: 15%;
                font-size: medium;
            }
   
            nav a{
                color: white;
                padding-top: 10px;
                padding-bottom: 10px;
                font-family: 'Trebuchet MS', Helvetica, sans-serif;
                width: 100%;
                display: table;
                text-align: center;
            }
            
            nav li{
                display: block;
            }
            
            nav a:link, nav:visited {
                text-decoration: none;
                background-color: #2b2b2b;
            }

            nav a:hover, nav a:active {
                color: black;
                background-color: #dedede;
            }   
            
            .currentEvent{
                font-size: large;
                font-family: Comic Sans MS;
                margin-bottom: 10px;
            }
            
            .edit{
                border: 4px solid black;
                width: 50%;
                margin-left: 30%;
                height: 650px;
                display: flex;
                background-color: white;
            }
            
            .editImg{
                border: 2px solid black;
                width: 30%;
                margin: 10px;
                height: 300px;
            }
            
            .editInfor{
                border: 2px solid black;
                width: 65%;
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
        </style>
        
        <?php
            function detectError()
    {
            global $id, $name, $phone, $gender, $email;
            $error = array();
        // name ///////////////////////////////////////////////////////////////////
                if ($name == null)
                {
                    $error["name"] = 'Please enter <strong>Student Name</strong>.';
                }
                else if (strlen($name) > 30) // Prevent hacks.
                {
                    $error["name"] = '<strong>Student Name</strong> must not more than 30 letters.';

                }
                else if (!preg_match('/^[A-Za-z @,\'\.\-\/]+$/', $name))
                {
                    $error["name"] = 'There are invalid letters in <strong>Student Name</strong>.';
                }
                
        // phone /////////////////////////////////////////////////////////////////
                if($phone == null)
                {
                    $error['phone'] = 'Plese enter <strong>Phone Number</strong>.';
                }
                else if (strlen($phone) > 12) // Prevent hacks.
                {
                    $error["phone"] = '<strong>Phone Number</strong> must not more than 12 digit.';

                }
                 else if (!preg_match("/^[01]{2}[0-9]{1}-[0-9]{8}$/", $phone))
                {
                     $error["phone"] = 'There are invalid Phone Number.<br/> Format = 012-34567890.';
                }
        // gender /////////////////////////////////////////////////////////////////
                if ($gender == null)
                {
                    $error["gender"] = 'Please select a <strong>Gender</strong>.';
                }
                else if (!array_key_exists($gender, getGenders())) // Prevent hacks.
                {
                    $error["gender"] = 'Invalid <strong>Gender</strong> code detected.';
                }
                
        //email
                 if($email == null)
                {
                    $error["email"] = 'Plese enter an <strong>Email Address</strong>.';
                }
                else if (strlen($email) > 30) 
                {
                    $error["email"] = 'Email Address must not more than 30 characters.';
                }
                else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
                {
                    $error["email"] = 'Invalid email address.';
                }
                
        return $error;
    
    }
        ?>
        
    </head>
    
        <?php
            require_once('includes/uploadhelper.php');
             require_once ('includes/database.php');
            
            $hideForm = false;
    
            // --> Retrieve Student record based on the passed StudentID.
            if ($_SERVER['REQUEST_METHOD'] == 'GET')
            {
                // Read query string --> Event_name
                $id = trim($_GET['id']);

                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $id  = $con->real_escape_string($id);
                $sql = "SELECT * FROM register WHERE Register_ID = '$id'";
                $result = $con->query($sql);
                if ($row = $result->fetch_object())
                {
                    $id        = $row->Register_ID;
                    $name      = $row->Student_name;
                    $phone    = $row->Phone_number;
                    $gender = $row->Gender;
                    $email = $row->Email;
                    $from = $row->Which_event;
                }
                else
                {
                    echo '
                        <div class="error">
                        Opps. Record not found.
                        [ <a href="RegisterList.php">Back to list</a> ]
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
                $id         =trim($_POSt['id']);
                $name      = trim($_POST['name']);
                $phone    = trim($_POST['phone']);
                $gender  = trim($_POST['gender']);
                $email = trim($_POST['email']);
                $from = trim($_POST['from']);
                // Validations:
                
                $error = detectError();
                if (empty($error))
                {
                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    $sql = '
                        UPDATE register
                        SET Student_name = ?, Phone_number = ?, Gender = ?, Email = ?
                        WHERE Student_name = ?
                    ';
                    $stm = $con->prepare($sql);
                    $stm->bind_param('sssss', $name, $phone, $gender, $email, $name);
                    if($stm->execute())
                    {
                        printf('
                            <div class="info">
                            Student <strong>%s</strong> has been updated.
                            [ <a href="RegisterList.php">Back to list</a> ]
                            </div>',
                            $name);
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

    
    <body>
        <header>
            <a><img src="image/Logo.png" alt="TARUC Badminton Club KL" width="150px;"/></a>            
        </header>
        
        <nav>
                <ul>
                    <li><a href="ListingEvent.php" id="eventBE">&#8592 Back</a></li>
                    <li><a href="ListingEvent.php" id="">Event Listing</a><li>
                    <li><a href="uploadEvent.php" id="UandD">Upload Event</a></li>
                    <li><a href="RegisterList.php" id="registerList">Register List</a></li>
                </ul>
        </nav>
        
        <div class="currentEvent">
            <h3>Edit Register:</h3>
        </div>
        
        <?php if ($hideForm == false) : // Hide or show the form.  ?>
    
            
            <div class="editInfor">
            <form action="" method="post">
                <table cellpadding="10" cellspacing="0">
                    <tr>
                        <td><label for="id">Register ID:</label></td>
                        <td>
                            <?php echo $id ?>
                            <?php htmlInputHidden('id',$id) // Hidden field. ?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td><label for="name">Student Name:</label></td>
                        <td>
                            <?php htmlInputText('name', $name, 30) ?>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="phone">Phone Number:</label></td>
                        <td>
                            <?php htmlInputText('phone', $phone, 50) ?>
                        </td>
                    </tr>
                    <tr>
                        <td><laber for="gender">Gender :</laber></td>
                        <td>
                            <?php htmlRadioList("gender", getGenders(), $gender) ?>
                        </td>
                    </tr>
                    <tr>
                        <td><laber for="email">Email :</laber></td>
                        <td>
                            <?php htmlInputText('email', $email, 50)?>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="from">Which Event :</label></td>
                        <td>
                            <?php echo $from ?>
                            <?php htmlInputHidden('from', $from) // Hidden field. ?>
                        </td>
                    </tr>
                </table>
                <br />
                <input type="submit" name="update" value="Update" />
                <input type="button" value="Cancel" onclick="location='RegisterList.php'" />
            </form>
                   </div>
        </div>

        <?php endif ?>
               
              
        <footer></footer>
        
    </body>
    
</html>