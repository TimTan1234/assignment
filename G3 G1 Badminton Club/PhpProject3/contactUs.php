<?php
require_once("includes/AGMhelper.php");

function detectInputError() {
    global $gender, $name, $phone, $comments, $email;
    $error = array();

    if ($gender == null) {
        $error['gender'] = printf('<script>alert("Gender should not be empty")</script>');
    } else if (!preg_match('/^[MF]$/', $gender)) {
        $error['gender'] = printf('<script>alert("Gender is either Male or Female")</script>');
    }

    // name 
    if ($name == null) {
        $error['name'] = printf('<script>alert("Name should not be empty")</script>');
    } else if (strlen($name) > 20) {
        $error['name'] = printf('<script>alert("Your name is too long. It must be less than 30 characters.")</script>');
    } else if (!preg_match('/^[A-Za-z\s]+$/', $name)) {
        $error['name'] = printf('T<script>alert("Name should only contain character and whitespace")</script>');
    }

    // phone
    if ($phone == null) {
        $error['phone'] = printf('<script>alert("Phone number should not be empty")</script>');
    } else if (!preg_match("/^[01]{2}[1-9]{1}[0-9]{3}[0-9]{4}$/", $phone)) {
        $error['phone'] = printf('<script>alert("Phone number should enter in format 999-999-9999. Must start with 01.")</script>');
    }

    //comments
    if ($comments == null) {
        $error['comments'] = printf('<script>alert("Comment should not be empty")</script>');
    } else if (strlen($comments) > 150) {
        $error['comments'] = printf('<script>alert("Your comment is too long. It must be less than 150 characters.")</script>');
    } else if (!preg_match('/^[a-zA-Z0-9\s]+$/',$comments)) {
        $error['comments'] = printf('<script>alert("Comments must contain only alphabet and digit.")</script>');
    }

    //email
    if (strlen($email) > 30) {
        $error["email"] = printf('<script>alert("Email Address must not more than 30 characters.")</script>');
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error["email"] = printf('<script>alert("Invalid email address.")</script>');
    }
    return $error;
}
?>

<html>

<head>
    <meta charset="utf-8">
    <title>Contact Us</title>
      
</head>

<body>
    <style>
        html{
            background-color: white;
        }
        
        
        .bad {
            height: 40%;
            position: relative;
            left: 15px;
          }

        .logo{
            float: left;
            font-size: 30px;
            color: rgba(11, 11, 151, 0.842);
            font-style: italic;
            font-family: Trebuchet MS;
            position: relative;
            top: 15px;
            font-weight: bolder;
        }

        .ques{
            position: relative;
            bottom: 80px;
            font-size: 60px;
            background-color: rgb(132, 194, 235);
            width: 1498px;
            height: 130px;
            text-align: center;
            padding-top: 42px;
        }

        .phone{
            height: 20px;
            position: relative;
            bottom: 40px;
            left: 90px;
        }
        
        body {
            font-family: Arial;
            font-size: 15px;
        }
        
        /*frequently asked questions*/
         .questions {
            position: relative;
            top:5px;
            background-color: #777;
            color: white;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
          }

          .active, .questions:hover {
            background-color: #555;
          }
          
          .questions:after {
            content: '\002B';
            color: white;
            font-weight: bold;
            float: right;
            margin-left: 5px;
          }
          
          .active:after {
            content: "\2212";
          }
          
          .contents {
            padding: 0 18px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
            background-color: #f1f1f1;
          }
        
        /*four boxes*/
        * {
          box-sizing: border-box;
         
           }
           
           a{
                color: white;
           }
   
          /*location*/
         .location{
          padding: 16px;
          text-align: center;
          background-color: #444;
          color: white;
          height:300px;
         }
         
         .location1{
             height: 60%;
             width: 90%;
         }
         
         .text-block1{
           float: left;
           width: 25%;
           padding: 0 5px;
           position: relative;
           top: 40px;
           
         }
         
         /* phone number*/
          .number{
          padding: 16px;
         text-align: center;
         background-color: #444;
         color: white;
         height:300px;
         }
         
         .text-block2{
           float: left;
           width: 25%;
           padding: 0 5px;
            position: relative;
           top: 40px;
           height: 400px;
         }
         
         /*email*/
          .text-block4{
           float: left;
           width: 25%;
           padding: 0 5px;
            position: relative;
           top: 40px;
         }
         
         .email{
          padding: 16px;
         text-align: center;
         background-color: #444;
         color: white;
         height:300px;
         }
         
         .gmail{
             height: 100px;
         }
         
         /*whatapp and facebook*/
          .text-block5{
           float: left;
           width: 25%;
           padding: 0 5px;
           position: relative;
           top: 40px;
         }

         .communication{
         padding: 16px;
         text-align: center;
         background-color: #444;
         color: white;
         height:300px;
         }
         
       
         
         /*feedback*/
         .feedback{
            border-style: outset;
            width: 1500px;
            padding-left: 10px;
            text-align: center;
            background-color: #444;
            color: white;
         }
         
         .text-block3{
            position: relative;
            bottom: 100px;
            text-align: center;
         }
         
         table{
             height:200px;
             position: relative;
             left:570px;
             color: white;
             top:5px;
         }

         .title{
             border-bottom: 1px solid black;
             text-align: center;
         }
         
         .button{
             position: relative;
             top: 2px;
         }
        
       
        
        hr {
            background-color: rgba(0, 0, 0, 0.555);
            height: 2px;
            position: relative;
            margin-top: 0%;
        }
    
       
          
        
    </style>
    <header style="height: 325px;">
       <?php
      
           
       
       include('includes/navigation.php');
       ?>

        <img src="image/badminton.jpg"  class="bad" alt="badminton">
        <h1 class="logo">Badminton Club</h1>
        <h2 class="ques">QUESTION</h2>
        
    </header>

    <button type="button" class="questions">Who are we?</button>
    <div class="contents">
        <p>We are TARUC badminton club</p>
    </div>


    <button type="button" class="questions">What event we held before?</button>
    <div class="contents">
        <br/>
        <li>Baminton competion 2018</li>
        <li>Society Day</li>
        <li>Fund Raisings</li>
    </div>


    <button type="button" class="questions">How to contact us?</button>
    <div class="contents">
        <p>Our contact is just below.Check it out!!!</p>
    </div>


