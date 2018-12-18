<?php
session_start();
require 'database/support-database.php';

if(!isset($_POST['reply-submit'])) {
    header("Location: support.php");
    exit();
}

if(empty($_POST['editor'])) {
    header("Location: support.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: support.php");
    exit();
}

$uuid = $_SESSION['uuid'];
$tid = $_GET['id'];

$body = $_POST['editor'];

$date = date("Y-m-d");

$query = "INSERT INTO replies (tid, uuid, text, date) VALUES ('$tid','$uuid', '$body', '$date')";

mysqli_query($connection, $query);

echo($tid);

$connection->close();

header("Location: support-view.php?id=" . $tid);

