<?php
require_once 'libs/Parsedown.php';
include 'header.php';
?>


<!DOCTYPE html>
<html>
<head>
	<title>PvPTemple - Support</title>
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

<body style="background-color: #fbfbfb;">

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

        <div class="wrapper" style="background-color: #fbfbfb;">
            
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
            
            <div class="body-wrapper">

                <div class="user-wrapper">

                    <div class="user-img">
                        <img id="avatar" src="https://crafatar.com/avatars/<?php echo($info['uuid']) ?>?size=80&default=MHF_Steve&overlay">
                    </div>
                    
                    <div class="user-name">
                        <p><a href="user.php?name=<?php echo(get_name($info['uuid'])); ?>"><?php echo(get_name($info['uuid'])); ?></a></p>
                    </div>

                    <div class="user-date">
                        <p><?php echo($info['date']); ?></p>
                    </div>

                    <div class="user-rank">
                    <?php
                        
                        $player_rank = get_rank($info['uuid']);

                            if($player_rank === "Owner") {
                        ?>
                            <p id="owner"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Developer") {
                        ?>
                            <p id="developer"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Platform-Admin") {
                        ?>
                            <p id="plat-admin"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Senior-Admin") {
                        ?>
                            <p id="senior-admin"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Admin") {
                        ?>
                            <p id="admin"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Senior-Mod") {
                        ?>
                            <p id="senior-mod"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Mod") {
                        ?>
                            <p id="mod"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Partner") {
                        ?>
                            <p id="partner"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Famous") {
                        ?>
                            <p id="famous"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "YouTuber") {
                        ?>
                            <p id="youtuber"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Master") {
                        ?>
                            <p id="master"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Elite") {
                        ?>
                            <p id="elite"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Prime") {
                        ?>
                            <p id="prime"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Basic") {
                        ?>
                            <p id="basic"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Normal") {
                        ?>
                            <p id="normal"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Trainee") {
                        ?>
                            <p id="trainee"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Host") {
                        ?>
                            <p id="host"><?php echo($player_rank); ?></p>
                        <?php
                            }
                        ?>

                    </div>

                    <div class="user-status">

                        <?php
                            if(is_blacklisted($info['uuid'])) {
                        ?>
                            <p id="blacklisted">Blacklisted</p>
                        <?php
                            } elseif(is_banned($info['uuid'])) {
                        ?>
                            <p id="banned">Banned</p>
                        <?php
                            }
                        ?>

                    </div>
                </div>

                <div class="text-wrapper">
                    <p class="text"><?php echo($parse->text($info['body'])); ?></p>
                </div>

            </div>
            
            <?php
                if($info['resolved'] < 0 && has_permission($_SESSION['uuid'])) {
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

            <div class="wrapper">

            <div class="body-wrapper">
                
                <div class="user-wrapper">
                
                    <div class="user-img">
                        <img id="avatar" src="https://crafatar.com/avatars/<?php echo($reply['uuid']); ?>?size=80&default=MHF_Steve&overlay">
                    </div>
                    
                    <div class="user-name">
                        <p><a href="user.php?name=<?php echo(get_name($reply['uuid'])); ?>"><?php echo(get_name($reply['uuid'])); ?></a></p>
                    </div>

                    <div class="user-date">
                        <p><?php echo($reply['date']); ?></p>
                    </div>

                    <div class="user-rank">
                        <?php

                        $player_rank = get_rank($reply['uuid']);


                            if($player_rank === "Owner") {
                        ?>
                            <p id="owner"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Developer") {
                        ?>
                            <p id="developer"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Platform-Admin") {
                        ?>
                            <p id="plat-admin"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Senior-Admin") {
                        ?>
                            <p id="senior-admin"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Admin") {
                        ?>
                            <p id="admin"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Senior-Mod") {
                        ?>
                            <p id="senior-mod"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Mod") {
                        ?>
                            <p id="mod"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Partner") {
                        ?>
                            <p id="partner"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Famous") {
                        ?>
                            <p id="famous"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "YouTuber") {
                        ?>
                            <p id="youtuber"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Master") {
                        ?>
                            <p id="master"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Elite") {
                        ?>
                            <p id="elite"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Prime") {
                        ?>
                            <p id="prime"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Basic") {
                        ?>
                            <p id="basic"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Normal") {
                        ?>
                            <p id="normal"><?php echo($player_rank); ?></p>
                        <?php
                            } elseif($player_rank === "Trainee") {
                        ?>
                            <p id="trainee"><?php echo($player_rank); ?></p>
                        <?php
                            }
                        ?>

                    </div>

                    <div class="user-status">

                        <?php
                            if(is_blacklisted($reply['uuid'])) {
                        ?>
                            <p id="blacklisted">Blacklisted</p>
                        <?php
                            } elseif(is_banned($reply['uuid'])) {
                        ?>
                            <p id="banned">Banned</p>
                        <?php
                            }
                        ?>

                    </div>
                </div>

                <div class="text-wrapper">
                    <p><?php echo($parse->text(check_tag($reply['text']))); ?></p>
                </div>

            </div>

            </div>

            <?php
              }
            ?>
        </div>
    
</body>

</html>
