<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "medicall");


if (isset($_POST['query'])) {
    //$query =

    // Sanitize the search query
    $search = mysqli_real_escape_string($link, $_POST['query']);

    // Create the SQL query
    $sql =
        "SELECT loc_name,amb_name,amb_type FROM location INNER JOIN ambulance ON location.locationId = ambulance.locationId WHERE location.loc_name LIKE '%$search%' LIMIT 2";
    // SELECT loc_name,amb_name,amb_type FROM location INNER JOIN ambulance ON location.locationId = ambulance.locationId WHERE location.loc_name LIKE '%$search%' LIMIT 2

    // Execute the query
    $result = mysqli_query($link, $sql);
    foreach ($result as $data) {
?>

        <!-- <span><?php
                    //echo $data['amb_name']; 
                    ?></span> -->
<?php
    }
    // if (mysqli_num_rows($result) > 0) {
    //     # code...
    //     while ($rows = mysqli_fetch_all($result, MYSQLI_ASSOC)) {
    //         // $user__loc = $rows['loc_name'];
    //         // echo "Location" . $user__loc;
    //         // $amb_name = $row['amb_name'];
    //         // $amb_type = $row['amb_type'];
    //         echo json_encode($rows);
    //         //echo json_decode($row);
    //     }
    // }
}
