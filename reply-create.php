<?php
session_start();
require 'database/support-database.php';

if(!isset($_POST['reply-submit'])) {
    header("Location: support");
    exit();
}

if(empty($_POST['editor'])) {
    header("Location: support");
    exit();
}

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: support");
    exit();
}

$uuid = $_SESSION['uuid'];
$tid = mysqli_real_escape_string($connection, $_GET['id']);

$body = mysqli_real_escape_string($connection, $_POST['editor']);

$date = date("Y-m-d");

$query = "INSERT INTO replies (tid, uuid, text, date) VALUES ('$tid','$uuid', '$body', '$date')";

mysqli_query($connection, $query);

echo($tid);

$connection->close();

header("Location: ticket?id=" . $tid . "&page=1");

