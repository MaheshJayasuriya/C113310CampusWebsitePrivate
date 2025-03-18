<?php
session_start();

// Check if staff is logged in, else redirect to staff login page
if (!isset($_SESSION['staff_id'])) {
    header("Location: staff_login.php");
    exit();
}

include('navbar.php'); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Removed</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Student Removed</h1>
        <p>The student has been successfully removed from the database.</p>
        <a href="staff_panel.php">Back to Staff Panel</a>
    </div>
</body>
</html>
