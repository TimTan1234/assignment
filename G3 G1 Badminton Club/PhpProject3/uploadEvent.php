<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <title>Upload Event</title>
        
        <style>
            body{
                background-color: whitesmoke;
            }
            header{
                background-color: white;
            }
   
            h3{
                font-size: large;
                font-family: Comic Sans MS;
                margin-bottom: 10px;
            }
            
            .upload{
                border: 4px solid black;
                width: 50%;
                margin-left: 30%;
                display: flex;
                background-color: white;
            }
            
            .uploadImg{
                width: 30%;
                margin: 10px;
                height: 300px;
            }
            
            .uploadInfor{
                border: 2px solid black;
                width: 65%;
                margin: 10px;
                font-family: Comic Sans MS;
                font-size: 15px;
            }
            
            .uploadInfor table{
                margin: 10px;
            }
           
            .save{
                margin-left: 400px;
            } 
            
            footer{
                margin-top: 20px; 
                background: #2b2b2b;
                padding: 20px;
            }
            
            .title{
                font-size: large;
                font-family: Comic Sans MS;
                margin-bottom: 10px;
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
        
       <!-- ------------------------------------------------------------------------ -->
        
       <?php
        include('includes/backnav.php');
        ?>
       
       <div class="title">
        <h3>Upload Event:</h3>
        
        <?php
            require_once('includes/uploadhelper.php');
            require_once('includes/database.php');
            
            //input
            $event = '';
            $date = '';
            $GT = '';
            $venue = '';
            $RF = '';
            $CI = '';
            $DL = '';
            $BTBC = '';
            $attention = '';
            $price = '';
            $status = '';
            
            if (!empty($_POST)) // Something posted back.
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
                $price = trim($_POST['price']);
                $status = trim($_POST['status']);
                
                // Validations.
                $error['event']      = validateEventName($event);
                $error['date']    = validateDate($date);
                $error['GT']  = validateGatheringTime($GT);
                $error['venue'] = validateVenue($venue);
                $error['RF'] = validateRegistrationFees($RF);
                $error['CI'] = validateCategoryIncluded($CI);
                $error['DL'] = validateDate($DL);
                $error['BTBC'] = validateBenefit($BTBC);
                $error['attention'] = validateAttention($attention);
                $error['price'] = validatePrice($price);
                $error['status'] = validateStatus($status);
                $error = array_filter($error); // Remove null values.
                
                // Check if $_FILES is set.
            if (isset($_FILES['file']))
            {
                $file = $_FILES['file'];
                $err = '';

                // If there is upload error.
                if ($file['error'] > 0)
                {
                    // Check the error code.
                    switch ($file['error'])
                    {
                        case UPLOAD_ERR_NO_FILE: // Code = 4.
                            $err = 'No file was selected.';
                            break;
                        case UPLOAD_ERR_FORM_SIZE: // Code = 2.
                            $err = 'File uploaded is too large. Maximum 1MB allowed.';
                            break;
                        default: // Other codes.
                            $err = 'There was an error while uploading the file.';
                            break;
                    }
                }
                else if ($file['size'] > 1048576)
                {
                    // Check the file size. Prevent hacks.
                    // 1MB = 1024KB = 1048576B.
                    $err = 'File uploaded is too large. Maximum 1MB allowed.';
                }
                else
                {
                    // Extract the file extension.
                    // Convert to lowercase for easy checking.
                    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

                    // Check the file extension.
                    if ($ext != 'jpg'  &&
                        $ext != 'jpeg' &&
                        $ext != 'gif'  &&
                        $ext != 'png')
                    {
                        $err = 'Only JPG, GIF and PNG format are allowed.';
                    }
                    else
                    {
                        // Everything OK, save the file.

                        // Create an unique ID and use it as file name.
                        $save_as = $event. '.' . $ext;

                        // Save the file.
                        move_uploaded_file($file['tmp_name'], 'uploads/' . $save_as);

                        printf('
                            <div class="info">
                            Image uploaded successfully.
                            </div>',);
                    }
                }
                
                
                if (empty($error)) // If no error.
                {
                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                                        
                    $sql = '
                        INSERT INTO event (Event_name, Date, Gathering_time, Venue, Registration_fees, Category_included,
                                            Deadline, Benefit, Attention, price, status)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                    ';
                    $stm = $con->prepare($sql);
                    $stm->bind_param('sssssssssss', $event, $date, $GT, $venue, $RF, $CI, $DL, $BTBC, $attention, $price, $status);
                    $stm->execute();
                    if ($stm->affected_rows > 0)
                    {
                        printf('
                            <div class="info">
                            Event <strong>%s</strong> has been inserted.
                            </div>',
                            $event);
                       

                        // Reset fields.
                        $event = $date = $GT = $venue = $RF = $CI = $DL = $BTBC = $attention = $price = $status = null;
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
                else // Input error detected. Display error message.
                {
                    echo '<ul class="error">';
                    foreach ($error as $value)
                    {
                        echo "<li>$value</li>";
                    }
                    echo '</ul>';
                }

            

                // Display error message.
                if ($err)
                {
                    echo '<div class="error">' . $err . '</div>';
                }
            }
            
        }
        ?>
       </div>
       
        <div class="upload">
                       
            
            <div class="uploadImg">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                    <input type="file" name="file" id="file" accept=".gif, .jpg, .jpeg, .png" /><br />
                
            </div>
            
            <div class="uploadInfor">
                
                    <table cellpadding="11" cellspacing="0">
                        <tr>
                            <td><label for="event">Event Name :</label></td>
                            <td>
                            <?php htmlInputText('event', $event, 50); ?>
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
                         
                         <tr>
                             <td><label for="price">Price :</label></td>
                             <td>
                                 <?php htmlInputInt('price', $price)?>
                             </td>
                         </tr>
                         
                         <tr>
                             <td><label for="status">Status :</label></td>
                             <td>
                                 <?php htmlInputText('status', $status, 50)?>
                             </td>
                         </tr>
                    </table>
                    
                    <input type="submit" value="Upload" />
                    <input type="reset" value="Reset" onclick="location='uploadEvent    .php'"/>
                    
               </form>
            </div>
                 
        </div>
        
        <footer></footer>
        
    </body>
    
</html>