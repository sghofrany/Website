<?php
    include 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>PvPTemple</title>
    <link rel="stylesheet" type="text/css" href="css/leaderboard.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet">
</head>

<body>
    
    <div class="wrapper">


        <div class="gamemodes">
            <div class="game-item" style="margin-right: 1%; background-color: #ffa8e3;">
                <p class="game-title">Practice</p>
                <p class="game-count">395 players online</p>
            </div>
            <div class="game-item" style="margin-right: 1%; background-color: #02d371;">
                <p class="game-title">UHC</p>
                <p class="game-count">395 players online</p>
            </div>
            <div class="game-item" style="margin-right: 1%; background-color: #01bad2;">
                <p class="game-title">UHC Meetup</p>
                <p class="game-count">395 players online</p>
            </div>
            <div class="game-item" style="margin-right: 1%; background-color: #fc9850;">
                <p class="game-title">Survival Games</p>
                <p class="game-count">395 players online</p>
            </div>
            <div class="game-item" style="margin-right: 1%; background-color: #5990ea;">
                <p class="game-title">SkyWars</p>
                <p class="game-count">395 players online</p>
            </div>
            <div class="game-item" style="margin-right: 1%; background-color: #c44a64;">
                <p class="game-title">HCF</p>
                <p class="game-count">395 players online</p>
            </div>
        </div>

        <ul>
            <li><a href="leaderboard?game=nodebuff_elo">NoDebuff</a></li>
            <li><a href="leaderboard?game=debuff_elo">Debuff</a></li>
            <li><a href="leaderboard?game=builduhc_elo">BuildUHC</a></li>
            <li><a href="leaderboard?game=gapple_elo">Gapple</a></li>
        </ul>
      
        <table>
            <th>Rank</th>
            <th>Player</th>
            <th>Elo</th>
        
            <?php

            require 'database/rank-database.php';
            $elo = "";

            if(!isset($_GET['game'])) {
                $elo = "nodebuff_elo";
            } else {
                $elo  = $_GET['game'];
            }

            $query = "SELECT practice_season_4_data.player_id, practice_season_4_data.$elo, players.player_id, players.name FROM practice_season_4_data JOIN players ON practice_season_4_data.player_id = players.player_id ORDER BY $elo DESC LIMIT 20";

            $result = mysqli_query($connection, $query);

            $num = 1;

            while($rows = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo($num); ?></td>
                    <td><?php echo($rows['name']); ?></td>
                    <td><?php echo($rows[$elo]); ?></td>
                </tr>
            <?php
              $num++;
            }
            ?>

        </table>
        
    </div>



</body>

</html>