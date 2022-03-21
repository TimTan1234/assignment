 <?php
  session_start();
             if (!empty($_POST)) {
            $id       = trim($_POST['id']);
            $password = trim($_POST['password']);
            $error    = detectError(); 
             if (empty($error))
                {
                 require_once('includes/database.php');
                 $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    $sql = "SELECT * FROM User WHERE ID = '$id' AND Password = '$password' ";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_object()) {
          $_SESSION['id'] = $_POST['id'];
 
        }
         header('Location: http://localhost/PhpProject3/Memberupdate.php');
    }
    else{
        printf('<script>alert("PLease check the ID and password")</script>');
    }
                
        
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


<?php
require_once("includes/AGMhelper.php");
$ids= 0;
 
 function detectError() {
        global $studname, $id, $gender, $name, $password, $confirm;
        
        $error = array();
        
        if ($id == null) {
            $error["id"] = 'Please enter student id.';
        }
        else if (!preg_match('/^\d{7}$/', $id)) {
            $error["id"] = 'Invalid format student id. Format: 9999999.';
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
        <title>Login</title>
        </head>
        <body>
             <style>
         body {
             background-image: url('image/badminton.jpg');
         }
         
         .in2{
            width: 300px;
            padding: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #444;
            text-align: center;
         }

        .in2 h1 {
            color: white;
            text-transform: uppercase;
            font-weight: 500;
        }

        .in2 input[type = "text"],.in2 input[type = "password"] {
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

        .in2 input[type = "text"]:focus,.in2 input[type = "password"]:focus {
            width: 280px;
            border-color: #2ecc71;
        }

        .in2 input[type = "submit"],.in2 input[type = "button"] {
            border: 0;
            background: none;
            display: block;
            margin: 20px auto;
            text-align: center;
            border: 2px solid #2ecc71;
            padding: 10px 40px;
            outline: none;
            color: white;
            border-radius: 24px;
            transition: 0.25s;
            cursor: pointer;
        }

        .in2 input[type = "submit"]:hover,.in2 input[type = "button"]:hover {
            background: #2ecc71;
        }

        .in2 a {
            color: white;
        }
         
        
        </style>
            <?php
             $id       = '';
             $password = '';
             $error['id']       = '';
             $error['password'] = '';
             ?>
        <div class="in2">
           
            <h1>Admin Login</h1>
            <form action="" method="post">
                <table>
                    <input type="text" name="id" placeholder="Member ID">
                    <?php if (isset($error['name']))?>
                    <input type="password" name="password" placeholder="Password">
                    <?php if (isset($error['name']))?>
                </table>
                 <input type="submit" name="submit" value="Submit" class="button" />
                    <input type="button" value="Cancel" class="button"
                   onclick="location='<?php echo $_SERVER['PHP_SELF']; ?>'"/>
            </form>
            </div>
        </body>
    
</html>