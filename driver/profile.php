<?php
require('../utils/config.php');
include("auth_session.php");
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file was uploaded without errors
    $driver_name = $_SESSION["dusername"];
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        // Define variables
        $targetDir = "uploads/";
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($fileType, $allowedTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                // Store file path in database
                // $conn = mysqli_connect("localhost", "root", "", "upload");
                $sql = "UPDATE driver SET profImg = '$targetFilePath',dusername='$username', password ='$password' WHERE dusername='$driver_name'";
                mysqli_query($con, $sql);
                //mysqli_close($con);

                echo "The file $fileName has been uploaded and its path has been saved in the database.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    } else {
        echo "Please select a file to upload.";
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="profile__container">
        <form action="profile.php" method="POST" enctype="multipart/form-data">
            <h5 style="text-align: center;">Update Profile</h5>
            <div class="form__input">
                <input type="text" class="login-input" name="username" required />
                <label for="text" class="label-name">
                    <span class="content-name">Update Username </span>
                </label>
            </div>
            <div class="form__input">
                <input type="password" class="login-input" name="password" required />
                <label for="text" class="label-name">
                    <span class="content-name"> Update Password </span>
                </label>
            </div>
            <input type="file" name="image" class="btn">
            <input type="submit" name="submit" value="Upload" class="btn">
        </form>
    </div>
</body>

</html>