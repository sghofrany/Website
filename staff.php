<?php
require 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>PvPTemple</title>
</head>

<body>

    <!-- Changing the subtext of the banner to whatever the page is -->
    <script>
        document.getElementById('subtext').innerHTML = "staff";
    </script>

    <div class="wrapper">

        <?php

            require 'database/rank-database.php';

            $query = "SELECT * FROM players WHERE (rank='Owner' OR rank='Developer' OR rank='Platform-Admin' OR rank='Senior-Admin' OR rank='Admin' OR rank='Senior-Mod' OR rank='Mod' OR rank='Trainee')";
                                    
            $result = mysqli_query($connection, $query);

            $rows = mysqli_num_rows($result);
            
            echo("Staff: " . $rows . "<br>");

            while($staff = mysqli_fetch_assoc($result)) {
                echo("<img src='https://crafatar.com/avatars/" . $staff['uuid'] . "?size=15&default=MHF_Steve&overlay'>" . "[" . $staff['rank'] . "] " . $staff['name'] . "<br>");
            }

        ?>

    </div>
    <?php
    //require 'footer.php';
    ?>
</body>

</html>
