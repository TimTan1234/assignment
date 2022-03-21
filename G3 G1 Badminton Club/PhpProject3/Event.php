<?php
        require_once('includes/header.php');
        include('includes/navigation.php');
    ?>
<head>
    <meta charset="utf-8">
    <title>Event</title>
    <style>
        img{
            width:25%;
            margin: 20px;
        }
    </style>
</head>
<style>
</style>
        
        <h1>Events:</h1>
        <div class="event">                  
        <?php
      
        
                          echo '<ul>';
        foreach (glob('uploads/*.{jpg,jpeg,gif,png}', GLOB_BRACE) as $file)
        {
            // Create clickable hyperlink.
            $basename = pathinfo($file, PATHINFO_BASENAME);
            $path_parts = pathinfo($file, PATHINFO_FILENAME);
            printf('<a href="EventDetails.php?event=%s&image=%s"><img src="uploads/%s" alt="%s" /></a>', $path_parts, $basename, $basename, $basename);
            echo '</ul>';
        }
                    
                
       
        ?>       
        </div>
        
    <?php
      require_once('includes/footer.php');
    ?>