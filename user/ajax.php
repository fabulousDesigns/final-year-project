<?php
//Including Database configuration file.
include("../utils/config.php");
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
// $link = mysqli_connect("localhost", "root", "", "medicall");
if (isset($_POST['query'])) {
  //$query =
  // Sanitize the search query
  $search = mysqli_real_escape_string($con, $_POST['query']);
  // Create the SQL query
  $sql =
    "SELECT loc_name,amb_name,amb_type,status FROM location INNER JOIN ambulance ON location.locationId = ambulance.locationId WHERE location.loc_name LIKE '%$search%' LIMIT 2";
  // SELECT loc_name,amb_name,amb_type FROM location INNER JOIN ambulance ON location.locationId = ambulance.locationId WHERE location.loc_name LIKE '%$search%' LIMIT 2
  // Execute the query
  $result = mysqli_query($con, $sql);
  foreach ($result as $data) {
?>
    <!-- // <p></p> -->
    <div class="popup">
      <div class="top">
        <h2 class="user__loc"><?php
                              echo $data['loc_name'];
                              ?></h2>
        <p class="lead__amb"><i class="fa-solid fa-truck-medical"></i></p>
      </div>
      <div class="middle">
        <p>Amb Name: <span class="a__name"><?php
                                            echo $data['amb_name'];
                                            ?></span></p>
      </div>
      <div class="footer__status">
        <span class="badge"><?php
                            echo $data['status'];
                            ?></span>
      </div>
    </div>
<?php
  }
}
