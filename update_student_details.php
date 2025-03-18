<?php
session_start();


include('db_connection.php');

include('navbar.php');

// if staff is logged in ok, else redirect to staff login page
if (!isset($_SESSION['staff_id'])) {
    header("Location: staff_login.php");
    exit();
}

// Initialize variables
$student_nic = "";
$errors = array();
$student = null;

// Handling form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_student'])) {
        // Handle student details update here

        // Validate and sanitize input
        $student_nic = mysqli_real_escape_string($conn, $_POST['student_nic']);

        // Check if the student exists
        $check_query = "SELECT * FROM students WHERE student_nic = '$student_nic'";
        $result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($result) > 0) {
            // Fetch student details
            $student = mysqli_fetch_assoc($result);
        } else {
            // Student not found
            $errors['student_not_found'] = "Student with NIC: $student_nic not found.";
        }
    } elseif (isset($_POST['remove_student'])) {
        // Handle student removal here

        // Validate and sanitize input
        $student_nic_to_remove = mysqli_real_escape_string($conn, $_POST['student_nic_to_remove']);

        // Check if the student exists
        $check_query = "SELECT * FROM students WHERE student_nic = '$student_nic_to_remove'";
        $result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($result) > 0) {
            // Delete the student record from the database
            $delete_query = "DELETE FROM students WHERE student_nic = '$student_nic_to_remove'";
            if (mysqli_query($conn, $delete_query)) {
                // Redirect to the student_removed.php page after successful removal
                header("Location: student_removed.php");
                exit();
            } else {
                // Error deleting student record
                $errors['delete_error'] = "Error removing student: " . mysqli_error($conn);
            }
        } else {
            // Student not found
            $errors['student_not_found_remove'] = "Student with NIC: $student_nic_to_remove not found.";
        }
    }
}

// Check if the "Edit" button is clicked
if (isset($_POST['edit_button']) && isset($_POST['student_id'])) {
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    // Redirect to the student edit page, passing the student ID
    header("Location: edit_student.php?student_id=$student_id");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Student Details</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<br><br><br><br>
    <div class="container">
        <h1>Update Student Details</h1>

        <?php if (isset($errors['student_not_found'])) {
            echo '<p class="error">' . $errors['student_not_found'] . '</p>';
        } ?>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="student_nic">Student NIC:</label>
            <input type="text" id="student_nic" name="student_nic" value="<?php echo $student_nic; ?>" required>
            <input type="submit" name="update_student" value="Update Student">
        </form>

        <!-- student details  -->
        <?php if ($student !== null) { ?>
            <h2>Current Student Details</h2>
            <p>Student ID: <?php echo $student['student_id']; ?></p>
            <p>Name: <?php echo $student['student_name']; ?></p>
            <p>User Name: <?php echo $student['student_username']; ?></p>
            <p>Address: <?php echo $student['student_address']; ?></p>
            <p>Telno: <?php echo $student['student_telno']; ?></p>

            <!-- course name -->
            <?php
            $course_id = $student['course_id'];
            $course_query = "SELECT course_name FROM courses WHERE course_id = '$course_id'";
            $course_result = mysqli_query($conn, $course_query);

            if ($course_row = mysqli_fetch_assoc($course_result)) {
                $course_name = $course_row['course_name'];
                echo "<p>Course: $course_name</p>";
            }
            ?>

            <!--  "Edit" button to edit student details -->
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">
                <input type="submit" name="edit_button" value="Edit">
            </form>

            <!-- "Remove Student"  -->
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="student_nic_to_remove" value="<?php echo $student['student_nic']; ?>">
                <input type="submit" name="remove_student" value="Remove Student">
            </form>
        <?php } ?>
    </div>
</body>
</html>
