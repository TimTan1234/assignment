<?php
   require_once("includes/AGMhelper.php");
   function detectInputError(){
        global $name, $genders,$username,$studID,$pass;
        
        $error = array();
        
        if ($genders == null) {
        $error['gender'] = printf('<script>alert("Gender should not be empty")</script>');
    } 

    if ($name == null) {
        $error['name'] = printf('<script>alert("Name should not be empty")</script>');
    } else if (strlen($name) > 20) {
        $error['name'] = printf('<script>alert("Your name is too long. It must be less than 30 characters.")</script>');
    } else if (!preg_match('/^[A-Za-z\s]+$/', $name)) {
        $error['name'] = printf('T<script>alert("Name should only contain character and whitespace")</script>');
    }

    if ($pass == null) {
        $error["pass"] = printf('<script>alert("Please enter password.")</script>');
    } else if (strlen($pass) < 6 || strlen($pass) > 15) {
        $error["pass"] = printf('<script>alert()"Password must between 5 to 15 character."</script>');
    } else if (!preg_match('/^\w+$/', $pass)) {
        $error["pass"] = printf('<script>alert("Password must contain only alphabet, digit and underscore.")</script>');
    }

    if ($username == null) {
        $error["username"] = printf('<script>alert("Please enter username.")</script>');
    } else if (strlen($username) > 20) {
        $error["username"] = printf('<script>alert("Username must not be more than 20 letters.")</script>');
    }

    if ($studID == null) {
        $error["studID"] = printf('<script>alert("Please enter student id.")</script>');
    } else if (!preg_match('/^\d{7}$/', $studID)) {
        $error["studID"] = printf('<script>alert("Invalid format student id. Format: 9999999.")</script>');
    }
    
    return $error;
}

?>
<html>
    <head>
        <title>Member Update</title>
    </head>
    <style>
        .trans_border {
    width: 1000px;
    height: 1000px;
    margin: auto;
    margin-top: 3%;
    text-align: center;
    border: 20px double rgba(0, 0, 0, .4);
    background: rgba(0, 0, 0, .4);
    background-clip: padding-box;
    border-radius: 5px;
    padding: 5px;
}

table,td,th{
    line-height: 20px;
    border: 2px solid white;
    border-collapse: collapse;
   
    
}

table{
    left: 60px;
     position: relative;
}

.bad{
    position: relative;
    right: 10px;
    width: 150px;
}

.submit{
    position: relative;
    top: 10px;
}

.title{
    float: right;
    position: relative;
    bottom: 100px;
    right: 700px;
}
    </style>
    <body>
        <?php
        session_start();
       
        
        ?>
           
        <header>
             <img src="image/badminton.jpg"  class="bad" alt="badminton">
                  
        </header>
       
           <?php
           include('includes/backnav.php');
           ?>
       <h1 class="title">Add Member</h1>
            <?php
        $amount = '';
        $row = 0;
        ?>
             <div class="trans_border">
        <form action=" " method="post">
            Enter amount that you want to add:<input type="number" name="amount" value="amount" min="1">
               <input type="submit" name="enter" value="Enter" />
        </form>
              <form action=" " method="post">
               <?php
                if (isset($_POST['enter'])) 
        {
            // Trim unwanted whitespaces.
            $amount = trim($_POST['amount']);
        }
         $gender   = '';
               for ($row=1; $row <= $amount; $row++) {
                   printf('
            <table cellspacing="0" cellpadding="5">
                <tr>
                    <th>
                        <label for="studname">Student Name:</label>
                    </th>
                     <th>
                        <label for="id">Student ID:</label>
                    </th>
                    
                 
                     <th><label for="gender">Gender :</label></th>
                    
                      <th>
                        <label for="ids">Username:</label>
                    </th>
                     <th>
                        <label for="password">Password:</label>
                    </th>

                </tr>
                <tr>
                      <td>
                       <input type="text" name="studname[]">
                    </td>
                   
                    <td>
                       <input type="text" name="id[]">
                    </td> 
                   
                   
                  <td>
                          <select id="cars" name="gender[]">
                              <option value=""></option>
                              <option value="M">Male</option>
                              <option value="F">Female</option>
                              <option value="O">Other</option>
                          </select>
                    </td>
                       
                    <td>
                     <input type="text" name="names[]">
                    </td>
                                    <td>
                       <input type="text" name="password[]" >
                    </td>
     
                </tr>
            </table>
           
                           ');
                    if($row == $amount){
                   printf(' <input type="submit" name="go" value="Enter" class="submit"/>');
              }
               }

               ?>
                   <script>
                        if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
                    </script>
               
        </form>
            <?php
            if (isset($_POST['go'])) { 
           $studname = array("");
           $id = array("");
           $names = array("");
           $password = array("");
           $gender = array("");
           $i = 0;

                $studname = ($_POST['studname']);
                $id = ($_POST['id']);
                $names = ($_POST['names']);
                $gender = ($_POST['gender']);
                $password = ($_POST['password']);
                 
              
               
                foreach ($studname as $value) {
                         
              require_once('includes/database.php');
           
            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $name = $studname[$i];
        $studID = $id[$i];
        $username = $names[$i];
        $pass = $password[$i];
        $genders = $gender[$i];
        $i++;
        $error = detectInputError();

        if(empty($error)){
                
               
               
       
                $sql = '
                INSERT INTO member (StudentName, StudentID, Gender,Username, Password)
                VALUES (?, ?, ?, ?,?)
            ';
                $stm = $con->prepare($sql);
                $stm->bind_param('sssss', $name, $studID,$genders, $username, $pass);
                $stm->execute();
                
                if ($stm->affected_rows > 0) {
                    printf('<script>alert("Update successfully")</script>');
                    // Reset fields.
                } else {
                    printf('<script>alert("Error")</script>');
                }
            $stm->close();
            $con->close();
            }
                }
                }
        ?>
        </div>
    </body>
</html>
