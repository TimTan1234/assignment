<style>
                /*NAVIGATION BAR*/
        
        .navigation a {
            width: 19.5%;
            text-decoration: none;
            font-size: 20px;
            padding-top: 10px;
            padding-bottom: 15px;
            float: left;
            text-align: center;
            font-weight: bolder;
            color: rgb(19, 226, 19);
         
            
        }
        
        .navigation a:hover {
            text-decoration: none;
            border: 1px solid rgb(12, 255, 12);
            background-color: #111;;
          
        }
        
        .li{
            list-style-type: none;
              
        }
        
        .navigation::after {
            clear: both;
        }

        .nav{
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
            top: 0;
          }
        

         
        .login a {
            float: right;
            margin-top: 1%;
            margin-right: 3%;
            border: 1px solid #333;
            padding: 5px;
            background-color: #333;
            color: rgb(19, 226, 19);
            width: 120px;
            text-align: center;
        }
        
        .login a:hover {
            background-color:  #111;
        }

        </style>    

        <nav>
            <div class="navigation">

                <ul class="nav">
                    <li>
                        <a href="Home.php">Home</a>
                    </li>
                    <li>
                        <a href="Event.php"> EVENT</a>
                    </li>
                    <li>
                        <a href="FAQ.php">FAQ </a>
                    </li>
                    <li>
                        <a href="aboutus.php">About Us </a>
                    </li>
                    <li>
                        <a href="history.php">History</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="login">

            <a href="login.php">Log In/Register</a>
        </div>