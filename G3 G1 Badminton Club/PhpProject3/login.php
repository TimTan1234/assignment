<?php
session_start();
require_once('includes/helper.php');
    
if (isset($_POST['submit'])) {

    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    $idipt = $_POST['id'];
    $passwordipt = $_POST['password'];

    $sql = "SELECT StudentID,Password FROM member WHERE StudentID = '$idipt' AND Password = '$passwordipt' ";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_object()) {
            $_SESSION['id'] = $row->StudentID;
            $_SESSION['studname'] = $row->Studname;
            $_SESSION['gender'] = $row->Gender;
            $_SESSION['name'] = $row->Username;
            $_SESSION['password'] = $row->Password;

            header('location: Home.php');
        }
       
       
    }
     if (empty($idipt)) {
        $id_error = "Please enter Student ID";
         
    } 
    else {
        $idipt = '';
        
        $id_error = "Invalid format student id. Format: 9999999.";
        
    }
    if (empty($passwordipt)) {
         $password_error = "Please enter Password"; 
    }
    else {
        $passwordipt = '';
        $password_error = "Invalid Password";
    }
    $con->close();
    die();
}
?>
<html>
    <?php
        $id = "";
        $password = "";
    ?>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <style>
        body {
            margin: 0;
            padding: 0; 
            background-image: url('image/badminton.jpg');
        }
         
        .box {
            width: 300px;
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

        .box input[type = "text"],.box input[type = "password"] {
            border: 0;
            background: none;
            display: block;
            margin: 20px auto;
            text-align: center;
            border: 2px solid #3498db;
            padding: 14px 10px;
            width: 200px;
            outline: none;
            color: white;
            border-radius: 24px;
            transition: 0.25s;
        }

        .box input[type = "text"]:focus,.box input[type = "password"]:focus {
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

        .box a {
            color: white;
        }

        .box a[name = "register"] {
            color: gold;
        }
        
        .alert {
            color: white;
        }
    </style>
    <body>
         <?php
            include('includes/newNavigation.php');
           
        ?>
        <form class="box" action="" method="post">
            
            <h1>Login</h1>
            <input type="text" name="id" placeholder="Student ID" value="<?php echo $id ?>">
             <?php
                if (isset($id_error)) {
                    echo "<div class='alert'>$id_error</div>";
                }
            ?>
            <input type="Password" name="password" placeholder="Password" value="<?php echo $password ?>">
            <?php
                if (isset($password_error)) {
                    echo "<div class='alert'>$password_error</div>";
                }
            ?>
            <input type="submit" name="submit" value="Login">
            <a>No account?</a> <a name ="register" href="register.php">Register</a>
        </form>
    </body>
</html>