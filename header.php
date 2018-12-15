<?php
require 'libs/utils.php';
session_start();
?>


<html>
    <head>

        <title>PvPTemple</title>
        
        <link rel="stylesheet" type="text/css" href="css/header.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="stylesheet" type="text/css" href="css/reply.css">

        <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        
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
    /*
    Creating an array of already searched UUID's matched with their Name
    */
    if(!isset($_SESSION['usernames'])) {
         $_SESSION['usernames'] = array();
    }

    if(!isset($_SESSION['cache_uuid'])) {
        $_SESSION['cache_uuid'] = array();
    }

    /*
    Login/Logout checks
    */
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(isset($_POST['login'])) {
            require 'login.php';

        } elseif(isset($_POST['logout'])) {

            if($_SESSION['status'] == 1) {
                require 'logout.php';
            }
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
                    
                    <li class="right-li"><a id="alert-count" href="#">(2)</a></li>
                    <li id="alert" class="right-li"><i class="far fa-bell"></i></li>
                </form>

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
            <label id="subtext" class="banner-subtext">connect</label>
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
    
    </body>
</html>
