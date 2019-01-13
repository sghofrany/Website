<?php
session_start();
require 'database/support-database.php';

if(!isset($_POST['support-submit'])) {
    header("Location: support");
    exit();
}

if(empty($_POST['support-title']) || empty($_POST['support-body'])) {
    header("Location: support");
    exit();
}

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: support");
    exit();
}



$uuid = $_SESSION['uuid'];
$title = $_POST['support-title'];
$body = $_POST['support-body'];
$date = date("Y-m-d");
$resolved = -1;
$resolved_uuid = "";

$check = "SELECT * FROM ticket WHERE (resolved = -1 AND uuid = '$uuid')";

$check_result = mysqli_query($connection, $check);

$check_rows = mysqli_num_rows($check_result);


if($check_rows > 0) {
    header("Location: support");
    exit();
}

$query = "INSERT INTO ticket (uuid, title, body, date, resolved, resolved_uuid) VALUES ('$uuid', '$title', '$body', '$date', '$resolved', '$resolved_uuid')";

if($connection->query($query) === TRUE) {
    header("Location: support");
    $connection->close();
    exit();
} else {
    header("Location: support");
}

$connection->close();

