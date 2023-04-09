<?php
error_reporting(0);
require('../utils/config.php');
include("auth_session.php");
//echo $user_id;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['User_name'];
    //$email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['u_From'];
    $destination = $_POST['destination'];
    $ambulance = $_POST['ambulance'];
    // $pickupLocation = $_POST['pickup_location'];
    // $pickupDate = $_POST['pickup_date'];
    // $pickupTime = $_POST['pickup_time'];
    // $additionalInfo = $_POST['additional_info'];
    $user = $_SESSION['username'];
    //echo $user; 
    // get logged in user ID
    $query = "SELECT id FROM users WHERE username = '$user'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['id'];
    // check if user has already booked an ambulance
    $q = "SELECT * FROM booking WHERE userId = '$user_id'";
    $processQ = mysqli_query($con, $q);
    if (mysqli_num_rows($processQ) > 0) {
        echo '<script type="text/javascript">
    $(document).ready(function() {
        swal({
            title: "warning!",
            text: "Already booked an ambulance!!",
            icon: "warning",
            button: "Ok",
        });
    });
</script>';
    } else {
        $ambulance = $_POST['ambulance'];
        $amb = "SELECT ambId,amb_type,status,loc_name FROM ambulance INNER JOIN location ON ambulance.locationId = location.locationId WHERE ambId='$ambulance'";
        $ambres = mysqli_query($con, $amb);
        $pAmbRes = mysqli_fetch_assoc($ambres);
        $ambId = $pAmbRes['status'];
        $ambUID = $pAmbRes['ambId'];
        if ($ambId === 'Booked') {
            echo '<script type="text/javascript">
    $(document).ready(function() {
        swal({
            title: "warning!",
            text: "The ambulance you choose is already Booked😪!!",
            icon: "warning",
            button: "Ok",
        });
    });
</script>';
        } else {
            $dQuery = "SELECT driverId, driver_name FROM `driver` WHERE ambId= '$ambUID'";
            $dQres = mysqli_query($con, $dQuery);
            $pdQres = mysqli_fetch_assoc($dQres);
            $driverId = $pdQres['driverId'];
            $driver_name = $pdQres['driver_name'];
            $sql = "INSERT INTO booking (username,phone,u_from,ambulance,destination,driverName,userId) VALUES ('$name', '$phone', '$address','$ambulance', '$destination','$driver_name', '$user_id')";
            if (mysqli_query($con, $sql)) {
                $updateAmbulanceStatus = "UPDATE ambulance SET status ='Booked' WHERE ambId = $ambulance";
                mysqli_query($con, $updateAmbulanceStatus);
                echo '<script type="text/javascript">
                $(document).ready(function() {
                    swal({
                        title: "Booked!",
                        text: "You have booked an ambulance🙌✔!!",
                        icon: "success",
                        button: "Ok",
                    });
                });
            </script>';
                // // Update ambulance booking statu
                $updateUserBookingStatus = "UPDATE users SET book_status='true' WHERE  id = '$user_id'";
                mysqli_query($con, $updateUserBookingStatus);
            } else {
                echo 'Error: ' . mysqli_error($con);
            }
        }

        //echo $ambId;
    }
    mysqli_close($con);
}
