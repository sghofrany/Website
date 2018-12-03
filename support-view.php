<?php
include 'libs/utils.php';
require_once 'libs/Parsedown.php';
session_start();
?>


<!DOCTYPE html>
<html>
<head>
	<title>PvPTemple - Support</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/support.css">
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
    $parse = new Parsedown();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(isset($_POST['reply-submit'])) {
            require 'reply-create.php';
        } elseif(isset($_POST['accept-submit'])) {
             require 'accept-support.php';
        } elseif(isset($_POST['deny-submit'])) {
            require 'deny-support.php';
        }
    }
    
    ?>

<body style="background-color: #f2f3f4;">

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

    <!-- <div class="wrapper" style="background-color: #f2f3f4;">
		<div class="reply-wrapper" style="background-color: white;"> 
			<div class="user">
				<ul class="user-info">
					<li><img src="https://crafatar.com/avatars/?size=80&default=MHF_Steve&overlay"></li>
					<li id="user"><a href="#">User</a></li>
					<li>Date</li>
				</ul>
			</div>

			<div class="reply">
				
				<p>aaaaaaaaaaaaaaaaaaaAaaaaaAaaaaaAaaaaaAaaaaaAaaaaaAaaaaaAaaaaaAaaaaaAaaaaaAaaaaaAaaaaaAaaaaaAaaaaaAaaaaaAaaaaaAaaaaaAaaaaaAaaaaaAaaaaaA</p>

			</div>
		</div> 
	</div> -->

    <?php

        if(!isset($_SESSION['status']) || $_SESSION['status'] == 0) {

    ?>


    <div class="warpper">

        <h3>You need to be <a href="index.php">logged</a> in before viewing support tickets!</h3>

    </div>

    <?php
            exit();
        }
    ?>


    <?php

        require 'database/support-database.php';

        if(!isset($_GET['id'])) {
            header("Location: support-list.php");
            exit();
        }

        $id = $_GET['id'];

        $query = "SELECT * FROM ticket WHERE id='$id'";
        $result = mysqli_query($connection, $query);
    
        $rows = mysqli_num_rows($result);

        if(!$result || $rows < 1) {
    ?>

    <h3>There are no support ticket with that ID!</h3>

    <?php
            exit();
        }

      $info = mysqli_fetch_assoc($result);
    ?>

        <div class="wrapper" style="background-color: #f2f3f4;">
            
            <div class="title-wrapper" style="background-color: white; margin-top: 20px;">
                <div class="title">
                    <p id="title"><?php echo($info['title']); ?></p>
                    <?php
                        if($info['resolved'] == -1) {
                    ?>
                     <p id="resolved" style="background-color: #f2c521;">Pending</p>
                     
                    <?php 
                        } elseif($info['resolved'] == 0) {     
                    ?>
                    
                    <p id="resolved" style="background-color: #f25f54;">Denied</p>
                    
                    <?php 
                        } elseif($info['resolved'] == 1) {  
                     ?> 
                    
                    <p id="resolved" style="background-color: #7fc47f;">Accepted</p>
                    
                    <?php 
                        }
                    ?> 
                            
                </div>
            </div>
            
            <div class="reply-wrapper" style="background-color: white;"> 
                <div class="user">
                    <ul class="user-info">
                        <li><img id="image" src="https://crafatar.com/avatars/<?php echo($info['uuid']) ?>?size=80&default=MHF_Steve&overlay"></li>
                        <li id="user"><a href="user.php?id=<?php echo($info['uuid']); ?>"><?php echo(get_name($info['uuid'])); ?></a></li>
                        <li><?php echo($info['date']) ?></li>
                    </ul>
                </div>
                <div class="reply">   
                    <p><?php echo($parse->text($info['body'])); ?></p>
                </div>
            </div> 
            
            <?php
                if($info['resolved'] < 0) {
            ?>
            
            <div class="button-wrapper">
                <form action="accept-support.php?id=<?php echo($info['id']) ?>" method="POST">
                    <button type="submit" class="accept-button" name="accept-submit">Accept</button>     
                </form>

                <form action="deny-support.php?id=<?php echo($info['id']) ?>" method="POST">
                    <button type="submit" class="deny-button" name="deny-submit">Deny</button>
                </form>
            </div>
            <br>
            <?php               
                } elseif($info['resolved'] == 0) {
            ?>
                <p id="accepted-message">Denied by <?php echo(get_name($info['resolved_uuid'])) ?></p>
    
            <?php
              
                } elseif($info['resolved'] == 1) {
              
            ?>
                <p id="accepted-message">Accepted by <?php echo(get_name($info['resolved_uuid'])) ?></p>
            <?php
            
                }
            ?>
            
            <br>
            <hr>
            <br>
           
            <?php
                
            if($info['resolved'] < 0) {
                
            ?>
            
            <form action="reply-create.php?id=<?php echo($info['id']) ?>" method="POST">

                <textarea class="form-control" id="replyAreaForm" rows="5" placeholder="Post reply" name="reply-body"></textarea>

                <button type="submit" class="reply-button" name="reply-submit">Reply</button>
                <br>
                 <br>
            </form>
            
            <?php
            } 
            ?>
        </div>
  

        <?php
                  
            $query = "SELECT * FROM replies WHERE tid='$id'";
            $result = mysqli_query($connection, $query);
    
            $rows = mysqli_num_rows($result);
            
                    if(!$result || $rows < 1) {
            ?>
            <?php
                    exit();
                }
            
              while($reply = mysqli_fetch_assoc($result)) {
                  
            ?>
            <div class="wrapper" style="background-color: #f2f3f4;">
                <div class="reply-wrapper" style="background-color: white;"> 
                    <div class="user">
                        <ul class="user-info">
                            <li><img id="image" src="https://crafatar.com/avatars/<?php echo($reply['uuid']); ?>?size=80&default=MHF_Steve&overlay"></li>
                            <li id="user"><a href="user.php?id=<?php echo($reply['uuid']); ?>"><?php echo(get_name($reply['uuid'])); ?></a></li>
                            <li><?php echo($reply['date']); ?></li>
                        </ul>
                    </div>

                    <div class="reply">   
                        <p><?php echo($parse->text(check_tag($reply['text']))); ?></p>
                    </div>
            
                </div> 
            </div>
            <?php
              }
            ?>
    
</body>

</html>
