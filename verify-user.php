<?php

session_start();
require 'database/database.php';
include 'libs/utils.php';

if(!isset($_POST['verify_button'])) {

    // header("Location: index");
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
    echo("<script> alert('Your account is already verified. To reset your password please do the command /resetpassword on the server at pvptemple.com!'); </script>");
    header("Location: index");
    exit();
}

$hash_password = password_hash($password, PASSWORD_DEFAULT);

echo($hash_password);

$update = "UPDATE user SET password_key='NULL', password='$hash_password'";

if(mysqli_query($connection, $update)) {
    echo("<script> alert('Verified, please login'); </script>");
    header("Location: index");
    exit();
} else {
    echo("<script> alert('Error, could not verify!'); </script>");
    header("Location: verify");
    exit();
}


// if($key == $password) {



//     header("Location: index");

// } else {
//     header("Location: index");
//     exit();
// }
