<?php
    require 'header.php';


?>

<html>

    <head>
        <title>Test</title>
        <link rel="stylesheet" type="text/css" href="css/test.css">
    </head>

<body>
    
    <div class="wrapper">
    
       <div class="list-wrapper">

            <div class=list-header-info style="margin-bottom: 20px;">

                <p class="list-header-ticket">TICKET NAME</p>
                <p class="list-header-user">CREATOR NAME</p>
                <p class="list-header-date">CREATION DATE</p>
                <p class="list-header-status">TICKET STATUS</p>

            </div>

            <hr>

            <div class=list-info>

                <p class="list-ticket">some title that is long</p>
                <p class="list-user">Irantwomiles</p>
                <p class="list-date">2018-12-18</p>
                <p class="list-status-pending" style="color:white;">PENDING</p>

            </div>

            <div class=list-info>

                <p class="list-ticket">short</p>
                <p class="list-user">Irantwomiles1234</p>
                <p class="list-date">2018-12-18</p>
                <p class="list-status-accepted" style="color:white;">ACCEPTED</p>

            </div>

            <div class=list-info>

                <p class="list-ticket">some t long</p>
                <p class="list-user">name</p>
                <p class="list-date">2018-12-18</p>
                <p class="list-status-denied" style="color:white;">DENIED</p>

            </div>
       
       </div>

    </div>


</body>

</html>