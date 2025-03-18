<?php
session_start();

// database connection 
include('db_connection.php');

// Check if the form fields are set
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query the student table for authentication
    $query = "SELECT student_id, student_name FROM students WHERE student_username = '$username' and student_password='$password'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Check the number of rows in the result set
        if (mysqli_num_rows($result) == 1) {
            // Student login successful
            $row = mysqli_fetch_assoc($result);
            $student_id = $row['student_id'];
            $student_name = $row['student_name'];
            $_SESSION['student_id'] = $student_id;
            $_SESSION['student_name'] = $student_name;
            header("Location: index.php");
            exit();
        } else {
            // Student login failed
            $_SESSION['login_error'] = "Invalid username or password.";
            header("Location: student_login.php");
            exit();
        }
    } else {
        // Query failed, handle the error
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Redirect to login page if form fields are not set
    header("Location: student_login.php");
    exit();
}
?>
