<?php
    include 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>PvPTemple</title>
</head>

<body>
    
    <table class="leaderboard">
        <th>Rank</th>
        <th>Player</th>
        <th>Elo</th>
    
        <?php

        require 'database/rank-database.php';

        $query = "SELECT * FROM practice_season_4_data ORDER BY sumo_elo DESC LIMIT 10";
        $result = mysqli_query($connection, $query);
    
        $rank = 1;
        while($rows = $result->fetch_assoc()) {
        ?>

        <tr>
            <td><?php echo($rank); ?></td>
            <td><?php echo($rows['player_id']); ?></td>
            <td><?php echo($rows['sumo_elo']); ?></td>
        </tr>

        <?php
        $rank = $rank + 1;
        }
        ?>

    </table>

</body>

</html>