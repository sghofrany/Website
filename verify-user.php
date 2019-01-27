<?php

session_start();
require 'database/database.php';
include 'libs/utils.php';

if(!isset($_POST['verify_button'])) {
    header("Location: verify");
    exit();
}

if(!isset($_GET['key'])) {
    header("Location: index");
    exit();
}

$key = mysqli_real_escape_string($connection, $_GET['key']);

$password = mysqli_real_escape_string($connection, $_POST['password']);

$_SESSION['status'] = 0;

//Requested Method is not POST
if($_SERVER['REQUEST_METHOD'] != 'POST') {
    exit();
}

//Inputs are empty
if(empty($password)) {
    header("Location: verify?key=$key");
    exit();
}

$query = "SELECT * FROM user WHERE password_key='$key'";
$result = mysqli_query($connection, $query);
$rows = mysqli_num_rows($result);

if($rows < 1) {
    header("Location: index");
    exit();
}

$hash_password = password_hash($password, PASSWORD_DEFAULT);

$update = "UPDATE user SET password_key='NULL', password='$hash_password' WHERE password_key='$key'";

if(mysqli_query($connection, $update)) {
    header("Location: index");
    exit();
} else {
    header("Location: verify");
    exit();
}
