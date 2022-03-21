<html>
    <head>
        <meta charset="UTF-8">
        <title>Member List</title>
        <h1>Member List</h1>
    </head>
    <style>
        body {
             background-image: url('image/badminton.jpg');
         }
         
         .table {
             position: relative;
             left: 500px;
             top: 50px;
             text-align: center;
             bottom: 200px;
         }
         
         tr,td{
            color: white;
            background-color: #808080;
         }
         
         .submit {
             position: relative;
             top: 30px;
             right: 700px;
             text-align: center;
         }
    </style>
    <body>
        <?php
        include('includes/backnav.php');
        ?>
        <div class="table">
        <form action="" method="post">
        <table border="10" cellpadding="5" cellspacing="0">
            <tr>
                <th></th>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Gender</th>
                <th>Username</th>
                <th>Password</th>
                <th></th>
            </tr>
            <?php
                require_once('includes/helper.php');
                
                if (isset($_POST['delete']))
                    {
                        $checked = $_POST['checked'];

                        if (!empty($checked))
                        {
                            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                            foreach ($checked as $id)
                            {
                                $escaped[] = $con->real_escape_string($id);
                            }

                            $sql = "DELETE FROM Member WHERE StudentID IN ('" .
                                   implode("','", $escaped) . "')";

                            if ($con->query($sql))
                            {
                                printf('
                                    <strong>%d</strong> record(s) has been deleted.',
                                    $con->affected_rows);
                            }

                            $con->close();
                        }
                    }
                
                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $sql = "SELECT * FROM Member";
                
                if ($result = $con->query($sql))
                {
                    while ($row = $result->fetch_object())
                    {
                        printf('
                            <tr>
                            <td>
                                <input type="checkbox" name="checked[]" value="%s" />
                            </td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>
                                <a href="edit.php?id=%s">Edit</a> |
                                <a href="delete.php?id=%s">Delete</a>
                            </td>
                            </tr>',
                            $row->StudentID,
                            $row->StudentID,
                            $row->StudentName,
                            $GENDERS[$row->Gender],
                            $row->Username,
                            $row->Password,
                            $row->StudentID,
                            $row->StudentID);
                    }
                }
                printf('
                    <tr>
                    <td colspan="7">
                        Total %d member(s).
                        [ <a href="Memberupdate.php">Insert Member</a> ]
                    </td>
                    </tr>',
                    $result->num_rows);

                $result->free();
                $con->close();
            ?>
        </table>
        <div class="submit">
        <input type="submit" name="delete" value="Delete Selected"
           onclick="return confirm('This will delete all checked records.\nAre you sure?')" />
        </div>
        </form>
        </div>
       </body>
</html>