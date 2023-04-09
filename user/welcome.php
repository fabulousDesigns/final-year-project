<?php
//Initialize the session
//include auth_session.php file on all user panel pages
//include("auth_session.php");
error_reporting(0);
require('../utils/config.php');
include("auth_session.php");
$user_name = $_SESSION["username"];
$sql = "SELECT id,book_status FROM users WHERE username = '$user_name'";
$runSql = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($runSql);
$id = $row['id'];
$stat = $row['book_status'];
if ($stat === 'true') {
    # code...
    // display booking info
    $bookSql = "SELECT username,phone,u_from,ambulance,destination,booked_At FROM booking WHERE userId = $id";
    $runBookSql = mysqli_query($con, $bookSql);
    $row = mysqli_fetch_assoc($runBookSql);
    $location = $row['u_from'];

    $phone = $row['phone'];
    $ambulance = $row["ambulance"];
    $username = $row['username'];
    $destination = $row['destination'];
    $booked_At = $row['booked_At'];
    // location
    $sqlLoc = "SELECT loc_name FROM location WHERE locationId = $location ";
    $resSqlLoc = mysqli_query($con, $sqlLoc);
    $rowSqlLoc = mysqli_fetch_assoc($resSqlLoc);
    $location = $rowSqlLoc['loc_name'];
    //Ambulance
    $sqlAmb = "SELECT amb_name, amb_type,track_no FROM ambulance WHERE ambId = $ambulance ";
    $resSqlAmb = mysqli_query($con, $sqlAmb);
    $rowSqlAmb = mysqli_fetch_assoc($resSqlAmb);
    $ambulance = $rowSqlAmb['amb_name'];
    $amb_type = $rowSqlAmb['amb_type'];
    $track_no = $rowSqlAmb['track_no'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Dashboard</title>
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--! localstylesheet -->
    <link rel="stylesheet" href="./css/user-dash.css" />
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <!-- ? wrapper -->
    <div class="wrapper">
        <div class="left__content">
            <!-- ? Logo -->
            <div class="logo">
                <h3>Medicall</h3>
            </div>
            <!-- ? sidebar -->
            <div class="sidebar">
                <ul>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#" id="book">Book Now</a></li>
                    <li><a href="#" id="pay_U">Payment</a></li>
                </ul>
            </div>
            <!-- ? Footer -->
            <a href="logout.php" class="footer">Logout</a>
        </div>
        <!-- ? main__content -->
        <div class="main__content">
            <div class="success">

            </div>
            <!-- ? topbar -->
            <div class="topbar">
                <h4 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h4>
                <a href="#" class="notify"><i class="fa-solid fa-bell"></i></a>
                <p id="time">Date</p>
            </div>
            <!-- ? subcontent -->
            <div class="sub__content">
                <div class="left__subcontent">
                    <div class="search__area">
                        <form id="Famb">
                            <input type="text" name="search" id="search" placeholder="search for ambulances with your location" required />
                            <!-- <button type="submit" class="btn-search">
                                search
                            </button> -->
                        </form>
                    </div>
                    <div class="avail__text">
                        <p class="lead">Available Ambulances in&nbsp;</p>
                        <p class="loc">your location</p>
                    </div>
                    <!-- ? popup -->
                    <div class="popup__container">
                        <div id="results"></div>
                        <!-- <div class="popup">
            
              <div class="top">
                <h2 class="user__loc">location</h2>
                <p class="lead__amb"><i class="fa-solid fa-truck-medical"></i></p>
              </div>
              <div class="middle">
                <p>Amb Name: <span class="a__name">Ambulance</span></p>
              </div>
              <div class="footer__status">
                <span class="badge">booked ✔</span>
              </div>
            </div> -->
                    </div>
                    <!-- ? booking 4m -->
                    <div class="booking__form">
                        <div id="response"></div>
                        <div class="top">
                            <span id="book__close">&times;</span>
                        </div>
                        <form id="BookingForm">

                            <!-- username -->
                            <div class="input__field">
                                <input type="text" id="name" name="User_name" placeholder="Your name" required />
                            </div>
                            <!-- phone -->
                            <div class="input__field">
                                <input type="tel" id="phone" name="phone" placeholder="Phone number" required />
                            </div>
                            <!-- Location from address -->
                            <div class="input__field">
                                <select id="country-select" id="location" name="u_From">
                                    <option value="0">Select location From</option>
                                </select>
                            </div>
                            <!-- ambulance -->
                            <div class="input__field">
                                <select id="city-select" name="ambulance">
                                    <option value="0">Select ambulance</option>
                                </select>
                            </div>
                            <!-- destination -->
                            <div class="input__field">
                                <input type="text" id="destination" name="destination" placeholder="Enter destination" required />
                            </div>
                            <!-- <div class="input__field">
                                <select id="state" onchange="getCities(this.value);">
                                    <option value="0">– Select State –</option>
                                </select>
                            </div> -->
                            <!--               <div class="input__field">-->
                            <!--                <input type="datetime-local" id="datetime" name="datetime" required>-->
                            <!--               </div>-->

                            <button type="submit" name="submit" class="book__btn">Book</button>
                        </form>
                    </div>
                    <div class="payment__form">
                        <div class="top_con">
                            <h3 class="p__title">Medicall</h3>
                            <p id="pay__close">&times;</p>
                        </div>
                        <div class="form__payment">
                            <form method="post" action="stkpush.php" id="payForm">
                                <caption>Payment Info</caption>
                                <table class="t_pay">
                                    <thead>
                                        <tr>
                                            <th>From</th>
                                            <th>Destination</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <!--  -->
                                            <!--  -->
                                            <td><?php echo $location ?></td>
                                            <td><?php echo $destination ?></td>
                                            <td><?php echo $track_no ?></td>
                                        </tr>
                                        <!-- and so on... -->
                                    </tbody>
                                </table>
                                <div class="mode">
                                    <img src="./img/mpesa.png" alt="mpesa" width="70px">
                                    <input type="radio" name="pay" id="pay" required>
                                </div>
                                <div class="form-control">
                                    <input type="text" name="phoneNo" class="form-pay-input" placeholder="none" required>
                                    <label for="phoneNo" class="form-label">Enter your phone number</label>
                                </div>
                                <button type="submit" class="btn-submit">Pay Now</button>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="right__subcontent">
                    <h4 class="sum__title">Summary</h4>
                    <div class="top__summary">
                        <div class="one__sum">
                            <?php
                            $queryLocation = "SELECT COUNT(*) as loc_name FROM location";
                            $resQueryLocation = mysqli_query($con, $queryLocation);
                            while ($row = mysqli_fetch_assoc($resQueryLocation)) {
                                $countLocation = $row['loc_name'];
                            }
                            ?>
                            <p> <strong>Locations</strong> <br> <?php echo $countLocation ?></p>
                        </div>
                        <div class="one__sum">
                            <?php
                            $queryAmbulance = "SELECT COUNT(*) as amb_name FROM ambulance";
                            $resQueryAmbulance = mysqli_query($con, $queryAmbulance);
                            while ($row = mysqli_fetch_assoc($resQueryAmbulance)) {
                                $countAmbulance = $row['amb_name'];
                            }
                            ?>
                            <p style="letter-spacing:1px;"> <strong>Ambulances</strong> <br> <?php echo $countAmbulance ?></p>
                        </div>
                    </div>
                    <!-- <p class="instruction"><small>Booking info <br> Refresh this page</small></p> -->
                    <div>

                        <caption>Booking Info</caption>
                        <table class="styled-table" id="receipt">
                            <thead>
                                <tr>
                                    <th>Phone</th>
                                    <th>From</th>
                                    <th>Destination</th>
                                    <th>Time</th>
                                    <th>Track_No</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="active-row">
                                    <!--  -->
                                    <td><?php echo $phone ?></td>
                                    <td><?php echo $location ?></td>
                                    <td><?php echo $destination ?></td>
                                    <td><?php echo $booked_At ?></td>
                                    <td><?php echo $track_no ?></td>
                                </tr>
                                <!-- and so on... -->
                            </tbody>
                        </table>

                    </div>
                    <div class="track">
                        <p>Track Ambulance Here</p>
                        <div class="track__search" id="track_frm">
                            <form method="post">
                                <input type="text" name="trackNo" id="track" placeholder="Use tracking number" required />
                                <button type="submit" name="track" class="btn__track">Track</button>
                            </form>
                            <script>
                                var track_frm = document.getElementById('#track_frm')
                                track_frm.preventDefault()
                            </script>
                            <?php
                            $user_name = $_SESSION["username"];
                            $sql = "SELECT id,book_status FROM users WHERE username = '$user_name'";
                            $runSql = mysqli_query($con, $sql);
                            $row = mysqli_fetch_assoc($runSql);
                            $id = $row['id'];
                            $stat = $row['book_status'];
                            if ($stat === 'true') {
                                $trackNo = $_POST['trackNo'];
                                # code...
                                if (isset($_POST['track'])) {
                                    # code...
                                    $sql = "SELECT ambulance.ambId,ambulance.amb_name, ambulance.amb_type, location.loc_name, hospital.hos_name, hospital.time FROM ambulance INNER JOIN location ON ambulance.locationId = location.locationId INNER JOIN hospital ON location.locationId = hospital.locationId WHERE track_no = '$trackNo'";
                                    $resultTrack = mysqli_query($con, $sql);
                                    while ($row = mysqli_fetch_assoc($resultTrack)) {
                                        # code...
                                        $amb_name = $row['amb_name'];
                                        $amb_type = $row['amb_type'];
                                        $loc_name = $row['loc_name'];
                                        $hos_name = $row['hos_name'];
                                        $time = $row['time'];
                                        $ambId = $row['ambId'];
                                    }

                            ?>
                                    <?php
                                    // $getDriver = "SELECT driver_name FROM driver WHERE ambIb = $ambId";
                                    // $queryGetDriver = mysqli_query($con, $getDriver);
                                    // $rowQueryGetDriver = mysqli_fetch_assoc($queryGetDriver);
                                    // $driverName = $rowQueryGetDriver['driver_name'];
                                    ?>
                                    <div class="vtl">
                                        <div class="event">
                                            <strong><small>
                                                    <p class="date"><i class="fa-solid fa-truck-medical"></i>&nbsp;Amb_Name&nbsp; <?php echo $amb_name ?></p>
                                                </small></strong>
                                            <strong><small>
                                                    <p class="txt">Amb_Type:&nbsp; <?php echo $amb_type ?></p>
                                                </small></strong>
                                            <strong><small>
                                                    <p class="txt">From:&nbsp; <?php echo $loc_name ?></p>
                                                </small></strong>
                                            <strong><small>
                                                    <p class="txt">Destination:&nbsp; <?php echo $destination ?></p>
                                                </small></strong>
                                            <strong><small>
                                                    <p class="txt">Hospital:&nbsp; <?php echo $hos_name ?></p>
                                                </small></strong>
                                            <strong><small>
                                                    <p class="txt">WaitTime:&nbsp; <?php echo $time ?></p>
                                                </small></strong>
                                            <strong><small>
                                                    <p class="txt">DriverName:&nbsp; <?php echo $driverName ?></p>
                                                </small></strong>

                                        </div>
                                    </div>

                            <?php
                                }
                            }

                            ?>

                            <!--  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- app.js -->
    <script src="js/dashboard.js"></script>
    <script>
        $(document).ready(function() {
            // search ambulances based on location
            $("#search").on("keyup", function() {
                var query = $(this).val();
                if (query != "") {
                    $.ajax({
                        url: "ajax.php",
                        method: "POST",
                        data: {
                            query: query
                        },
                        success: function(data) {
                            $("#results").html(data);

                        }
                    });
                }
            });
            // Book ambulance
            $("#BookingForm").on("submit", function(e) {
                e.preventDefault();

                $.ajax({
                    url: "booking.php",
                    type: "post",
                    data: $("#BookingForm").serialize(),
                    success: function(response) {
                        $("#response").html(response);
                    },
                });
            });
            // load locations
            $.ajax({
                url: "populate.php",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var options = "";
                    $.each(data, function(index, value) {
                        options += "<option value='" + value.locationId + "'>" + value.loc_name + "</option>";
                    });
                    $("#country-select").append(options);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
            // load Ambulances
            $("#country-select").on("change", function() {
                var locationId = $(this).val();
                if (locationId !== "") {
                    $.ajax({
                        url: "ambulanceBasedOnLocation.php",
                        type: "GET",
                        dataType: "json",
                        data: {
                            locationId: locationId
                        },
                        success: function(data) {
                            var options = "";
                            $.each(data, function(index, value) {
                                options += "<option value='" + value.ambId + "'>" + value.amb_name + "</option>";
                            });
                            $("#city-select").html("<option value='0'>Select an ambulance</option>").append(options);
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                } else {
                    $("#city-select").html("<option value=''>Select an ambulance</option>");
                }
            });
            // end
            // $(document).ready(function() {
            // $('#payForm').submit(function(event) {
            //     event.preventDefault(); // prevent default form submit behavior

            //     // get form data
            //     var formData = $(this).serialize();

            //     // send form data using Ajax
            //     $.ajax({
            //         type: 'POST',
            //         url: 'stkpush.php',
            //         data: formData,
            //         success: function(response) {
            //             // handle success response
            //             console.log(response);
            //         },
            //         error: function(xhr, status, error) {
            //             // handle error response
            //             console.log(xhr.responseText);
            //         }
            //     });
            // });

        });
    </script>
</body>

</html>