<?php
include 'header.php';
?>


<!DOCTYPE html>
<html>
<head>
	<title>PvPTemple</title>
    <link rel="stylesheet" type="text/css" href="css/support.css">
</head>

    <?php

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(isset($_POST['support-submit'])) {
            require 'support-create.php';
        }
    }

  ?>

<body>

    <div class="jumbotron">
    </div>

    <?php
        if(!isset($_SESSION['status']) || $_SESSION['status'] == 0) {
    ?>

    <div class="container">
        <h3 style="text-align: center;">You need to be <a href="index.php">logged</a> in before making a support ticket!</h3>
    </div>

    <?php
            exit();
        }
    ?>

    <div class="container">
        <form action="support-create.php" method="POST">
          <div class="form-group">
            <label for="titleFrom">Title</label>
            <input type="text" class="form-control" id="titleFrom" placeholder="Title of your post" name="support-title">
          </div>

          <div class="form-group">
            <label for="textAreaForm">Reason</label>
            <textarea class="form-control" id="textAreaForm" rows="10" placeholder="Explain your reasoning behind this post" name="support-body">Reason: </textarea>
          </div>

         <div class="col-xs-1">
            <button type="submit" class="btn btn-primary" name="support-submit">Submit</button>

            <a onclick="location.href='support-list.php'" class="btn btn-warning">Current Tickets</a>
         </div>

        </form>
    </div>

</body>

</html>
