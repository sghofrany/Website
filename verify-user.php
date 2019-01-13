<?php

session_start();
require 'database/database.php';
include 'libs/utils.php';

if(!isset($_POST['verify_button'])) {

    header("Location: verify");
    exit();
}

$key = mysqli_real_escape_string($connection, $_POST['key']);
$password = mysqli_real_escape_string($connection, $_POST['password']);
$username = mysqli_real_escape_string($connection, $_POST['username']);

$uuid = get_uuid($username);
$uuid = ugly_uuid($uuid);

$_SESSION['status'] = 0;

//Requested Method is not POST
if($_SERVER['REQUEST_METHOD'] != 'POST') {
    exit();
}

//Inputs are empty
if(empty($key) || empty($password) || empty($username)) {
    header("Location: verify");
    exit();
}

$query = "SELECT * FROM user WHERE password_key='$key' AND uuid='$uuid'";
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
