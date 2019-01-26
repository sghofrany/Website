<?php
include 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>PvPTemple - Support</title>
    <link rel="stylesheet" type="text/css" href="css/support-list.css">
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

        <?php

            require 'database/support-database.php';

            $query = "SELECT * FROM ticket";
            $result = mysqli_query($connection, $query);
            $rows = mysqli_num_rows($result);

            if($rows < 1) {
        ?>

        <div class="wrapper">
            <p style="text-align: center; margin-top: 20px; font-family: 'Roboto', sans-serif;">There are no Support Tickets at this time!</p>
        </div>

        <?php
                exit();
            }
        ?>


        <div class="wrapper">
        
            <div class="list-wrapper">
            
                <div class=list-header-info>

                    <p class="list-header-ticket">TICKET NAME</p>
                    <p class="list-header-user">CREATOR NAME</p>
                    <p class="list-header-date">CREATION DATE</p>
                    <p class="list-header-status">TICKET STATUS</p>

                </div>

                <hr>

                <?php

                while($ticket = mysqli_fetch_assoc($result)) {
                ?>


                <div class=list-info>

                    <p class="list-ticket"><a href="ticket?id=<?php echo($ticket['id']) ?>&page=1"><?php echo($ticket['title']); ?></a></p>
                    <p class="list-user"><?php echo(get_name($ticket['uuid'])); ?></p>
                    <p class="list-date"><?php echo($ticket['date']); ?></p>
                    <?php
                    
                    if($ticket['resolved'] == -1) {
                
                    ?>
                    <p class="list-status-pending" style="color:white;">PENDING</p>
                    <?php
                        } elseif($ticket['resolved'] == 0) {
                    ?>
                    <p class="list-status-denied" style="color:white;">DENIED</p>
                    <?php
                        } elseif($ticket['resolved'] == 1) {
                    ?>  
                    <p class="list-status-accepted" style="color:white;">ACCEPTED</p>
                    <?php
                    }
                    ?>
                    

                </div>

                <?php
                }
                ?>


            </div>
        </div>
        <?php
            include 'footer.php';
         ?>
    </body>

</html>
