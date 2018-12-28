<?php
include 'header';
?>

<!DOCTYPE html>
<html>
<head>
	<title>PvPTemple - Support</title>
    <link rel="stylesheet" type="text/css" href="css/ticket.css">
</head>
    
    <body style="background-color: white;">

        <script>
            document.getElementById('subtext').innerHTML = "support";
        </script>

        <?php
            if(!logged_in()) {
        ?>

        <div class="wrapper">
            <p style="text-align: center; margin-top: 20px;">You need to be <a href="index">logged</a> in before making a support ticket!</p>
        </div>

        <?php
                exit();
            }
        ?>

        <div class="wrapper">
            <div class="list">
                <p class="info-text">Current Tickets</p>
            </div>
        </div>

        <?php

            require 'database/support-database.php';

            $query = "SELECT * FROM ticket";
            $result = mysqli_query($connection, $query);
            $rows = mysqli_num_rows($result);

            if($rows < 1) {
        ?>

        <div class="wrapper">
            <p style="text-align: center; margin-top: 20px;">There are no Support Tickets at this time!</p>
        </div>

        <?php
                exit();
            }
        ?>


        <div class="wrapper">

            <table style="background-color:white;">
                <th>Title</th>
                <th>User</th>
                <th>Date</th>
                <th>Status</th>
            <?php

                while($ticket = mysqli_fetch_assoc($result)) {
            ?>

                <tr>
                
                
                    <td><a href="ticket?id=<?php echo($ticket['id']) ?>&page=1"><?php echo($ticket['title']); ?></a></td>
                    <td><?php echo(get_name($ticket['uuid'])); ?></td>
                    <td><?php echo($ticket['date']); ?></td>
                    
                    <?php
                    
                    if($ticket['resolved'] == -1) {
                
                    ?>
                    <td style="background-color: #f2c521; color: white"><?php echo(get_resolved($ticket['resolved'])); ?></td>
                    <?php
                        } elseif($ticket['resolved'] == 0) {
                    ?>
                    <td style="background-color: #f25f54; color: white;"><?php echo(get_resolved($ticket['resolved'])); ?></td>
                    <?php
                        } elseif($ticket['resolved'] == 1) {
                    ?>  
                    <td style="background-color: #7fc47f; color: white;"><?php echo(get_resolved($ticket['resolved'])); ?></td>
                    <?php
                    }
                    ?>
                </tr>


            <?php
                }
            ?>

            </table>

        </div>

    </body>

</html>
