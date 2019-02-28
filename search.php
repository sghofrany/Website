<?php

require 'header.php';

if(!isset($_GET['search'])) {
    // header('Location: index');
    exit();
}

require 'database/rank-database.php';

$search = mysqli_real_escape_string($connection, $_GET['search']);

$query = "SELECT * FROM players WHERE name='$search'";
$result = mysqli_query($connection, $query);

$rows = mysqli_num_rows($result);

if($rows < 1) {
    echo("
    <div class='wrapper'>
        <p style='margin-top: 30px;'>No player with that name could be found!</p> 
    </div>
    ");
    exit();
}

$info = mysqli_fetch_assoc($result);

$name = $info['name'];
$uuid = $info['uuid'];

mysqli_close($connection);

header("Location: user?name=$name");
