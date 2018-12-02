<?php
include 'libs/utils.php';
session_start();
?>


<!DOCTYPE html>
<html>
<head>
	<title>PvPTemple</title>
    <link rel="stylesheet" type="text/css" href="css/support.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">

    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

    <?php

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(isset($_POST['support-submit'])) {
            require 'support-create.php';
        }
    }

  ?>

<body>

    <div class="navigation">
        <ul class="left-nav">
            <li class="left-li"><a href="index.php">PvPTemple</a></li>
            <li class="left-li"><a href="#">Shop</a></li>
            <li class="left-li"><a href="support.php">Support</a></li>
        </ul>

        <ul class="right-nav">
            <?php
                if(logged_in()) {
            ?>
            <form class="form-wrapper" action="logout.php" method="POST">
                <button class="logout-button" type="submit" name="logout">Logout</button>
            </form>
            <li class="right-li"><a id="alert-count" href="#">(2)</a></li>
            <li id="alert" class="right-li"><i class="far fa-bell"></i></li>

            <?php
                } else  {
                  
            ?>
            <li class="right-li"><a href="#" data-toggle="modal" data-target="#loginModal">Login</a></li>
            
            <?php
               }
            ?>
        </ul>
    </div>


    <div class="banner">
        <label class="banner-text">pvptemple</label>
        <label class="banner-subtext">support</label>
    </div>

    <div id="loginModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <h3 id="title">Welcome to PvPTemple!</h3>
                </div>

                <div class="container">
                    <form action="login.php" method="POST">
                        <div class="form-group">

                            <label for="usr">  Email</label>
                            <input type=text id="usr" class="form-control" aria-describedby="emailHelp" placeholder="Enter your email" name="username">

                        </div>
                        <div class="form-group">
                            <label for="pwd">  Password</label>
                            <input type=password class="form-control" id="pwd" name="password" placeholder="*******">
                        </div>


                        <button type="submit" class="btn btn-info" name="login">Login</button>
                    </form>
                </div>



                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
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
