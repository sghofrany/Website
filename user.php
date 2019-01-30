<?php

function get_name_history($uuid) {
    $json_response = file_get_contents('https://api.mojang.com/user/profiles/' . $uuid . '/names');

    $obj = json_decode($json_response);

    return $obj;
}


    require "header.php";
    require 'database/rank-database.php';

    $user = "";

    if(!isset($_GET['name'])) {
        $user = "Irantwomiles";
    } else {
        $user  = $_GET['name'];
    }

    // Player

    $player_query = "SELECT * FROM players WHERE name='$user'";

    $player_result = mysqli_query($connection, $player_query);

    $player_rows = mysqli_num_rows($player_result);

    if($player_rows < 1) {
        echo("$user could not be found");
        mysqli_close($connection);
        exit();
    }

    $player_info = mysqli_fetch_assoc($player_result);

    $last_seen = $player_info['last_login'];
    $uuid = $player_info['uuid'];
    $player_id = $player_info['player_id'];
    $player_rank = $player_info['rank'];
    // Punishment

    $punishment_query = "SELECT players.name FROM players JOIN punishments ON (punishments.player_id = players.player_id AND players.name = '$user')";
    
    $punishment_result = mysqli_query($connection, $punishment_query);

    $punishment_rows = mysqli_num_rows($punishment_result);

    $punishment_count = $punishment_rows;

    // Elo

    $elo_query = "SELECT * FROM practice_season_4_data WHERE player_id='$player_id'";
    
    $elo_result = mysqli_query($connection, $elo_query);

    $elo_rows = mysqli_num_rows($elo_result);

    $elo_info = mysqli_fetch_assoc($elo_result);

?>

