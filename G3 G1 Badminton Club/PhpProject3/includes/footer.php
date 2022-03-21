<style>
     /*FOOTER*/
        
        footer {
            margin-left: auto;
            margin-right: auto;
            background-color: rgb(37, 37, 37);
            column-width: 300px;
            column-gap: 70px;
            height: 200px;
            padding-left: 1%;
            position: relative;
            top: 10px;
        }
        
        footer:before {
            clear: both;
            order: 99;
        }
        
        footer h1 {
            color: rgb(56, 190, 179);
            font-size: 15px;
            margin: 10px 0px;
            padding-top: 5%;
        }
        
        .footernav a {
            color: white;
            font-size: 16px;
            display: block;
            text-decoration: none;
        }
        
        .footernav a:hover {
            color: rgb(146, 137, 137);
        }
        
        .footer::after {
            clear: both;
        }
        
        .content {
            height: 80%;
        }
        
        .footernav {
            width: 100%;
        }
        
        header:after {
            clear: both;
        }
</style>    

    <footer>

        <div class="footernav">
            <h1>User PAGES</h1>
            <a href="Home.php">Home</a>
            <a href="userhistory.php">User</a>
            <a href="history.php">History</a>
             
            <br/>

           <br/>
            <h1>ALL OUR STORY</h1>
            <a href="aboutus.php ">About Us</a>
        
            <br/>
            <br/>
            <br/>
             <br/>
            <h1>Contact Us</h1>
            <a href="contactUs.php">Contact Us</a>
            <a href="FAQ.php">FAQs</a>

            <br/>
            <br/>
             <br/>
            <h1>MY ACCOUNT</h1>
            <a href="login.php">Log in</a>
            <a href="register.php">Register</a>

            <h1>Event</h1>
            <a href="Event.php">Event</a>
             <a href="ticket-selling.php">Ticket Selling</a>
        </div>
    </footer>

    </body>
</html>