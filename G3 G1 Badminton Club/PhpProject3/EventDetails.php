<?php
        require_once('includes/header.php');
          include('includes/navigation.php');
        require_once("includes/AGMhelper.php");
    
    function detectError()
    {
            global  $name, $phone, $gender, $email;
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
<head>
    <meta charset="UTF-8">
    <title>Event Details</title>

</head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
</script>

<script>
$(document).ready(function(){
    $('#slideToggle').click(function()
	{
		$('#Toggle').slideToggle();
	});
});</script>
<link type="text/css" href="css/MiniTournament.css" rel="Stylesheet" />

<style>
    .back a{
        color: black;
    }
    
    .back li{
        display: block;
        display: table-cell;
    }
    
    .back li a:link, .back li:visited {
        text-decoration: none;
        background-color: #ccccff;
    }

    .back li a:hover, .back li a:active {
        color: white;
        background-color: whire;
        /*text-shadow: 1px 1px white;*/
    }   

    .blank{
        margin: 100px;
    }
    
    #slideToggle{
        margin-left: 46%;
        margin-bottom: 10px;
        padding: 2px;
        border: 2px solid black;
        border-radius: 6px; 
        background-color: mintcream;
        cursor: pointer;
    }
    .register{
        margin: 20px auto;
        padding: 20px;
        width: 30%;
        height: 30%;
        border: 5px solid #b0b0b0;
        box-sizing: border-box;
        display: block;
        text-align: center;
        background-color: whitesmoke;
    }    
   
    .register form{
        display: inline-block;
        margin-left: auto;
        margin-right: auto;
        text-align: left;
    }
    
    .error strong{
        color: red;
    }
</style>

<ul class="back">
    <li><a href="Event.php" id="back">&#8592 Back To Event</li></a>
