<?php
session_start();
require 'database/database.php';
include 'libs/utils.php';

if(isset($_POST['login']) == FALSE) {
    header("Location: index");
    exit();
}

$email = mysqli_real_escape_string($connection, $_POST['username']);
$password = mysqli_real_escape_string($connection, $_POST['password']);
$_SESSION['status'] = 0;

//Requested Method is not POST
if($_SERVER['REQUEST_METHOD'] != 'POST') {
    exit();
}

//Inputs are empty
if(empty($email) || empty($password)) {
    header("Location: index");
    exit();
}

$query = "SELECT * FROM user WHERE email='$email'";
$result = mysqli_query($connection, $query);
$rows = mysqli_num_rows($result);

if($rows < 1) {
    header("Location: index");
    exit();
}

$info = mysqli_fetch_assoc($result);

$compare = mysqli_real_escape_string($connection, $info['password']);

if($password == $compare) {

    $_SESSION['status'] = 1;
    $_SESSION['uuid'] = $info['uuid'];
    $_SESSION['name'] = get_name($_SESSION['uuid']);
    header("Location: index");

} else {
    header("Location: index");
    exit();
}
