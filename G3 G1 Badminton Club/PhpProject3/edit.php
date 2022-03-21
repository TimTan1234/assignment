<?php
require_once("includes/helper.php");
    
    function detectError() {
        global $studname, $gender, $name, $password;
        
        $error = array();
        
        if ($studname == null) {
            $error["studname"] = 'Please enter your student name.';
        }
        else if (strlen($studname) > 20) {
            $error["studname"] = 'Student name must not more than 20 letters.';
        }
        else if (!preg_match('/^[A-Za-z @,\'\.\-\/]+$/', $studname)) {
            $error["studname"] = 'There are some invalid letters in student name.';
        }
        
        if ($gender == null) {
            $error["gender"] = 'Please select a gender.';
        }
        else if (!array_key_exists($gender, getGenders())) {
            $error["gender"] = 'Invalid gender code detected.';
        }        
        if ($name == null) {
            $error["name"] = 'Please enter username.';
        }
        else if (!preg_match('/^[a-zA-Z0-9 _]+$/', $name)) {
            $error["name"] = 'Username must contain only alphabet and digit only.';
        }
        else if (strlen($name) > 20) {
            $error["name"] = 'Username must not be more than 20 letters.';
        }
        
        if ($password == null) {
            $error["password"] = 'Please enter password.';
        }
        else if (strlen($password) < 6 || strlen($password) > 15) {
            $error["password"] = 'Password must between 5 to 15 character.';
        }
        else if (!preg_match('/^\w+$/', $password)) {
            $error["password"] = 'Password must contain only alphabet, digit and underscore.';
        }
        
        return $error;
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Member List</title>
        <h1>Edit Member</h1>
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
            $sql = "SELECT * FROM Member WHERE StudentID = '$id'";

            $result = $con->query($sql);
            if ($row = $result->fetch_object())
            {
                $id       = $row->StudentID;
                $studname = $row->StudentName;
                $gender   = $row->Gender;
                $name     = $row->Username;
                $password = $row->Password;
            }
            else
            {
                echo '
                    <div class="error">
                    Opps. Record not found.
                    [ <a href="member-list.php">Back to list</a> ]
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
            $gender   = trim($_POST['gender']);
            $name     = trim($_POST['name']);
            $password = trim($_POST['password']);

            $error['studname'] = '';
            $error['gender']   = '';
            $error['name']     = '';
            $error['password'] = '';
            $error = array_filter($error);

            if (empty($error))
            {
                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $sql = '
                    UPDATE Member
                    SET StudentName = ?, Gender = ?, Username = ?, Password = ?
                    WHERE StudentID = ?
                ';
                $stm = $con->prepare($sql);
                $stm->bind_param('sssss', $studname, $gender, $name, $password, $id);
                if($stm->execute())
                {
                    printf('
                        <div class="info">
                        Student <strong>%s</strong> has been updated.
                        [ <a href="member-list.php">Back to list</a> ]
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
        <form action="" method="post">
            <table cellpadding="2" cellspacing="2">
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
                        <?php htmlInputText('studname', $studname, 20) ?>
                         <?php if(isset($error['studname']))  {
                            echo $error['studname'];
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Gender :</td>
                    <td>
                        <?php htmlRadioList('gender', $GENDERS, $gender) ?>
                        <?php if(isset($error['gender'])) { 
                            echo $error['gender'];
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="name">Username :</label></td>
                    <td>
                        <?php htmlInputText('name', $name, 20) ?>
                        <?php if(isset($error['name'])) {
                            echo $error['name'];
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td>
                        <?php htmlInputText('password', $password, 15) ?>
                        <?php if(isset($error['password'])) {
                            echo $error['password'];
                            }
                        ?>
                    </td>
                </tr>
            </table>
            <div class="submit">
            <input type="submit" name="update" value="Update" />
            <input type="button" value="Cancel" onclick="location='member-list.php'" />
        </div>
        </form>
        </div>
        <?php endif ?>
    </body>
</html>