</ul>

        <?php
               require_once('includes/database.php');
               require_once('includes/database.php');
                
            // --> Retrieve Student record based on the passed StudentID.
            if ($_SERVER['REQUEST_METHOD'] == 'GET')
            {
                // Read query string --> Event_name
                $event = trim($_GET['event']);

                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $event  = $con->real_escape_string($event);
                $sql = "SELECT * FROM event WHERE Event_name = '$event'";
                $result = $con->query($sql);
                if ($result = $con->query($sql))
                {
                   $image = trim($_GET['image']);
                    while ($row = $result->fetch_object())
                    {
                        printf('<div class="event">
                                <img src="uploads/%s" alt="%s" width="430px" style="margin: 30px;"/>
                                
                                <p><b>%s</b><br><br><br><br>
                            
                                <b style="font-size: 25px">Date:</b>
                                <br> %s <br><br>
                                
                                <b style="font-size: 25px">Gathering time:</b>
                                <br> %s <br><br>
                                
                                <b style="font-size: 25px">Venue:</b>
                                <br> %s <br><br>
                                
                                <b style="font-size: 25px">Registration Fees:</b>
                                <br>%s<br><br>
                                
                                <b style="font-size: 25px">Category included :</b>
                                <br> %s <br><br>
                                
                                <b style="font-size: 25px">Deadlines for Registration:</b>
                                <br> %s <br><br>
                                
                                <b style="font-size: 25px">Benefit to become committees:</b>
                                <br> %s <br><br>
                                
                                <b style="font-size: 20px">‼‼Attention:</b><br>
                                %s
                                
                                </p>
                                </div>',
                                $image,
                                $row->Event_name,
                                $row->Event_name,
                                $row->Date,
                                $row->Gathering_time,
                                $row->Venue,
                                $row->Registration_fees,
                                $row->Category_included,
                                $row->Deadline,
                                $row->Benefit,
                                $row->Attention);
                    }
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
            

               
            ?>

<div class="blank"></div>

<a id="slideToggle">Register Form</a>
    <div id="Toggle"">
        
        <div class="register">
            <h1>Register Here :</h1>
                <?php                
                    
                    $name     = '';
                    $phone    = '';
                    $gender   = '';
                    $email    = '';
                   
                    $error['name']    = '';
                    $error['phone']   = '';
                    $error['gender']    = '';  
                    $error['email']     = '';

                    
                    
                    
                    if (!empty($_POST))
                    {
                        
                        $name     = trim($_POST['name']);
                        $phone    = trim($_POST['phone']);
                        if(isset($_POST['gender']))
                        {
                            $gender   = trim($_POST['gender']);
                        }
                        else
                        {
                            $gender = '';
                        }
                        $email    = trim($_POST['email']);
                        $error = detectError();

                        if (empty($error))
                        {
                               $from = 'Annual General Meeting';
                               $id = uniqid();
                               
                               $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                                        
                            $sql = '
                                INSERT INTO register ( Register_ID, Student_name, Phone_number, Gender, Email, Which_event)
                                VALUES (?, ?, ?, ?, ?, ?)
                            ';
                            $stm = $con->prepare($sql);
                            $stm->bind_param('ssssss', $id, $name, $phone, $gender, $email, $from);
                            $stm->execute();
                            if ($stm->affected_rows > 0)
                            {
                                printf('
                                    <div class="info">
                                    Student <strong>%s</strong> has Register Successfully.
                                    </div>',
                                    $name);
                                
                   
                                    $to = $email;
                                    $subject = 'Register For '.$from.'.';
                                    $message = "Student $name, you has successfully register for this event.
                                             
                                    If you have any question please contact
                                    Thean Ken Wah: 016-62659996
                                    or you can visit to our facebook page
                                    https://www.facebook.com/badmintonclubtaruckl.";

                                    $headers = 'From: Taruc Badminton Club';
                                    mail($to, $subject, $message, $headers);

                                    /*if($return)
                                    {
                                        echo "Email sent out";
                                    }
                                    else
                                    {
                                        echo "Email unable to send out.";
                                    }*/
                                

                                

                                // Reset fields.
                                $name = $phone = $gender = $email = null;

                            }
                            else
                            {
                                // Something goes wrong.
                                echo '
                                    <div class="error">
                                    Opps. Database issue. Record not inserted.
                                    </div>
                                    ';
                            }
                            $stm->close();
                            $con->close();
                        }
                        else
                        {
                            echo '<ul class="error">';
                            foreach ($error as $value)
                            {
                                echo "<li>$value</li>";
                            }
                            echo '</ul>';
                        }
                        
                        
                    }
                ?>


                <form action="" method="post">
                    <table cellspacing="0" cellpadding="5">
                        
                        
                        <tr>
                            <td><label for="name">Student Name :</label></td>
                            <td>
                                <?php htmlInputText('name', $name, 30) ?>
                            </td>
                            <td>
                                <?php if (isset($error['name']))?>
                            </td>
                        </tr>

                        <tr>
                            <td><label for="phone">Phone Number :</label></td>
                            <td>
                                <?php htmlInputTel('phone', $phone, 12)?>
                            </td>
                            <td>
                                <?php if (isset($error['phone']))?>
                            </td>
                        </tr>

                        <tr>
                            <td>Gender :</td>
                            <td>
                                <?php htmlRadioList("gender", getGenders(), $gender) ?>
                            </td>
                            <td>
                                <?php if (isset($error['gender']))?>
                            </td>
                        </tr>
                        
                        <tr>
                            <td><label for="email">Email Address :</label></td>
                             <td>
                                <?php htmlInputText('email', $email, 30) ?>
                            </td>
                            <td>
                                <?php if (isset($error['email']))?>
                            </td>
                        </tr>

                    </table>
                    <input type="submit" name="submit" value="Submit" />
                    <!-- JavaScript to reload the page. -->
                    <input type="button" value="Cancel"
                           onclick="location='<?php echo $_SERVER["PHP_SELF"] ?>'"/>
                </form>
    </div>

</div>

<?php
    require_once('includes/footer.php');
?>