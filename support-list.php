<?php
include 'header.php';
?>


<!DOCTYPE html>
<html>
<head>
	<title>PvPTemple - Support</title>
    <link rel="stylesheet" type="text/css" href="css/support.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/ticket.css">
</head>

<?php

    function get_resolved($resolved) {
        
        if($resolved == 0) {
            return "Denied";
        } elseif($resolved == 1) {
            return "Accepted";
        }
        
        
        return "Pending";
        
    }
    
?>
    
<body style="background-color: white;">

    <div class="jumbotron">
    </div>

<!--
   <div class="wrapper" style="background-color: #ffffe5;">

        <div class="ticket-wrapper" style="background-color: white;">
           
            <div class="ticket-title">
                <p>Title</p>
            </div>

            <div class="ticket-sender">
                <p>Irantwomiles</p>
            </div>
            
            <div class="ticket-status">
                <p>Pending</p>
            </div>
        </div>
    
    </div>
-->
   
    <?php
        if(!isset($_SESSION['status']) || $_SESSION['status'] == 0) {

    ?>

    <div class="wrapper" style="text-align: center;">

        <h3>You need to be <a href="index.php">logged</a> in before viewing support tickets!</h3>

    </div>

    <?php
            exit();
        }
    ?>


    <?php

        require 'support-database.php';

        $query = "SELECT * FROM ticket";
        $result = mysqli_query($connection, $query);
        $rows = mysqli_num_rows($result);

        if($rows < 1) {
    ?>
    <div class="container">
            <h3 style="text-align: center;">There are no support tickets at this time!</h3>
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
               
               
                <td><a href="support-view.php?id=<?php echo($ticket['id']) ?>"><?php echo($ticket['title']); ?></a></td>
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
