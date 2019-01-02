<?php
require 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>PvPTemple</title>
    <link rel="stylesheet" type="text/css" href="css/staff.css">
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
        
            $data = array();

            while($staff = mysqli_fetch_assoc($result)) {
                $data[] = $staff;
            }

            mysqli_close($connection);

        ?>
     

        <p class="staff-title">Owner</p>

        <hr>

        <div class="main-wrapper">
            <?php
                //Owner
                foreach($data as $row) {
                    if($row['rank'] == "Owner") {
                        echo(
                        "<div class='staff-wrapper'>
                            <div class='staff-img'>
                                <img src='https://visage.surgeplay.com/full/230/" . $row['uuid'] . "?tilt=0' alt='Staff Image'>
                            </div>
                            <div><p class='staff-name'><a href='user?name=" . $row['name'] ."'>" . $row['name'] ."</a></p></div>
                        </div>"
                        );
                    }
                }
            ?>
        </div>

        <p class="staff-title">Developer</p>

        <hr>

        <div class="main-wrapper">
            <?php
                //Owner
                foreach($data as $row) {
                    if($row['rank'] == "Developer") {
                        echo(
                        "<div class='staff-wrapper'>
                            <div class='staff-img'>
                                <img src='https://visage.surgeplay.com/full/230/" . $row['uuid'] . "?tilt=0' alt='Staff Image'>
                            </div>
                            <div><p class='staff-name'><a href='user?name=" . $row['name'] ."'>" . $row['name'] ."</a></p></div>
                        </div>"
                        );
                    }
                }
            ?>
        </div>

        <p class="staff-title">Platform Admin</p>

        <hr>

        <div class="main-wrapper">
            <?php
                //Owner
                foreach($data as $row) {
                    if($row['rank'] == "Platform-Admin") {
                        echo(
                        "<div class='staff-wrapper'>
                            <div class='staff-img'>
                                <img src='https://visage.surgeplay.com/full/230/" . $row['uuid'] . "?tilt=0' alt='Staff Image'>
                            </div>
                            <div><p class='staff-name'><a href='user?name=" . $row['name'] ."'>" . $row['name'] ."</a></p></div>
                        </div>"
                        );
                    }
                }
            ?>
        </div>

        <p class="staff-title">Senior Admin</p>

        <hr>

        <div class="main-wrapper">
            <?php
                //Owner
                foreach($data as $row) {
                    if($row['rank'] == "Senior-Admin") {
                        echo(
                        "<div class='staff-wrapper'>
                            <div class='staff-img'>
                                <img src='https://visage.surgeplay.com/full/230/" . $row['uuid'] . "?tilt=0' alt='Staff Image'>
                            </div>
                            <div><p class='staff-name'><a href='user?name=" . $row['name'] ."'>" . $row['name'] ."</a></p></div>
                        </div>"
                        );
                    }
                }
            ?>
        </div>

        <p class="staff-title">Admin</p>

        <hr>

        <div class="main-wrapper">
            <?php
                //Owner
                foreach($data as $row) {
                    if($row['rank'] == "Admin") {
                        echo(
                        "<div class='staff-wrapper'>
                            <div class='staff-img'>
                                <img src='https://visage.surgeplay.com/full/230/" . $row['uuid'] . "?tilt=0' alt='Staff Image'>
                            </div>
                            <div><p class='staff-name'><a href='user?name=" . $row['name'] ."'>" . $row['name'] ."</a></p></div>
                        </div>"
                        );
                    }
                }
            ?>
        </div>

        <p class="staff-title">Senior Mod</p>

        <hr>

        <div class="main-wrapper">
            <?php
                //Owner
                foreach($data as $row) {
                    if($row['rank'] == "Senior-Mod") {
                        echo(
                        "<div class='staff-wrapper'>
                            <div class='staff-img'>
                                <img src='https://visage.surgeplay.com/full/230/" . $row['uuid'] . "?tilt=0' alt='Staff Image'>
                            </div>
                            <div><p class='staff-name'><a href='user?name=" . $row['name'] ."'>" . $row['name'] ."</a></p></div>
                        </div>"
                        );
                    }
                }
            ?>
        </div>

        <p class="staff-title">Mod</p>

        <hr>

        <div class="main-wrapper">
            <?php
                //Owner
                foreach($data as $row) {
                    if($row['rank'] == "Mod") {
                        echo(
                        "<div class='staff-wrapper'>
                            <div class='staff-img'>
                                <img src='https://visage.surgeplay.com/full/230/" . $row['uuid'] . "?tilt=0' alt='Staff Image'>
                            </div>

                            <div><p class='staff-name'><a href='user?name=" . $row['name'] ."'>" . $row['name'] ."</a></p></div>
                        </div>"
                        );
                    }
                }
            ?>
        </div>

        <p class="staff-title">Trainee</p>

        <hr>

        <div class="main-wrapper">
            <?php
                //Owner
                foreach($data as $row) {
                    if($row['rank'] == "Trainee") {
                        echo(
                        "<div class='staff-wrapper'>
                            <div class='staff-img'>
                                <img src='https://visage.surgeplay.com/full/230/" . $row['uuid'] . "?tilt=0' alt='Staff Image'>
                            </div>

                            <div><p class='staff-name'><a href='user?name=" . $row['name'] ."'>" . $row['name'] ."</a></p></div>
                        </div>"
                        );
                    }
                }
            ?>
        </div>

    </div>
    <?php
    //require 'footer.php';
    ?>
</body>

</html>
