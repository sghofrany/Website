<?php
require 'header.php';
?>


<!DOCTYPE html>
<html>
<head>
	<title>PvPTemple</title>
    <link rel="stylesheet" type="text/css" href="css/ticket.css">
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
        <p style="text-align: center; margin-top: 20px; font-family: 'Roboto', sans-serif;">You need to be <a href="index">logged</a> in before making a support ticket!</p>
    </div>

    <?php
            exit();

        }
    ?>

    <div class="wrapper">

        <?php
            if(pending_tickets($_SESSION['uuid']) !== 0) {
        ?>

        <p style="margin-top: 20px; font-family: 'Roboto', sans-serif; text-align: center; font-size: 35px;">Current Ticket(s)</p>

        <table>
            <th>Title</th>
            <th>User</th>
            <th>Date</th>
            <th>Status</th>

            <?php

                $result = pending_tickets($_SESSION['uuid']);

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

        <div style="margin-top: 10px; color: white;">
            <a onclick="location.href='support-list'" class="btn btn-warning">Current Tickets</a>
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

            <a onclick="location.href='support-list'" class="admin-button" style="color: white;">ADMIN VIEW</a>
         </div>

        </form>
    </div>

</body>

</html>
