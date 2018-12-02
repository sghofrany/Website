<?php
//include 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>PvPTemple</title>
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">

    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">

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
    
    <div class="navigation">
        <ul class="left-nav">
            <li class="left-li"><a href="#">PvPTemple</a></li>
            <li class="left-li"><a href="#">Shop</a></li>
            <li class="left-li"><a href="#">Support</a></li>
        </ul>

        <ul class="right-nav">
            <li class="right-li"><a href="#">Login</a></li>
        </ul>
    </div>


    <div class="banner">
        <label class="banner-text">pvptemple</label>
    </div>
    
    <div class="wrapper">

        <div class="info">
            <p class="info-text">Some text about PvPTemple</p>
        </div>

    </div>

</body>
</html>
