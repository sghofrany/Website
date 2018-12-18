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

        <!-- <select onchange="location = this.value;">
            <option value="">V</option>
            <option value="leaderboard.php?game=nodebuff_elo">NoDebuff</option>
            <option value="leaderboard.php?game=gapple_elo">GApple</option>
            <option value="leaderboard.php?game=archer_elo">Archer</option>
            <option value="leaderboard.php?game=sumo_elo">Sumo</option>
            <option value="leaderboard.php?game=vanilla_elo">Vanilla</option>
            <option value="leaderboard.php?game=soup_elo">Soup</option>
            <option value="leaderboard.php?game=combo_elo">Combo</option>
            <option value="leaderboard.php?game=hcf_elo">HCF</option>
            <option value="leaderboard.php?game=axe_elo">Axe</option>
            <option value="leaderboard.php?game=debuff_elo">Debuff</option>
            <option value="leaderboard.php?game=sg_elo">SG</option>
            <option value="leaderboard.php?game=builduhc_elo">BuildUHC</option>
        </select> -->


        <ul>
            <li><a href="leaderboard.php?game=nodebuff_elo">NoDebuff</a></li>
            <li><a href="leaderboard.php?game=debuff_elo">Debuff</a></li>
            <li><a href="leaderboard.php?game=builduhc_elo">BuildUHC</a></li>
            <li><a href="leaderboard.php?game=gapple_elo">Gapple</a></li>
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