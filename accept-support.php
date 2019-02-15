<?php
session_start();
require 'database/support-database.php';
require 'libs/utils.php';

if(!isset($_POST['accept-submit'])) {
     header("Location: support");
    exit();
}

if(!has_modify_permission($_SESSION['uuid'])) {
    header("Location: support-list");
    exit();
}

//Check if user has permission

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: support");
    exit();
}

$resolved = 1;
$resolved_uuid = $_SESSION['uuid'];
$tid = $_GET['id'];

$query = "UPDATE ticket SET resolved='$resolved',resolved_uuid='$resolved_uuid' WHERE id='$tid'";

echo($tid);

if($connection->query($query) === TRUE) {
    header("Location: ticket?id=" . $tid . "&page=1");
    $connection->close();
    exit();
}

$connection->close();

//header("Location: support-list");
