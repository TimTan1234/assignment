<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="#" rel="stylesheet" />
        
        <style>
                body {
                    font-family: Arial, Helvetica, sans-serif;
                }

                /*Header*/
                body > header{
                    width: 100%;
                    margin: auto;
                    padding: auto;
                    display: flex;
                    background-color: white;
                }

                img.logo{
                    margin: auto;
                    padding: auto;
                }

                /*Search*/
                .search{
                    display: flex;
                    position: absolute;
                    right: 40%;
                    padding-top: 8px;
                    float: right;
                }
                
                .search input[type=text] {
                    padding: 10px;
                    padding-right: 50px;
                    margin-top: 8px;
                    font-size: 17px;
                    border: none;
                    background: whitesmoke;
                    color: black;
                }
                
                .search button {
                    float: right;
                    padding: 10px 14px;
                    margin-top: 8px;
                    margin-right: 16px;
                    background: lightgray;
                    font-size: 17px;
                    border: none;
                    cursor: pointer;
                }
        </style>
    </head>
    
    <body>
                
        <header>
            <a href ="HomePage.php">
                <img class="logo" src="image/Logo.png" alt="Badminton Club TARUC KL" width="135px"/></a>
            
            <div class="search">
                <form action="#">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </header>
    