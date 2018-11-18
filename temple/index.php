<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>dssafasdfdsf</title>
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


    <?php
          if(isset($_SESSION['status'])) {
              if($_SESSION['status'] == 1) {

    ?>

        <!-- USER IS LOGGED IN -->
        <a class="navbar-brand ml-auto" href="#">
            <img src="https://crafatar.com/avatars/<?php echo($_SESSION['uuid']) ?>?size=40&default=MHF_Steve&overlay">
        </a>


        <?php
              } else {
        ?>
         <!-- USER IS LOGGED OUT -->
        <a class="navbar-brand ml-auto" href="#">
            <img src="https://crafatar.com/avatars/8667ba71-b85a-4004-af54-457a9734eed7?size=40&default=MHF_Steve&overlay">
        </a>

    <?php
                  }
            } else {

    ?>
         <a class="navbar-brand ml-auto" href="#">
            <img src="https://crafatar.com/avatars/8667ba71-b85a-4004-af54-457a9734eed7?size=40&default=MHF_Steve&overlay">
        </a>
    <?php
          }
    ?>

        <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">Link 1</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link 2</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link 3</a>
        </li>
      </ul>
    </nav>

    <div class="jumbotron text-center">
      <h1>PvPTemple</h1>
      <p>Home of competitive PvP!</p>
    </div>

    <?php
        if(isset($_SESSION['uuid'])) {
    ?>

    <img src="https://crafatar.com/avatars/<?php echo($_SESSION['uuid']) ?>?size=60&default=MHF_Steve&overlay">

    <?php
        }
    ?>

    <form action="login.php" method="POST">
        username <input type="text" name="username"><br>
        password <input type="password" name="password"><br>
        <input type="submit" value="Login" name="login">
    </form>

    <form action="logout.php" method="POST">
        <input type="submit" value="Logout" name="logout">
    </form>

</body>
</html>
