<?php

$servername = "66.70.180.204";
$username = "webapi";
$password = "00TjJqwnIUL5qous";
$database = "users";

// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "users";

$connection = mysqli_connect($servername, $username, $password, $database);
echo("Connection made");