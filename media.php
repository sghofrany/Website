<?php
require 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>PvPTemple</title>
    <link rel="stylesheet" type="text/css" href="css/staff.css">
    <link rel="stylesheet" type="text/css" href="css/support.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

    <!-- Changing the subtext of the banner to whatever the page is -->
    <script>
        document.getElementById('subtext').innerHTML = "staff";
    </script>

    <div class="wrapper">

        <?php

            require 'database/rank-database.php';

            $query = "SELECT * FROM players WHERE (rank='Partner' OR rank='Famous' OR rank='Youtuber')";
                                    
            $result = mysqli_query($connection, $query);

            $rows = mysqli_num_rows($result);
        
            $data = array();

            while($staff = mysqli_fetch_assoc($result)) {
                $data[] = $staff;
            }

            mysqli_close($connection);

        ?>
        <div class="support-info-wrapper">
            <p class="support-title">THE STAFF TEAM</p>
            <p class="support-body">The worse hand disappears across the fiddle. Whatever vicar scatters the nervous outline. The cooling revenue denotes the arrow. A stroke institutes each alphabet The worse hand disappears across the fiddle. Whatever vicar scatters the nervous outline. The cooling revenue denotes the arrow. A stroke institutes each alphabet.The worse hand disappears across the fiddle. Whatever vicar scatters the nervous outline. The cooling revenue denotes the arrow. A stroke institutes each alphabet.</p>
        
        </div>

        <p class="staff-title">PARTNER</p>

        <div class="main-wrapper">
            <?php
                
                foreach($data as $row) {
                    if($row['rank'] == "Partner") {
                        echo(
                        "<div class='staff-wrapper'>
                            <div class='staff-img'>
                                <img src='https://visage.surgeplay.com/head/96/" . $row['uuid'] . "?tilt=0' alt='Staff Image'>
                            </div>
                            <div><p class='staff-name'><a href='user?name=" . $row['name'] ."'>" . $row['name'] ."</a></p></div>
                        </div>"
                        );
                    }
                }
            ?>
        </div>

        <p class="staff-title">FAMOUS</p>

        <div class="main-wrapper">
            <?php

                foreach($data as $row) {
                    if($row['rank'] == "Famous") {
                        echo(
                        "<div class='staff-wrapper'>
                            <div class='staff-img'>
                                <img src='https://visage.surgeplay.com/head/96/" . $row['uuid'] . "?tilt=0' alt='Staff Image'>
                            </div>
                            <div><p class='staff-name'><a href='user?name=" . $row['name'] ."'>" . $row['name'] ."</a></p></div>
                        </div>"
                        );
                    }
                }
            ?>
        </div>

        <p class="staff-title">YOUTUBER</p>

        <div class="main-wrapper">
            <?php
             
                foreach($data as $row) {
                    if($row['rank'] == "YouTuber") {
                        echo(
                        "<div class='staff-wrapper'>
                            <div class='staff-img'>
                                <img src='https://visage.surgeplay.com/head/96/" . $row['uuid'] . "?tilt=0' alt='Staff Image'>
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
        include 'footer.php';
    ?>
</body>

</html>
