<?php
require 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>PvPTemple</title>
</head>

<body>

    <!-- Changing the subtext of the banner to whatever the page is -->
    <script>
        document.getElementById('subtext').innerHTML = "welcome";
    </script>

    <div class="wrapper">

        <div class="info-wrapper">
            <div class="info">
                <div class="info-title" id="ticket-title">
                    <p>NETWORK SUPPORT</p>
                </div>

                <div class="info-body">
                    <p>Here at PvPTemple, we strive to provide the best possible support for our players. We offer a ticket system here on our website which includes appeals, staff applications, and overall general support (reporting, etc..)</p>
                </div>

                <div class="ticket-info"><p><a href="#">create a ticket</a></p></div>
            </div>

            <div class="info">
                <div class="info-title" id="about-title">
                    <p>ABOUT US</p>
                </div>

                <div class="info-body">
                    <p>Here at PvPTemple, we strive to provide the best possible support for our players. We offer a ticket system here on our website which includes appeals, staff applications, and overall general support (reporting, etc..)</p>
                </div>
            </div>

            <div class="info" id="no-margin">
                <div class="info-title" id="staff-title">
                    <p>OUR TEAM</p>
                </div>
                
                <div class="info-body">
                    <p>Here at PvPTemple, we strive to provide the best possible support for our players. We offer a ticket system here on our website which includes appeals, staff applications, and overall general support (reporting, etc..)</p>
                </div>

                <div class="staff-info"><p><a href="#">view our staff team</a></p></div>
            </div>
        </div>
    </div>
    <?php
    //require 'footer.php';
    ?>
</body>
</html>
