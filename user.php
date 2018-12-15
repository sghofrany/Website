<?php
    require "header.php";
?>

<!DOCTYPE html>
<html>
    <head>
       <title>Hello</title>
       <link rel="stylesheet" type="text/css" href="css/style.css">
       <link rel="stylesheet" type="text/css" href="css/user.css">
       <link rel="stylesheet" type="text/css" href="css/header.css">
       
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

       <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
       
    </head> 
     
    <body>


        <?php
        if(!isset($_GET['name'])) {
        ?>
            <div class="wrapper">That user could not be found</div>
        <?php
        exit();
        } else {
            require 'database/database.php';

            $name = $_GET['name'];
            $uuid = get_uuid($name);

            $query = "SELECT * FROM user WHERE uuid='$uuid'";
            $result = mysqli_query($connection, $query);
            $rows = mysqli_num_rows($result);

            if($rows < 1) {
        ?>
        
            <div class="wrapper">That user could not be found</div>

        <?php
                exit();
            }
            $info = mysqli_fetch_assoc($result);
        }
        ?>


        <div class="wrapper">

                <div class="user">
                <video autoplay loop muted id="monkey">
                    <source src="video/monkey.mp4" type="video/mp4">
                </video>
                    <div class="user-image">
                    <img class="image" src="https://crafatar.com/avatars/<?php echo($info['uuid']) ?>?size=128&default=MHF_Steve&overlay">
                    </div>

                    <div class="user-text">
                        <p><?php echo(get_name($info['uuid'])); ?></p>
                    </div>

                    <div class="user-rank">
                        <p class="rank">Developer</p>
                    </div>
                </div>      
         
   
            <div class="info">
               <div class="user-stats">
                    <label class="practice">Practice</label>
                    <label class="uhc">UHC</label>
                    <label class="skywars">Skywars</label>  
               </div>
            </div>
            
        </div>
        
    </body>
    
</html>