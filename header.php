<?php
session_start();
?>


<html>
<head>
	<title>PvPTemple</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>

   <?php
    
    if(!isset($_SESSION['usernames'])) {
         $_SESSION['usernames'] = array();
    }
    
    function get_status() {
        if(isset($_SESSION['status'])) {
            return $_SESSION['status'];
        }
        
        return 0;
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(isset($_POST['login'])) {
            //If we click on submit, require the login.php file to run
            require 'login.php';

        } elseif(isset($_POST['logout'])) {

            if($_SESSION['status'] == 1) {
                require 'logout.php';
            }

        }

    }

  ?>

    <body>

        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">

       <a class="navbar-brand ml-" href="index.php"><img src="images/X5-2.png"></a>
        <ul class="navbar-nav">

            <li class="nav-item">
              <a href="support.php">Support</a>
            </li>
        </ul>

        <?php
          if(isset($_SESSION['status'])) {
              if($_SESSION['status'] == 1) {

        ?>

        <!-- USER IS LOGGED IN -->
        <a class="navbar-brand ml-auto" href="#">
            <img src="https://crafatar.com/avatars/<?php echo($_SESSION['uuid']) ?>?size=40&default=MHF_Steve&overlay">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <?php echo($_SESSION['name']); ?>
                </li>
                <li><a></a></li>
                <li class="nav-item">
                 <form action="logout.php" method="POST">
                    <button type="submit" class="btn btn-info" name="logout">Logout</button>
                </form>

                </li>
            </ul>
        </a>


        <?php
              } else {
        ?>
         <!-- USER IS LOGGED OUT -->
        <a class="navbar-brand ml-auto" href="#">
            <img src="https://crafatar.com/avatars/8667ba71-b85a-4004-af54-457a9734eed7?size=40&default=MHF_Steve&overlay">
        </a>
        <ul class="navbar-nav">
            <li class="nav-item">
               <button type="button" class="btn btn-info" data-toggle="modal" data-target="#loginModal" name="login">Login</button>
            </li>
        </ul>

    <?php
                  }
            } else {

    ?>
         <a class="navbar-brand ml-auto" href="#">
            <img src="https://crafatar.com/avatars/8667ba71-b85a-4004-af54-457a9734eed7?size=40&default=MHF_Steve&overlay">
        </a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#loginModal" name="login">Login</button>
            </li>
        </ul>
    <?php
          }
    ?>

    </nav>


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
