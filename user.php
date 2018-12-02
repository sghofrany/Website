<?php
    include "header.php";
?>

<!DOCTYPE html>
<html>
    <head>
       <title>Hello</title>
       <link rel="stylesheet" type="text/css" href="css/style.css">
       <link rel="stylesheet" type="text/css" href="css/user.css">
       <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    </head> 
     
    <body>

        <?php
        if(!isset($_GET['id'])) {
        ?>
            <div class="wrapper">That user could not be found</div>
        <?php
        exit();
        } else {
            require 'database/database.php';

            $id = $_GET['id'];

            $query = "SELECT * FROM user WHERE id='$id'";
            $result = mysqli_query($connection, $query);
            $rows = mysqli_num_rows($result);

            if($rows < 0) {
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
                    <div class="user-image">
                    <!-- <img src="https://crafatar.com/avatars/<?php echo($info['uuid']) ?>?size=128&default=MHF_Steve&overlay"> -->
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