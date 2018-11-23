<?php
include 'header.php';
?>


<!DOCTYPE html>
<html>
<head>
	<title>PvPTemple - Support</title>
</head>

<body>

    <div class="jumbotron text-center">
      <h1>Support Tickets</h1>
    </div>

    <?php

        if(!isset($_SESSION['status']) || $_SESSION['status'] == 0) {

    ?>

    <div class="container">

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


    <div class="container">

        <table class="table table-bordered">
            <th>ID</th>
            <th>UUID</th>
            <th>Title</th>
            <th>Date</th>
    <?php

        while($ticket = mysqli_fetch_assoc($result)) {
    ?>

            <tr>
                <td><a href="support-view.php?id=<?php echo($ticket['id']) ?>"><?php echo($ticket['id']) ?></a></td>
                <td><?php echo($ticket['uuid']) ?></td>
                <td><?php echo($ticket['title']) ?></td>
                <td><?php echo($ticket['date']) ?></td>
            </tr>


    <?php
        }
    ?>

        </table>

    </div>


</body>

</html>
