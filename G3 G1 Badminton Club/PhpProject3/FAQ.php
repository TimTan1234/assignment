<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <title>FAQ</title>
        
        <style>
            header{
                background-image: url("image/wallpaper-badminton.jpg");
                background-size: 100%;
                height: 200px;
            }
            header h1{
                color: #444;
                font-family: Arial, Helvetica, sans-serif;
                position: relative;
                top: 70%;
                font-size: 50px;
                text-align: center;
            }
            
            .blank{
                margin: 80px;
            }
            
            .accordion {
                background-color: lightgrey;
                color: white;
                cursor: pointer;
                padding: 15px;
                width: 90%;
                border: none;
                text-align: left;
                outline: none;
                font-size: 15px;
                transition: 1s;
                margin-left: 5%;
            }

            .active, .accordion:hover {
                background-color: grey;
            }

            .accordion:after {
                content: '\002B';
                color: black;
                font-weight: bold;
                float: right;
                margin-left: 5px;
            }

            .active:after {
              content: "\2212";
            }

            .panel {
                width: 1317px;
                padding: 0 18px;
                background-color: lightgrey;
                margin-left: 5%;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.2s ease-out;
                font-size: medium;
                font-family: cursive;
            }
        </style>
        
    </head>
    
    <body>
        <?php
       include('includes/navigation.php');
       ?>

        <header>
        <h1>Frequently Asked Question</h1>
        </header>
    
    <div class="blank"></div>
    
        <button class="accordion">How to Register Account?</button>
        <div class="panel">
            <p>
                1. Visit to Register Account page.<br>
                2. Key in Personal Details.<br>
                3. Submit form<br>
                4. Register Successfully.
            </p>
        </div>

        <button class="accordion">How to Login Account?</button>
        <div class="panel">
            <p>
                1. You need to have a registered account.<br>
                2. Visit to Login Account page.<br>
                3. Key in Login details.<br>
                4. Click Login.<br>
                5. Login Successfully.
            </p>
        </div>

        <button class="accordion">How to Register an event?</button>
        <div class="panel">
            <p>
                1. Visit to event page.<br>
                2. Select a event.<br>
                3. In event details page scroll to find register form.<br>
                4. Key in Register details.<br>
                5. Submit Register form.<br>
                6. Register Successfully.
            </p>
        </div>
        
        <button class="accordion">Where is TARUC Badminton Club located?</button>
        <div class="panel">
            <p>
                TARUC Badminton Club is presently located at:<br>
                Kampus Utama, Jalan Genting Kelang, 53300 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur, Malaysia.
            </p>
        </div>
        
        <button class="accordion">Tell me more about TARUC Badminton Club</button>
        <div class="panel">
            <p>
                Want know more about us?<br>
                You can refer to this link<br>
                <a href="https://www.facebook.com/badmintonclubtaruckl/">https://www.facebook.com/badmintonclubtaruckl/</a>
            </p>
        </div>
        
        <div class="blank"></div>
        
        <script>
            var acc = document.getElementsByClassName("accordion");
            var i;

            for (i = 0; i < acc.length; i++) {
              acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                  panel.style.maxHeight = null;
                } else {
                  panel.style.maxHeight = panel.scrollHeight + "px";
                } 
              });
            }
        </script>

        <?php require_once ('includes/footer.php');?>