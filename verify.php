<?php 

require 'header.php';

?>

<html>

<body>

    <div class="wrapper">

        <form action="verify-user?key=<?php echo($_GET['key']); ?>" method="POST">

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