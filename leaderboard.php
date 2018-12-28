<?php
    include 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>PvPTemple</title>
</head>

<body>
    
    <div class="wrapper">


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