<!DOCTYPE html>
<html>
    <head>
       <title>Hello</title>
       <link rel="stylesheet" type="text/css" href="css/style.css">
       <link rel="stylesheet" type="text/css" href="css/user.css">
       
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head> 
     
    <body>

        <div class="wrapper">
            <!-- Start -->
                <div class="profile-wrapper">

                    <div class="user-wrapper">

                        <div class="user">
                            <div class="user-img">
                                <img src="https://visage.surgeplay.com/head/128/<?php echo($uuid); ?>" alt='Staff Image'>
                            </div>
                            
                            <div class="user-name">
                                <p><?php echo($user); ?></p>
                            </div>
                        </div>

                        <div class="user-info">

                            <div class="user-rank">
                            <?php
                            
                                if($player_rank === "Owner") {
                            ?>
                                <p id="owner"><?php echo($player_rank); ?></p>
                            <?php
                                } elseif($player_rank === "Developer") {
                            ?>
                                <p id="developer"><?php echo($player_rank); ?></p>
                            <?php
                                } elseif($player_rank === "Platform-Admin") {
                            ?>
                                <p id="plat-admin"><?php echo($player_rank); ?></p>
                            <?php
                                } elseif($player_rank === "Senior-Admin") {
                            ?>
                                <p id="senior-admin"><?php echo($player_rank); ?></p>
                            <?php
                                } elseif($player_rank === "Admin") {
                            ?>
                                <p id="admin"><?php echo($player_rank); ?></p>
                            <?php
                                } elseif($player_rank === "Senior-Mod") {
                            ?>
                                <p id="senior-mod"><?php echo($player_rank); ?></p>
                            <?php
                                } elseif($player_rank === "Mod") {
                            ?>
                                <p id="mod"><?php echo($player_rank); ?></p>
                            <?php
                                } elseif($player_rank === "Partner") {
                            ?>
                                <p id="partner"><?php echo($player_rank); ?></p>
                            <?php
                                } elseif($player_rank === "Famous") {
                            ?>
                                <p id="famous"><?php echo($player_rank); ?></p>
                            <?php
                                } elseif($player_rank === "YouTuber") {
                            ?>
                                <p id="youtuber"><?php echo($player_rank); ?></p>
                            <?php
                                } elseif($player_rank === "Master") {
                            ?>
                                <p id="master"><?php echo($player_rank); ?></p>
                            <?php
                                } elseif($player_rank === "Elite") {
                            ?>
                                <p id="elite"><?php echo($player_rank); ?></p>
                            <?php
                                } elseif($player_rank === "Prime") {
                            ?>
                                <p id="prime"><?php echo($player_rank); ?></p>
                            <?php
                                } elseif($player_rank === "Basic") {
                            ?>
                                <p id="basic"><?php echo($player_rank); ?></p>
                            <?php
                                } elseif($player_rank === "Normal") {
                            ?>
                                <p id="normal"><?php echo($player_rank); ?></p>
                            <?php
                                } elseif($player_rank === "Trainee") {
                            ?>
                                <p id="trainee"><?php echo($player_rank); ?></p>
                            <?php
                                } elseif($player_rank === "Host") {
                            ?>
                                <p id="host"><?php echo($player_rank); ?></p>
                            <?php
                                }
                            ?>
                            </div>

                            <div class="separator-wrapper">
                                <p class="separator"></p>
                            </div>
                            
                            <div class="first-join">
                                <p class="p1">FIRST JOIN</p>
                                <p class="p2"><?php echo date("M jS, Y",strtotime($last_seen)); ?></p>
                            </div>

                            <div class="last-seen">
                                <p class="p1">LAST SEEN</p>
                                <p class="p2"><?php echo date("M jS, Y",strtotime($last_seen)); ?></p>
                            </div>

                            <div class="separator-wrapper">
                                <p class="separator"></p>
                            </div>


                            <p style=" padding-left: 10%; color: #CCCCCC; font-weight: bold; margin:0px; font-size: 13px;">NAME HISTORY</p>

                            <div class="name-history">
                                
                                <?php
                                
                                $history = get_name_history(str_replace("-", "", $uuid));

                                $size = sizeof($history);

                                for ($i = 0; $i < $size; $i++) {

                                    $date = date("d/m/Y", $history[$i]->changedToAt / 1000);

                                    if($i == 0) {
                                        $date = "initial";
                                    } elseif ($i == ($size - 1)) {
                                        $date = "current";
                                    }
                                ?>

                                <p class="name"><?php echo($history[$i]->name); ?></p>
                                
                                <p class="name-date"><?php echo($date); ?></p>

                                <?php
                                 }
                                ?>
                            </div>

                            <div class="separator-wrapper">
                                <p class="separator"></p>
                            </div>


                            <div class="punishment">
                                <p id="p1">Punishments</p>
                                <p id="p2"><?php echo($punishment_count); ?> total</p>
                            </div>

                        </div>

                    </div>

                    <div class="info-wrapper">

                        <div class="info-title">
                            <p class="profile-title"><?php echo(strtoupper($user)); ?>'S PROFILE</p>
                            <!-- <p class="status">BANNED</p> -->
                        </div>

                        <div class="dropdown" style="width: 20%;">
                            <button class="dropbtn" style="width: 100%;">SELECT GAME</button>
                            <div class="dropdown-content">
                                <a href="#">Coming Soon</a>
                            </div>
                        </div>

                        <div class="elo-wrapper">
                            <div class="elo-box" style="margin-right: 1.3%">
                                <p class="ladder">GLOBAL</p>
                                <p class="elo">1000</p>
                            </div>

                            <div class="elo-box" style="margin-right: 1.3%">
                                <p class="ladder">NODEBUFF</p>
                                <p class="elo"><?php echo($elo_info['nodebuff_elo']); ?> ELO</p>
                            </div>

                            <div class="elo-box" style="margin-right: 1.3%">
                                <p class="ladder">DEBUFF</p>
                                <p class="elo"><?php echo($elo_info['debuff_elo']); ?> ELO</p>
                            </div>

                            <div class="elo-box">
                                <p class="ladder">BUILDUHC</p>
                                <p class="elo"><?php echo($elo_info['builduhc_elo']); ?> ELO</p>
                            </div>

                            <div class="elo-box" style="margin-right: 1.3%">
                                <p class="ladder">GAPPLE</p>
                                <p class="elo"><?php echo($elo_info['gapple_elo']); ?> ELO</p>
                            </div>

                             <div class="elo-box" style="margin-right: 1.3%">
                                <p class="ladder">SUMO</p>
                                <p class="elo"><?php echo($elo_info['sumo_elo']); ?> ELO</p>
                            </div>
                            <!--
                            <div class="elo-box" style="margin-right: 1.3%">
                                <p class="ladder">NODEBUFF</p>
                                <p class="elo">1000</p>
                            </div>

                            <div class="elo-box">
                                <p class="ladder">NODEBUFF</p>
                                <p class="elo">1000</p>
                            </div> -->
                        </div>

                    </div>
                    <!-- End -->

        </div>
        </div>
        <?php
            include 'footer.php';
        ?>
    </body>
    
</html>