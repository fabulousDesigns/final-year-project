<?php
require('../utils/config.php');
$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];
$sql = "SELECT * FROM booking WHERE booked_At BETWEEN '$start_date' AND '$end_date'";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["phone"] . "</td>";
        echo "<td>" . $row["driverName"] . "</td>";
        echo "<td>" . $row["booked_At"] . "</td>";
        echo "<td>" . $row["destination"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No bookings found</td></tr>";
}

$con->close();
?>
``