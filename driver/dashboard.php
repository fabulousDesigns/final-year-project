<?php
require('../utils/config.php');
include("auth_session.php");
$driver_name = $_SESSION["dusername"];
$sql = "SELECT profImg FROM driver WHERE dusername = '$driver_name'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$filePath = $row['profImg'];
//mysqli_close($con);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#sidebar a").click(function(e) {
                e.preventDefault(); // prevent the link from navigating to a new page
                var url = $(this).attr("href"); // get the URL of the link that was clicked
                $("#content").load(url); // load the PHP page into the content div
            });
        });
    </script>
</head>

<body>

    <div class="sidenav">
        <div class="profile">
            <?php
            // Display image on HTML page
            echo "<img src='$filePath' class='img' width='100px' alt='profImage'>";
            ?>
            <p class="prof__name"><?php echo $driver_name ?></p>
        </div>
        <div class="links" id="sidebar">
            <a href="request.php">Request</a>
            <a href="profile.php">Profile</a>
        </div>
        <div class="logout">
            <a href="logout.php">logout</a>
        </div>
    </div>

    <div class="main">
        <div class="top__bar">
            <nav>
                <p>Hi, <b><?php echo htmlspecialchars($_SESSION["dusername"]); ?></b></p>
                <p id="date">Date</p>
            </nav>
        </div>
        <h3 class="dash__title">Dashboard</h3>
        <div id="content">

        </div>
    </div>
</body>
<script>
    var timeDisplay = document.getElementById("date");

    function refreshTime() {
        var dateString = new Date().toLocaleString("en-US", {
            timeZone: "Africa/Nairobi",
        });
        var formattedString = dateString.replace(", ", " - ");
        timeDisplay.innerHTML = formattedString;
    }

    setInterval(refreshTime, 1000);
</script>

</html>