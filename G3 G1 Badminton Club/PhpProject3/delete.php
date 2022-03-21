<html>
    <head>
        <meta charset="UTF-8">
        <title>Delete Member List</title>
        <h1>Delete Member</h1>
    </head>
    <style>
        body {
             background-image: url('image/badminton.jpg');
         }
         
        .p {
             position: relative;
             right: 119px;
             top: 80px;
             text-align: center;
             bottom: 200px;
             color: red;
         }
         
         .table {
             position: absolute;
             left: 560px;
             top: 530px;
             text-align: center;
            
         }
         
         table {
            background-color: #808080;
            color: white;
         }
         
         .b input[type = "submit"] {
            position: absolute;
            left: 38%;
            top: 100%;
        }
         
        .b input[type="button"] {
            position: absolute;
            left: 42%;
            top: 100%;
        }
    </style>
    <body>
          <?php
          include('includes/backnav.php');
        ?>
        <?php 
            require_once('includes/helper.php');
            
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
                    printf('
                        <div class="p">
                        <p>
                            Are you sure you want to delete the following member?
                        </p>
                        </div>
                        <div class="table">
                        <form class="box" action="" method="post">
                        <table border="5" cellpadding="5" cellspacing="0">
                         
                            <tr>
                                <td>Student ID :</td>
                                <td>%s</td>
                            </tr>
                            <tr>
                                <td>Student Name :</td>
                                <td>%s</td>
                            </tr>
                            <tr>
                                <td>Gender :</td>
                                <td>%s</td>
                            </tr>
                            <tr>
                                <td>Username :</td>
                                <td>%s</td>
                            </tr>
                            <tr>
                                <td>Password :</td>
                                <td>%s</td>
                            </tr>
                        </table>
                        </form>
                        </div>
                        <div class="b">
                        <form action="" method="post">
                            <input type="hidden" name="id" value="%s" />
                            <input type="hidden" name="studname" value="%s" />
                            <input type="submit" name="yes" value="Yes" />
                            <input type="button" value="Cancel"
                                   onclick="location=\'member-list.php\'" />
                        </form>
                        </div>',
                        $id, $studname, $GENDERS[$gender], $name, $password,
                        $id, $studname);
                }
                else
                {
                    echo '
                        <div class="error">
                        Opps. Record not found.
                        [ <a href="member-list.php">Back to list</a> ]
                        </div>
                        ';
                }

                $result->free();
                $con->close();
            } 
            else
            {
                $id   = strtoupper(trim($_POST['id']));
                $studname = trim($_POST['studname']);

                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $sql = '
                    DELETE FROM Member
                    WHERE StudentID = ?
                ';
                $stm = $con->prepare($sql);
                $stm->bind_param('s', $id);
                $stm->execute();
                if ($stm->affected_rows > 0)
                {
                    printf('
                        <div class="info">
                        Student <strong>%s</strong> has been deleted.
                        [ <a href="member-list.php">Back to list</a> ]
                        </div>',
                        $studname);
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
    </body>
</html>