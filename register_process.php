<?php
// database connection 
include('db_connection.php');

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form data validation and sanitization
    $nic = $_POST["nic"];
    $name = $_POST["name"];
    $student_password = $_POST["student_password"];
    $student_address = $_POST["student_address"];
    $student_telno = $_POST["student_telno"];
    $course_id = $_POST["course_id"];

    // SQL query to insert student data into the "students" table
    $query = "INSERT INTO students (student_nic, student_name, student_password, student_address, student_telno, course_id) 
              VALUES ('$nic', '$name', '$student_password', '$student_address', '$student_telno', $course_id)";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        // Registration successful, redirect to a confirmation page
        header("Location: registration_success.php");
        exit();
    } else {
        // Registration failed, display an error message
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Redirect to the registration page if the form was not submitted
    header("Location: register.php");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
