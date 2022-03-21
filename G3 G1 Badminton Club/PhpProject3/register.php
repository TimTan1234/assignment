<?php 
    require_once("includes/helper.php");
    
    function detectError() {
        global $studname, $id, $gender, $name, $password, $confirm;
        
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
        
        if ($id == null) {
            $error["id"] = 'Please enter Student ID.';
        }
        else if (!preg_match('/^\d{7}$/', $id)) {
            $error["id"] = 'Invalid format Student ID. Format: 9999999.';
        }
        else if (isStudentIDExist($id)) {
            $error["id"] = 'This Student ID is already exist. Pls try again.';
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
        
        if ($confirm == null) {
            $error["confirm"] = 'Please enter confirm password.';
        }
        else if ($confirm != $password) {
            $error["confirm"] = 'Confirm password must be same with the password.';
        }
        
        return $error;
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
    </head>
    <style>
        body {
            margin: 0;
            padding: 0; 
            background-image: url('image/badminton.jpg');
        }
        .box {
            width: 500px;
            padding: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #444;
            text-align: center;
        }

        .box h1 {
            color: white;
            text-transform: uppercase;
            font-weight: 500;
        }

        .box td {
            color: white;
        }

        .box input[type = "text"],.box input[type = "password"] ,.box input[type = "radiolist"]{
            border: 0;
            background: none;
            display: block;
            margin: 10px right;
            text-align: center;
            border: 2px solid #3498db;
            padding: 14px 10px;
            width: 200px;
            outline: none;
            color: white;
            border-radius: 24px;
            transition: 0.25s;
        }

        .box input[type = "text"]:focus,.box input[type = "password"]:focus,.box input[type = "radiolist"]:focus {
            width: 280px;
            border-color: #2ecc71;
        }

        .box input[type = "submit"] {
            border: 0;
            background: none;
            display: block;
            margin: 20px auto;
            text-align: center;
            border: 2px solid #2ecc71;
            padding: 14px 40px;
            outline: none;
            color: white;
            border-radius: 24px;
            transition: 0.25s;
            cursor: pointer;
        }

        .box input[type = "submit"]:hover {
            background: #2ecc71;
        }
    </style>
    <body>
        <?php
            include('includes/newNavigation.php');
            
            $studname = '';
            $id       = '';
            $gender   = '';
            $name     = '';
            $password = '';
            $confirm  = ''; 
        
        if (!empty($_POST)) {
            $studname = trim($_POST['studname']);
            $id       = trim($_POST['id']);
            if(isset($_POST['gender']))
                {
                    $gender   = trim($_POST['gender']);
                }
                else
                {
                    $gender = '';
                }
            $name     = trim($_POST['name']);
            $password = trim($_POST['password']);
            $confirm  = trim($_POST['confirm']);
            $error    = detectError(); 
        if (empty($error)) {
            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $sql = '
                INSERT INTO Member (StudentName, StudentID, Gender, Username, Password)
                VALUES (?, ?, ?, ?, ?)
                ';
            $stm = $con->prepare($sql);
            $stm->bind_param('sssss', $studname, $id, $gender, $name, $password);
            $stm->execute();
            
            echo "<script>alert('Your account has been register successfully.'); location.replace('login.php')</script>";
            
        }
    }
    ?>
        <form class="box" action="" method="post">
            <h1>Register</h1>
            <table cellspacing="0" cellpadding="5">
                <tr>
                    <td>
                    <label for="studname">Student Name :</label>
                    </td>
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
                    <td>
                        <label for="id">Student ID:</label>
                    </td>
                    <td>
                        <?php htmlInputText('id', $id, 10) ?>
                    </td>
                    <td>
                        <?php if(isset($error['id'])) {
                            echo $error['id'] = validateStudentID($id);
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Gender:</td>
                    <td>
                        <?php htmlRadioList('gender', $GENDERS, $gender) ?>
                    </td>
                    <td>
                        <?php if(isset($error['gender'])) { 
                            echo $error['gender'];
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="name">Username:</label>
                    </td>
                    <td>
                        <?php htmlInputText('name', $name, 20) ?>
                    </td>
                    <td>
                        <?php if(isset($error['name'])) {
                            echo $error['name'];
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="password">Password:</label>
                    </td>
                    <td>
                        <?php htmlInputPassword('password', $password, 15) ?>
                    </td>
                    <td>
                        <?php if(isset($error['password'])) {
                            echo $error['password'];
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="confirm">Confirm Password:</label>
                    </td>
                    <td>
                        <?php htmlInputPassword('confirm', $confirm, 15) ?>
                    </td>
                    <td>
                        <?php if(isset($error['confirm'])) {
                            echo $error['confirm'];
                            }
                        ?>
                    </td>
                </tr>
            </table>
            <input type="submit" name="submit" value="Submit" />
        </form>
    </body>
</html>
