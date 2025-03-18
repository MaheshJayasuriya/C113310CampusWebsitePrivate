<?php
session_start();

//if staff is logged in ok, if not redirect to staff login page
if (!isset($_SESSION['staff_id'])) {
    header("Location: staff_login.php");
    exit();
}

include('db_connection.php'); 
include('navbar.php'); 

?>

<!DOCTYPE html>
<html>
<head>
    <title>Staff Panel</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<br><br><br><br>
    <div class="container">
        <h1>Staff Panel</h1>

       
        <h2>Update Student Details / Remove Students </h2>
        <form method="post" action="update_student_details.php">
            <label for="student_nic">Student NIC:</label>
            <input type="text" id="student_nic" name="student_nic" required>        
            
            <input type="submit" name="update_student" value="Proceed">
        </form>        
    </div>
</body>
</html>