</div>
<script>
var coll = document.getElementsByClassName("questions");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}
</script>

<div class="content">
    <div class="text-block1">
        <div class="location">
            <h3>Location</h3>
            <img src="image/location.PNG" class="location1">
            <p><a href="https://www.google.com/maps/search/tarc/@3.2168267,101.7285336,17z/data=!3m1!4b1">Click Here!!!</a>
        </div>
    </div>

    <div class="text-block2">
        <div class="number">
            <h4>Contact Us</h4>
            <p>Society number:</p>
            <p>Thean Ken Wah: <a href="tel: +016-62659996"> 016-62659996</a></p>
            <p>Loo Jun Hui: <a href="tel: +011-28164420"> 011-28164420</a></p>
        </div>
    </div>

    <div class="text-block4">
        <div class="email">
            <h3>Email</h3>
            <p><a href="mailto:badmimton@tarc.edu.my">Click Here!</a></p>
            <img src="image/gmail.jfif" class="gmail">
        </div>
    </div>

    <div class="text-block5">
        <div class="communication">
            <h3>Whatsapp</h3>
            <p>Thean Ken Wah: <a href="tel: +016-62659996"> 016-62659996</a></p>
            <h3>Facebook</h3>
            <p><a href="https://www.facebook.com/badmintonclubtaruckl">Click Here!!!</a>
        </div>
    </div>
</div>
        
          
                <div class="text-block3">
                    <form  action=" " method="post">
                    <h4>Feedback</h4>
                    <?php
            $name     = '';
            $phone    = '';
            $gender   = '';
            $email    = '';
            $error['name']    = '';
            $error['phone']   = '';
            $error['gender']    = '';  
            $error['email']    = '';
            ?>
                    <div class="feedback">
                        <table cellspacing="0" cellpadding="5">
                            <tr>
                                <td><p class="title"">Personal Information</p></td>
                            </tr>
                            <tr>
                    <td><label for="name">Name :</label></td>
                   <td>
                        <?php htmlInputText('name', $name, 30) ?>
                    </td>
                    <td>
                        <?php if (isset($error['name']))?>
                    </td>
                </tr>
    
                 <tr>
                    <td><label for="gender">Gender :</label></td>
                    <td>
                        <?php htmlRadioList("gender", getGenders(), $gender) ?>
                    </td>
                    <td>
                        <?php if (isset($error['gender']))?>
                    </td>
                </tr>
                
                <tr>
                    <td><label for="phone">Mobile Phone :</label></td>
                     <td>
                        <?php htmlInputTel('phone', $phone, 12)?>
                    </td>
                    <td>
                        <?php if (isset($error['phone']))?>
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
                    <p> We welcome every member write feedback to us.  </p>
                    <textarea name="comments" id="commented" placeholder="Enter Comments(<150)"></textarea>
                    <br/>
                    <input type="submit" name="submit" value="Submit" class="button" />
                    <input type="button" value="Cancel" class="button"
                   onclick="location='<?php echo $_SERVER['PHP_SELF']; ?>'"/>
                    <script>
                        if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
                    </script>
                    <p>You can also visit our <a href="FAQ.php">FAQ </a>page !</p>
                     </form>
                     <?php
             if ($_SERVER["REQUEST_METHOD"] == "POST") 
             {
          
             if(isset($_POST['gender']))
                {
                    $gender   = trim($_POST['gender']);
                }
                else
                {
                    $gender = '';
                }
            $name   = trim($_POST['name']);
            $phone  = trim($_POST['phone']);
            $email    = trim($_POST['email']);
            $comments = trim($_POST['comments']);
            $error = detectInputError();
            $ID = uniqid();
             
            if (empty($error)) 
            {
                printf('<script>alert("Submit successfully")</script>');
                $to = $email;
                $subject = 'Feedback On Our Website';    
                $message =  "Thank you for choosing our website. We will review our comment as soon as possible. We hope you can provide more feedback on the future.
                    
                             Regards
                             Tan Yi Nuo
                             Adminstrator of website
                             tanyn-wm20@student.tarc.edu.my";
                $headers = 'From noreply@badmintonclub.tarc.edu.my';

                mail($to, $subject, $message , $headers);
                include('includes/database.php');
                 $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                 $sql = '
                INSERT INTO feedback (CommentID,name, phone, email,comment)
                VALUES (?, ?, ?, ?,?)
            ';
                $stm = $con->prepare($sql);
                $stm->bind_param('sssss', $ID, $name, $phone,$email, $comments);
                $stm->execute();
                
                if ($stm->affected_rows > 0) {
                    printf('<script>alert("Update successfully")</script>');
                    // Reset fields.
                } else {
                    printf('<script>alert("Error")</script>');
                }
            $stm->close();
            $con->close();
                
                $name = $phone = $gender = $email = $comments = null;
            }
            }
            ?>
                    
                    </div>
            </div>
        </div>

   
   <?php
    require_once('includes/footer.php');
?>



    
</body>

</html>

