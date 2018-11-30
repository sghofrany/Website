<?php
session_start();


print_r($_SESSION['usernames']);

    <div class="wrapper" style="background-color: #ffffe5;">

        <?php
        while($ticket = mysqli_fetch_assoc($result)) {
        ?>
        
        <div class="ticket-wrapper" style="background-color: white;">
           
            <div class="ticket-title">
                <p><a href="support-view.php?id=<?php echo($ticket['id']) ?>"><?php echo($ticket['title']); ?></a></p>
            </div>

            <div class="ticket-sender">
                <p><?php echo(get_name($ticket['uuid'])); ?></p>
            </div>
            
            <?php
            if($ticket['resolved'] == -1) {

            ?>
            <div class="ticket-status">
                <p style="color: #f2c521;"><?php echo(get_resolved($ticket['resolved'])); ?></p>
            </div>
            
            <?php
                } elseif($ticket['resolved'] == 0) {
            ?>
            <div class="ticket-status">
                <p style="color: #f25f54;"><?php echo(get_resolved($ticket['resolved'])); ?></p>
            </div>
    
            <?php
                } elseif($ticket['resolved'] == 1) {
            ?>  
            <div class="ticket-status" style="background-color: #7fc47f;">
                <p ><?php echo(get_resolved($ticket['resolved'])); ?></p>
            </div>
            <?php
            }
            ?>
        </div>
        
        <?php
        }
        ?>
    </div>
