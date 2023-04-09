<?php
session_start();
if (!isset($_SESSION["dusername"])) {
    header("Location: index.php");
    exit();
}
