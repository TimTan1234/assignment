<html>
    <head>
        <meta charset="UTF-8">
        <title>About Us</title>
         <?php
       include('includes/navigation.php');
       ?>
    </head>
    <style>
        header h1 {
            color: #003399;
            text-align: center;
        }

        #logo {
           width: 600px;
        }

        .block {
            font-size: 20px;
            background-color: #b3ffec;
            text-align: center;
            width: 50%;
            padding: 50px;
            border: 1px solid #ccc;
            margin-left: 595px;
            position: relative;
            bottom: 500px;

        }
    </style>
    <body>
        <header>
                <h1>About Us</h1>
        </header>
         
        <img src="image/badminton.jpg" id="logo" rel="stylesheet" />
        <div class="block">
            <p>
                We are a badminton club from TARUC KL branch and founded in 2017. Our badminton club was established to gather all the badminton lovers in our club to have fun and 
                improve their overall health together. Besides that, it also an opportunity to train students team spirit when competing with each other.
            </p>
            <p>
                We will hold some training or competitions form time to time. For example, we used to have training days to let our member can know each other and enhanced their 
                badminton skills through the training day. We have also held many competitions and society day in the past. Please feel free to participate our club event. Hope everyone
                likes our club.
            </p>
        </div>
    </body>
    
   <?php
    include('includes/footer.php');
?>

</html>