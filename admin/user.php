<?php
ob_start();
require('../utils/config.php');
include("auth_session.php");
$sql = "SELECT id,username,email,book_status,create_datetime FROM users";
$runSql = mysqli_query($con, $sql);
if (isset($_REQUEST['submit'])) {
    $username = stripslashes($_REQUEST['username']);
    //escapes special characters in a string
    $username = mysqli_real_escape_string($con, $username);
    $email    = stripslashes($_REQUEST['email']);
    $email    = mysqli_real_escape_string($con, $email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    //$create_datetime = date("Y-m-d H:i:s");
    $query    = "INSERT into `users` (username,password,email)
                     VALUES ('$username','$password','$email' )";
    $result   = mysqli_query($con, $query);
    if ($result) {
        echo '<script type="text/javascript">
    $(document).ready(function() {
        swal({
            title: "Sucess!",
            text: "New User added!!",
            icon: "Sucess",
            button: "Ok",
        });
    });
</script>';
    } else {
        echo '<script type="text/javascript">
    $(document).ready(function() {
        swal({
            title: "warning!",
            text: "Could not add User!!",
            icon: "warning",
            button: "Ok",
        });
    });
</script>';
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="style.css">
    <script>
        var dispBtn = document.querySelector('#newDriver')
        var frm = document.querySelector('#frm')
        var close = document.querySelector('#close')
        dispBtn.addEventListener('click', handlerA)
        close.addEventListener('click', handlerB)

        function handlerA() {
            frm.style.display = 'block'
        }

        function handlerB() {
            frm.style.display = 'none'
        }
    </script>
</head>

<body>
    <div class="manage__user">
        <div class="add">
            <button id="newDriver">New User</button>
        </div>
        <div class="fom">

            <form id="frm" action="post">
                <div class="top_frm_details">
                    <p>ADD NEW USER</p> <span id="close">&times;</span>
                </div>
                <div class="form-group">
                    <input type="text" name="username" required /><label>Username</label>
                </div>
                <div class="form-group">
                    <input type="text" name="email" required /><label>Email</label>
                </div>
                <div class="form-group">
                    <input type="password" name="password" required /><label>Password</label>
                </div>
                <input type="button" name="submit" value="Submit" />
            </form>
        </div>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>username</th>
                    <th>email</th>
                    <th>book_status</th>
                    <th>Date Joined</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($runSql)) {
                    # code...
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['book_status'] . "</td>";
                    echo "<td>" . $row['create_datetime'] . "</td>";
                    echo "</tr>";
                } ?>
                <!-- and so on... -->
            </tbody>
        </table>
    </div>
</body>


</html>