<?php
session_start();

if(isset($_POST['logout']) == FALSE) {
    header("Location: index.php");
    exit();
}

if(isset($_SESSION['uuid']) == FALSE) {
    header("Location: index.php");
    exit();
}

if($_SESSION['status'] == 0) {
    header("Location: index.php");
    exit();
}

unset($_SESSION['uuid']);
$_SESSION['status'] = 0;
header("Location: index.php");
session_destroy();
