<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Registration</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="./css/form.css">
</head>

<body>
    <?php
    require_once "../utils/config.php";
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `users` (username, password, email, create_datetime)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form__redirect'>
                  <h2>Registration was successfull. 🥳🥂🙌</h2><br/>
                  <p class='link'>Click here to &nbsp; <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form__err'>
                  <h3>Required fields are missing. 🙂😪😣</h3><br/>
                  <p class='link'>Click here to &nbsp;<a href='register.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
    ?>
        <div class="form__container">
            <h2 class="medicall__title">Register</h2>
            <div class="underline"></div>
            <form class="form" action="" method="post">
                <!-- username -->
                <div class="form__input">
                    <input type="text" class="login-input" name="username" required />
                    <label for="text" class="label-name">
                        <span class="content-name"> username </span>
                    </label>
                </div>
                <!-- email -->
                <div class="form__input">
                    <input type="text" class="login-input" name="email" required>
                    <label for="text" class="label-name">
                        <span class="content-name"> email </span>
                    </label>
                </div>
                <!-- password -->
                <div class="form__input">
                    <input type="password" class="login-input" name="password" required>
                    <label for="text" class="label-name">
                        <span class="content-name"> password </span>
                    </label>
                </div>
                <div class="checkbox">
                    <input type="checkbox" name="chkbx" id="chx" required value="I agree to terms & conditions" />
                    <small>I agree to terms & conditions</small>
                </div>
                <input type="submit" name="submit" value="Register" class="btn-submit">
                <small>
                    <p class="lin">Already have an account?&nbsp;<a href="login.php" class="LN">Login here</a></p>
                </small>
            </form>
        </div>
    <?php
    }
    ?>
</body>

</html>