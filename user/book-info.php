 <?php
   $user_name = $_SESSION["username"];
   $sql = "SELECT id FROM users WHERE username = '$user_name'";
   $runSql = mysqli_query($con, $sql);
   $row = mysqli_fetch_assoc($runSql);
   $id = $row['id'];
   // display booking info
   $bookSql = "SELECT username,phone,u_from,ambulance,destination,booked_At FROM booking WHERE userId = $id";
   $runBookSql = mysqli_query($con, $bookSql);
   $row = mysqli_fetch_assoc($runBookSql);
   $location = $row["u_from"];
   $phone = $row['phone'];
   $ambulance = $row["ambulance"];
   $username = $row['username'];
   $destination = $row['destination'];
   $booked_At = $row['booked_At'];
   // // location
   // $sqlLoc = "SELECT loc_name FROM location WHERE locationId = $location ";
   // $resSqlLoc = mysqli_query($con, $sqlLoc);
   // $rowSqlLoc = mysqli_fetch_assoc($resSqlLoc);
   // $location = $rowSqlLoc['loc_name'];
   // // Ambulance
   // $sqlAmb = "SELECT amb_name, amb_type FROM ambulance WHERE ambId = $ambulance ";
   // $resSqlAmb = mysqli_query($con, $sqlAmb);
   // $rowSqlAmb = mysqli_fetch_assoc($resSqlAmb);
   // $ambulance = $rowSqlAmb['amb_name'];
   // $amb_type = $rowSqlAmb['amb_type'];

   // $data = array(
   //     "username" => $username,
   //     "phone" => $phone,
   //     "location" => $location,
   //     "ambulance" => $ambulance,
   //     "destination" => $destination,
   //     "booked_At" => $booked_At
   // );

   // // Return data in JSON format
   // header('Content-Type: application/json');
   // echo json_encode($data);
   ?>
 