<?php
    require "header.php";
?>

<!DOCTYPE html>
<html>
    <head>
       <title>Hello</title>
       <link rel="stylesheet" type="text/css" href="css/style.css">
       <link rel="stylesheet" type="text/css" href="css/user.css">
       
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
       
    </head> 
     
    <body>

        <div class="wrapper">

                <table>
                    <th>Player</th>
                    <th>Bans</th>

                    <?php

                    require 'database/rank-database.php';
                    $user = "";

                    if(!isset($_GET['name'])) {
                        $user = "Irantwomiles";
                    } else {
                        $user  = $_GET['name'];
                    }

                    $id = get_id_by_name($user);

                    $query = "SELECT players.name FROM players JOIN punishments ON (punishments.punisher_id = players.player_id AND players.name = '$user')";

                    $result = mysqli_query($connection, $query);

                    $count = mysqli_num_rows($result);

                    $info = mysqli_fetch_assoc($result);

                    if($count < 1) {
                        echo("$user has not bans");
                        mysqli_close($connection);
                        exit();
                    }
                    mysqli_close($connection);
                    ?>
         
                    <tr>
                        <td><?php echo($info['name']); ?></td>
                        <td><?php echo($count); ?></td>
                    </tr>
                </table>
            
        </div>
        
    </body>
    
</html>