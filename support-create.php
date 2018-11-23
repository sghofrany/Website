<?php
session_start();
require 'support-database.php';

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
$date = date("Y-m-d H:m:s");

$exists = "SELECT * FROM ticket WHERE uuid='$uuid'";

$result = mysqli_query($connection, $exists);
$rows = mysqli_num_rows($result);

if($rows > 0) {
    //header("Location: support.php");
    exit();
}

//echo("<br>" . $uuid . "<br>" . $title . "<br>" . $body . "<br>" . $date);

$query = "INSERT INTO ticket (uuid, title, body, date) VALUES ('$uuid', '$title', '$body', '$date')";

mysqli_query($connection, $query);

$connection->close();

header("Location: support-list.php");
