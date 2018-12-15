<?php
    include 'database/rank-database.php';
    include 'libs/utils.php';

    $string = "05cc5c6a48534abfa4c807372696dc0f";

    get_rank($string);

?>

<html>

    <head>
        <title>Test</title>
        <link rel="stylesheet" type="text/css" href="css/reply.css">
    </head>

<body>
    
    <div class="wrapper">
    
        <div class="body-wrapper">
        
            <div class="user-wrapper">

                <div class="user-img">
                    <img id="avatar" src="https://crafatar.com/avatars/8667ba71-b85a-4004-af54-457a9734eed7?size=80&default=MHF_Steve&overlay" alt="">
                </div>
                
                <div class="user-name">
                    <p>Irantwomiles</p>
                </div>

                <div class="user-rank">
                    <p>Developer</p>
                </div>
            </div>

            <div class="text-wrapper">
                <p class="text">Here is some text for this paragraph</p>
            </div>

        </div>
    
    </div>


</body>

</html>