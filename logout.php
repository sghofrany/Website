<?php
session_start();

if(isset($_POST['logout']) == FALSE) {
    header("Location: index");
    exit();
}

if(isset($_SESSION['uuid']) == FALSE) {
    header("Location: index");
    exit();
}

if($_SESSION['status'] == 0) {
    header("Location: index");
    exit();
}

unset($_SESSION['uuid']);
$_SESSION['status'] = 0;
header("Location: index");
session_destroy();
