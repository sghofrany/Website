<?php 

require 'header.php';

// if($_SERVER['REQUEST_METHOD'] == 'POST') {

//     if(isset($_POST['verify-users'])) {
//         require 'verify-user.php';
//     }
// }

?>

<html>

<body>

    <div class="wrapper">

        <form action="verify-user" method="POST">
            
            <div class="form-group">

                <label for="usr">Username</label>
                <input type=text id="usr" class="form-control" aria-describedby="emailHelp" placeholder="Enter your username" name="username">

            </div>

            <div class="form-group">
                <label for="pwd">Key</label>
                <input type=password class="form-control" id="verify" name="key" placeholder="key given in game">
            </div>

            <div class="form-group">
                <label for="pwd">Password</label>
                <input type=password class="form-control" id="pwd" name="password" placeholder="set your password">
            </div>



            <button type="submit" class="btn btn-info" name="verify_button">Verify</button>

        </form>
    </div>
    
    <?php
        include 'footer.php';
    ?>
</body>


</html>