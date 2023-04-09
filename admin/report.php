<?php include("auth_session.php"); ?>

<!DOCTYPE html>
<html>

<head>
    <title>Dispatch Report</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.js" integrity="sha512-NmIoYvVsh1mGumphmTK9rc11ia21MZKRPsQV8RUn0x+sN6rxcBtST1Y5fw4WSiAzlryxCtPy00QoPfadNaq6gQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="booking-report.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h3 class="rpt_essentials_header">Ambulance Booking Report</h3>
    <div class="rpt_essentials">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" class="inpt_grp" name="start_date">
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" class="inpt_grp" name="end_date">
        <button id="submit_btn">Get Report</button>
        <button id="print_btn">Print</button>
    </div>
    <table id="booking_report" class="styled-table">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Patient Name</th>
                <th>Phone Number</th>
                <th>Driver Name</th>
                <th>Booking Date</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</body>

</html>