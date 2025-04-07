<?php
session_start();
include('include/config.php');

// Check if the user is logged in
if (!isset($_SESSION['plogin']) || empty($_SESSION['id'])) {
    $_SESSION['errmsg'] = "Unauthorized access.";
    header('location:../../index.php');
    exit();
}

$uid = $_SESSION['id'];
$username = $_SESSION['plogin'];
$userip = $_SERVER['REMOTE_ADDR'];
$status = 0; // Logout status
$logtime = date('Y-m-d H:i:s'); // Current timestamp

// Update the logout time in the pharmacy log
$updateLog = mysqli_query($con, "UPDATE pharmacylog SET logout = '$logtime' WHERE uid = '$uid' ORDER BY id DESC LIMIT 1");

// Insert a new log entry for logout authentication
$insertLog = mysqli_query($con, "INSERT INTO pharmacylog (uid, username, userip, status, logtime, logout) VALUES ('$uid', '$username', '$userip', '$status', '$logtime', '$logtime')");

if ($updateLog && $insertLog) {
    session_unset();
    session_destroy(); // Destroy the session to prevent going back
    $_SESSION['errmsg'] = "You have successfully logged out.";
} else {
    $_SESSION['errmsg'] = "Error during logout. Please try again.";
}

header('location:../../index.php');
exit();
?>
