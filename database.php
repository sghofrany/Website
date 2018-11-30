<?php

$servername = "localhost";
$username = "root";
$password = "mysql";
$database = "users";

$connection = mysqli_connect($servername, $username, $password, $database);

echo("Connected!");
