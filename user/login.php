<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css" />
</head>

<body>
    <?php
    require('../utils/config.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT id FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die("Denied");
        $rows = mysqli_num_rows($result);
        //$row = mysqli_fetch_assoc($result);

        if ($rows == 1) {
            //$_SESSION['id'] = $user_id;
            $_SESSION['username'] = $username;
            // Redirect to user dashboard page
            header("Location: welcome.php");
        } else {
            echo "<div class='form__err'>
                  <h4>Incorrect Username/password.</h4><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
    ?>
        <div class="form__container">
            <h2 class="login-title">Login</h2>
            <div class="underline"></div>
            <form class="form" method="post" name="login">
                <!-- username -->
                <div class="form__input">
                    <input type="text" class="login-input" name="username" autofocus="true" required />
                    <label for="text" class="label-name">
                        <span class="content-name"> username </span>
                    </label>
                </div>
                <!-- end username -->
                <!-- Password -->
                <div class="form__input">
                    <input type="password" class="login-input" name="password" required />
                    <label for="text" class="label-name">
                        <span class="content-name"> Password </span>
                    </label>
                </div>
                <!-- end password -->
                <div class="fPass">
                    <a href="reset-password.php" class="f-pass">forgot password?</a>
                </div>
                <input type="submit" value="Login" name="submit" class="btn-submit" />
                <small>
                    <p class="lin">Not a member?<a href="register.php" class="LN">&nbsp;new account</a></p>
                </small>
            </form>
        </div>
    <?php
    }
    ?>
</body>

</html>