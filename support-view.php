<?php
include 'header.php';
?>


<!DOCTYPE html>
<html>
<head>
	<title>PvPTemple - Support</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/support.css">
</head>

    <?php


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

<body style="background-color: #ffffe5;">

    <div class="jumbotron">
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

        <div class="wrapper" style="background-color: #ffffe5;">
            
            <div class="title-wrapper" style="background-color: white;">
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
                        <li><img src="https://crafatar.com/avatars/<?php echo($info['uuid']) ?>?size=80&default=MHF_Steve&overlay"></li>
                        <li id="user"><a href="user.php?id=<?php echo($info['uuid']); ?>"><?php echo(get_name($info['uuid'])); ?></a></li>
                        <li><?php echo($info['date']) ?></li>
                    </ul>
                </div>
                
                <div class="reply">
                    <ul class="reply-list">
                        <li><p class="text"><?php echo($info['body']); ?></p></li>
                    </ul>
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
            } else {
            ?>
            
<!--
            <form action="reply-create.php?id=<?php echo($info['id']) ?>" method="POST">

                <textarea disabled class="form-control" id="replyAreaForm" rows="5" placeholder="Post reply" name="reply-body"></textarea>
-->

          <!--      <button type="submit" class="reply-button" name="reply-submit">Reply</button>
                <br>-->
<!--                 <br>
            </form>  
            -->
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
            <div class="wrapper">
                <div class="reply-wrapper"> 
                    <div class="user">
                        <ul class="user-info">
                            <li><img src="https://crafatar.com/avatars/<?php echo($reply['uuid']); ?>?size=80&default=MHF_Steve&overlay"></li>
                            <li id="user"><a href="user.php?id=<?php echo($reply['uuid']); ?>"><?php echo(get_name($reply['uuid'])); ?></a></li>
                            <li><?php echo($reply['date']); ?></li>
                        </ul>
                    </div>

                    <div class="reply">
                        <ul class="reply-list">
                            <li><p class="text"><?php echo($reply['text']); ?></p></li>
                        </ul>

                    </div>
                </div> 
            </div>
            <?php
              }
            ?>
    
</body>

</html>
