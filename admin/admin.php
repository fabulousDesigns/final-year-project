<?php
require('../utils/config.php');
include("auth_session.php");
$q1 = "SELECT COUNT(*) AS t_location
FROM location";
$runQ1 = mysqli_query($con, $q1);
$row1 = mysqli_fetch_assoc($runQ1);
$q2 = "SELECT COUNT(*) AS t_users
FROM users";
$runQ2 = mysqli_query($con, $q2);
$row2 = mysqli_fetch_assoc($runQ2);
$q3 = "SELECT COUNT(*) AS t_ambs
FROM ambulance";
$runQ3 = mysqli_query($con, $q3);
$row3 = mysqli_fetch_assoc($runQ3);
$q4 = "SELECT COUNT(*) AS drivers
FROM driver";
$runQ4 = mysqli_query($con, $q4);
$row4 = mysqli_fetch_assoc($runQ4);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ADMIN</title>
  <link rel="stylesheet" href="style.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body>
  <div class="sidenav">
    <div class="top__info">
      <h4 class="admin__logo">ADMIN</h4>
    </div>
    <div class="links" id="sidebar">
      <a href="driver.php">Drivers</a>
      <a href="user.php">users</a>
      <a href="report.php">Report</a>
    </div>
    <div class="footer">
      <a href="logout.php">logout</a>
    </div>
  </div>

  <div class="main" id="mai">
    <div class="top__nav">
      <p><b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></p>
      <p id="date">DATE</p>
    </div>
    <div id="content">
      <div class="summary">
        <h4>Summary</h4>
        <div class="sum__boxes">
          <div class="summary__box">Total Locations <br><?php echo $row1['t_location'] ?></div>
          <div class="summary__box">Total Users <br><?php echo $row2['t_users'] ?></div>
          <div class="summary__box">Total ambulances <br><?php echo $row3['t_ambs'] ?></div>
          <div class="summary__box">Total Drivers <br><?php echo $row4['drivers'] ?></div>
        </div>
      </div>
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
<script>
  $(document).ready(function() {
    $("#sidebar a").click(function(e) {
      e.preventDefault(); // prevent the link from navigating to a new page
      var url = $(this).attr("href"); // get the URL of the link that was clicked
      $("#content").load(url); // load the PHP page into the content div
    });
  });
</script>

</html>