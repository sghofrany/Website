<?php
require 'header.php';
?>


<!DOCTYPE html>
<html>
<head>
	<title>PvPTemple</title>
    <link rel="stylesheet" type="text/css" href="css/support-list.css">
    <link rel="stylesheet" type="text/css" href="css/support.css">
    
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>

    <?php

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(isset($_POST['support-submit'])) {
            require 'support-create.php';
        }
    }

  ?>

<body>

    <script>
    document.getElementById('subtext').innerHTML = "support";
    </script>

    <?php
        if(!logged_in()) {
    ?>

    <div class="wrapper">
        <div class="not-logged-wrapper">
            <p class="not-logged">You need to be <a href="index">logged</a> in before making a support ticket!</p>
        </div>

    </div>

    <?php
            exit();

        }
    ?>

    <div class="wrapper">

        <?php
            if(pending_tickets($_SESSION['uuid']) !== 0) {
        ?>

        <div class="list-wrapper">

            <div class=list-header-info style="margin-bottom: 20px;">

                <p class="list-header-ticket">TICKET NAME</p>
                <p class="list-header-user">CREATOR NAME</p>
                <p class="list-header-date">CREATION DATE</p>
                <p class="list-header-status">TICKET STATUS</p>

            </div>

            <hr>

            <?php

            $result = pending_tickets($_SESSION['uuid']);

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
                <p class="list-status-pending" style="color:white;">ACCEPTED</p>
                <?php
                }
                ?>

            </div>
            <?php
            }
            ?>



        </div>

        <div class="button-wrapper">

            <?php
                if(has_view_permission($_SESSION['uuid'])) {
            ?>
            
            <a onclick="location.href='support-list'" class="admin-button" style="color: white;">ADMIN VIEW</a>
            
            <?php
                }
            ?>
            
         </div>

        <?php
           exit();
           } 
        ?>

        <div>
           
           <div class="support-info-wrapper">
                <p class="support-title">NETWORK SUPPORT</p>
                <p class="support-body">The worse hand disappears across the fiddle. Whatever vicar scatters the nervous outline. The cooling revenue denotes the arrow. A stroke institutes each alphabet The worse hand disappears across the fiddle. Whatever vicar scatters the nervous outline. The cooling revenue denotes the arrow. A stroke institutes each alphabet.The worse hand disappears across the fiddle. Whatever vicar scatters the nervous outline. The cooling revenue denotes the arrow. A stroke institutes each alphabet.</p>
           
           </div>
        
        </div>


        <form action="support-create" method="POST">
          <div class="form-group" style="margin-top: 30px;">
            <input class="support-text-title" type="text" placeholder="Title of your post" name="support-title">
          </div>

          <div class="form-group">
            <textarea class="support-text-body" placeholder="Explain your reasoning behind this post" name="support-body"></textarea>
          </div>

         <div class="button-wrapper">
            <button type="submit" class="submit-button" name="support-submit">CREATE</button>

            <?php
                if(has_view_permission($_SESSION['uuid'])) {
            ?>
            
            <a onclick="location.href='support-list'" class="admin-button" style="color: white;">ADMIN VIEW</a>
            
            <?php
                }
            ?>
            
         </div>

        </form>
    </div>

</body>

</html>
