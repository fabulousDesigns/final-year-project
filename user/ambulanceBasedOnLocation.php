<?php

// Connect to database
require('../utils/config.php');
// Get the selected country id
$locationId = $_GET['locationId'];

// Query to retrieve cities for the selected country
$query = "SELECT ambId, amb_name FROM ambulance WHERE locationId = $locationId";

// Execute query and fetch data
$result = mysqli_query($con, $query);

// Create array to store data
$data = array();

// Loop through the result set and add each city to the array
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Output data in JSON format
echo json_encode($data);

// Close database connection
mysqli_close($con);
