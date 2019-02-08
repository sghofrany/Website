<?php

require 'header.php';

if(!isset($_GET['search'])) {
    // header('Location: index');
    exit();
}

$search = $_GET['search'];

require 'database/rank-database.php';

$query = "SELECT * FROM players WHERE name='$search'";
$result = mysqli_query($connection, $query);

$info = mysqli_fetch_assoc($result);

$name = $info['name'];
$uuid = $info['uuid'];

mysqli_close($connection);

?>

<!DOCTYPE html>
<html>
<head>
    <title>PvPTemple</title>
    <link rel="stylesheet" type="text/css" href="css/search.css">
    <link rel="stylesheet" type="text/css" href="css/support.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

    <div class="wrapper">
   
        <!-- <h2>found player</h2> -->

        <div class="search-wrapper">
            <div class='search-img'>
                <img src='https://visage.surgeplay.com/head/128/<?php echo($uuid); ?>?tilt=0' alt='Staff Image'>
            </div>
            
            <div>
                <p class='search-name'>
                    <a href='user?name=<?php echo($name); ?>'><?php echo($name); ?></a>
                </p>
            </div>
        </div>

    </div>

</body>

</html>