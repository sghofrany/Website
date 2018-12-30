<?php
    include 'header.php';
    require 'database/rank-database.php';
    
    $elo = "";

    if(!isset($_GET['game'])) {
        $elo = "nodebuff_elo";
    } else {
        $elo  = $_GET['game'];
    }

    $win = str_replace("_elo", "_wins", $elo);
    $loss = str_replace("_elo", "_losses", $elo);

    $query = "SELECT practice_season_4_data.player_id, practice_season_4_data.$elo, practice_season_4_data.$win, practice_season_4_data.$loss, players.player_id, players.name FROM practice_season_4_data JOIN players ON practice_season_4_data.player_id = players.player_id ORDER BY $elo DESC LIMIT 20";

    $result = mysqli_query($connection, $query);

    $num = 1;

    $data = array();

    while($info = mysqli_fetch_assoc($result)) {
        $data[] = $info;
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>PvPTemple</title>
    <link rel="stylesheet" type="text/css" href="css/leaderboard.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>

<body>
    
    <div class="wrapper">

        <div class="gamemodes">
            <div class="game-item" style="margin-right: 1.6%; background-color: #ffa8e3;">
                <p class="game-title">Practice</p>
                <p class="game-count">395 players online</p>
            </div>
            <div class="game-item" style="margin-right: 1.6%; background-color: #02d371;">
                <p class="game-title">UHC</p>
                <p class="game-count">395 players online</p>
            </div>
            <div class="game-item" style="margin-right: 1.6%; background-color: #01bad2;">
                <p class="game-title">UHC Meetup</p>
                <p class="game-count">395 players online</p>
            </div>
            <div class="game-item" style="margin-right: 1.6%; background-color: #fc9850;">
                <p class="game-title">Survival Games</p>
                <p class="game-count">395 players online</p>
            </div>
            <div class="game-item" style="margin-right: 1.6%; background-color: #5990ea;">
                <p class="game-title">SkyWars</p>
                <p class="game-count">395 players online</p>
            </div>
            <div class="game-item" style="background-color: #ff2d5a;">
                <p class="game-title">HCF</p>
                <p class="game-count">395 players online</p>
            </div>

        </div>

        <br>
        <hr>
        <div class="all-tables">
            <div class="table-wrapper" style="margin-right: 1%;">

                <div class="table-title">
                    <p>Global Elo</p>
                </div>

                <table>

                    <tr>
                        <td>1.</td>
                        <td>Irantwomiles</td>
                        <td>1000</td>
                    </tr>
                </table>
            </div>

            <div class="table-wrapper" style="margin-right: 1%;">

                <div class="table-title">
                    <p>Win/Loss</p>
                </div>

                <table>

                    <tr>
                        <td>1.</td>
                        <td>Irantwomiles</td>
                        <td>1000</td>
                    </tr>
                </table>
            </div>

            <div class="table-wrapper">

                <div class="table-title">
                    <div style="width: 90%;">
                        <p><?php 
                            if($elo == "nodebuff_elo") {
                                echo("NoDebuff Elo");
                            } elseif($elo == "debuff_elo") {
                                echo("Debuff Elo");
                            } elseif($elo == "builduhc_elo") {
                                echo("BuildUHC Elo");
                            } elseif($elo == "gapple_elo") {
                                echo("Gapple Elo");
                            }
                        
                        ?></p>
                    </div>


                    <div class="dropdown" style="width: 10%;">
                        <button class="dropbtn" style="width: 100%;"><i class="fa fa-caret-down" aria-hidden="true"></i></button>
                        <div class="dropdown-content">
                            <a href="leaderboard?game=nodebuff_elo">NoDebuff</a>
                            <a href="leaderboard?game=debuff_elo">Debuff</a>
                            <a href="leaderboard?game=builduhc_elo">BuildUHC</a>
                            <a href="leaderboard?game=gapple_elo">Gapple</a>
                        </div>
                    </div>

                </div>

                <table>
                
                <?php

                foreach($data as $row) {
                ?>
                <tr>
                    <td><?php echo($num); ?></td>
                    <td><?php echo($row['name']); ?></td>
                    <td><?php echo($row[$elo]); ?></td>
                </tr>
                <?php
                $num++;
                }
                ?>

                </table>
            </div>
        </div>

    </div>



</body>

</html>