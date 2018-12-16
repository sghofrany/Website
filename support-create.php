<?php
session_start();
require 'database/support-database.php';

if(!isset($_POST['support-submit'])) {
    header("Location: support.php");
    exit();
}

if(empty($_POST['support-title']) || empty($_POST['support-body'])) {
    header("Location: support.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: support.php");
    exit();
}

$uuid = $_SESSION['uuid'];
$title = $_POST['support-title'];
$body = $_POST['support-body'];
$date = "Date";
$resolved = -1;
$resolved_uuid = "";

$query = "INSERT INTO ticket (uuid, title, body, date, resolved, resolved_uuid) VALUES ('$uuid', '$title', '$body', '$date', '$resolved', '$resolved_uuid')";

if($connection->query($query) === TRUE) {
    header("Location: support-list.php");
    $connection->close();
    exit();
} else {
    echo("<br> What is going on?");
}

$connection->close();

