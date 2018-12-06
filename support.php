<?php
require 'header.php';
?>


<!DOCTYPE html>
<html>
<head>
	<title>PvPTemple</title>
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
        <p style="text-align: center; margin-top: 20px;">You need to be <a href="index.php">logged</a> in before making a support ticket!</p>
    </div>

    <?php
            exit();
        }
    ?>

    <div class="wrapper">
        <form action="support-create.php" method="POST">
          <div class="form-group" style="margin-top: 30px;">
            <label for="titleFrom">Title</label>
            <input type="text" class="form-control" id="titleFrom" placeholder="Title of your post" name="support-title">
          </div>

          <div class="form-group">
            <label for="textAreaForm">Reason</label>
            <textarea class="form-control" id="textAreaForm" rows="5" placeholder="Explain your reasoning behind this post" name="support-body"></textarea>
          </div>

         <div class="col-xs-1">
            <button type="submit" class="btn btn-primary" name="support-submit">Submit</button>

            <a onclick="location.href='support-list.php'" class="btn btn-warning">Current Tickets</a>
         </div>

        </form>
    </div>

</body>

</html>
