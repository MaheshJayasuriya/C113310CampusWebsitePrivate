<?php
session_start();

// Check if a student is logged in, if not redirect to student login page
if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit();
}

include('db_connection.php'); 

include('navbar.php'); 

// get student details from the database
$student_id = $_SESSION['student_id'];
$query = "SELECT s.*, c.course_name 
          FROM students AS s
          JOIN courses AS c ON s.course_id = c.course_id
          WHERE s.student_id = $student_id";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}

// Check for student details available
if (mysqli_num_rows($result) > 0) {
    $student = mysqli_fetch_assoc($result);
} else {
    die("Student details not found.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Details - <?php echo $student['student_name']; ?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<br><br><br><br>
    <div class="container">
        <h1>Student Details</h1>
        <p><strong>Student ID:</strong> <?php echo $student['student_id']; ?></p>
        <p><strong>Name:</strong> <?php echo $student['student_name']; ?></p>
        <p><strong>NIC:</strong> <?php echo $student['student_nic']; ?></p>
        <p><strong>Username:</strong> <?php echo $student['student_username']; ?></p>
        <p><strong>Address:</strong> <?php echo $student['student_address']; ?></p>
        <p><strong>Telephone Number:</strong> <?php echo $student['student_telno']; ?></p>
        <p><strong>Course:</strong> <?php echo $student['course_name']; ?></p>
       
    </div>
</body>
</html>


