<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "users";

$connection = mysqli_connect($servername, $username, $password, $database);

echo("Connected!");
