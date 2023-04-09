<?php
require('../utils/config.php');
// Query to retrieve country names
$query = "SELECT locationId, loc_name FROM location";

// Execute query and fetch data
$result = mysqli_query($con, $query);

// Create array to store data
$data = array();

// Loop through the result set and add each country name to the array
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Output data in JSON format
echo json_encode($data);

// Close database connection
mysqli_close($con);
