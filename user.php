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
                        exit();
                    }

                    ?>
         
                    <tr>
                        <td><?php echo($info['name']); ?></td>
                        <td><?php echo($count); ?></td>
                    </tr>
                </table>
            
        </div>
        
    </body>
    
</html>