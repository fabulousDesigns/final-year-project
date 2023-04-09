<?php
require('../utils/config.php');

if (isset($_POST['submit'])) {
    # code...
    // Get the start and end dates from a form or some other source
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];



    // Prepare a SQL query to count the number of bookings between the start and end dates
    $sql = "SELECT COUNT(*) as booking_count FROM booking WHERE booked_At BETWEEN '$start_date' AND '$end_date'";

    // Execute the query
    $result = $con->query($sql);

    // Check for query errors
    if (!$result) {
        die("Query failed: " . $con->error);
    }

    // Get the result as an associative array
    $row = $result->fetch_assoc();

    // Output the number of bookings
    echo "Number of booking between $start_date and $end_date: " . $row['booking_count'];

    // Close the database connection
    $con->close();
}
