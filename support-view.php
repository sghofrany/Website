<?php
include 'header.php';
?>


<!DOCTYPE html>
<html>
<head>
	<title>PvPTemple - Support</title>
    <link rel="stylesheet" type="text/css" href="support.css">
</head>

    <?php

    function get_name($uuid) {

        $uuid = str_replace("-", "", $_SESSION['uuid']);

        $json_response = file_get_contents('https://api.minetools.eu/uuid/' . $uuid);

        $obj = json_decode($json_response);

    return $obj->name;
}

    ?>

<body>

    <div class="jumbotron text-center">
      <h1>Support Tickets</h1>
    </div>

    <?php

        if(!isset($_SESSION['status']) || $_SESSION['status'] == 0) {

    ?>

    <div class="container">

        <h3>You need to be <a href="index.php">logged</a> in before viewing support tickets!</h3>

    </div>

    <?php
            exit();
        }
    ?>


    <?php

        require 'support-database.php';

        if(!isset($_GET['id'])) {
            header("Location: support-list.php");
            exit();
        }

        $id = $_GET['id'];

        $query = "SELECT * FROM ticket WHERE id='$id'";
        $result = mysqli_query($connection, $query);
        $rows = mysqli_num_rows($result);

        if($rows < 1) {
    ?>

    <h3>There are no support ticket with that ID!</h3>

    <?php
            exit();
        }

      $info = mysqli_fetch_assoc($result);
    ?>


    <div class="container">
        <h3>Ticket created by <a href="user.php?id=<?php echo($info['uuid']) ?>"><?php echo(get_name($info['uuid'])) ?></a></h3>
        <br>
        <h4>Title: <?php echo($info['title']); ?></h4>
        <br>
        <p>Body: <?php echo($info['body']); ?></p>
    </div>
</body>

</html>
