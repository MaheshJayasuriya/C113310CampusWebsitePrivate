<?php
session_start();


include('db_connection.php');
include('navbar.php');

// if staff is logged in ok, if not redirect to staff login page
if (!isset($_SESSION['staff_id'])) {
    header("Location: staff_login.php");
    exit();
}

// Prepare variables
$student_id = $_GET['student_id'] ?? null;
$errors = array();
$student = null;

// Check if a student ID is provided in the URL
if (!$student_id) {
    $errors['student_not_found'] = "Student ID not provided.";
} else {
    // Fetch student details
    $query = "SELECT * FROM students WHERE student_id = '$student_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $student = mysqli_fetch_assoc($result);
    } else {
        // Student not found
        $errors['student_not_found'] = "Student not found.";
    }
}

// submissions
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_changes'])) {
    // Validate and sanitize input
    $new_name = mysqli_real_escape_string($conn, $_POST['new_name']);
    $new_username = mysqli_real_escape_string($conn, $_POST['new_username']);
    $new_address = mysqli_real_escape_string($conn, $_POST['new_address']);
    $new_telno = mysqli_real_escape_string($conn, $_POST['new_telno']);
    $new_course_id = mysqli_real_escape_string($conn, $_POST['new_course_id']);

    // Update student details in the database
    $update_query = "UPDATE students SET student_name = '$new_name', student_username = '$new_username', student_address = '$new_address', student_telno = '$new_telno', course_id = '$new_course_id' WHERE student_id = '$student_id'";
    
    if (mysqli_query($conn, $update_query)) {
        // Redirect to the student details page
        header("Location: update_student_details.php");
        exit();
    } else {
        // Error updating student details
        $errors['update_error'] = "Error updating student details: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student Details</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<br><br><br><br>
    <div class="container">
        <h1>Edit Student Details</h1>

        <?php if (isset($errors['student_not_found'])) {
            echo '<p class="error">' . $errors['student_not_found'] . '</p>';
        } else { ?>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] . "?student_id=$student_id"; ?>">
                
                <label for="new_name">New Name:</label>
                <input type="text" id="new_name" name="new_name" value="<?php echo $student['student_name']; ?>" required><br><br>

                <label for="new_username">New User Name:</label>
                <input type="text" id="new_username" name="new_username" value="<?php echo $student['student_username']; ?>" required><br><br>

                <label for="new_address">New Address:</label>
                <input type="text" id="new_address" name="new_address" value="<?php echo $student['student_address']; ?>" required><br><br>

                <label for="new_telno">New Telno:</label>
                <input type="text" id="new_telno" name="new_telno" value="<?php echo $student['student_telno']; ?>" required><br><br>

                <label for="new_course_id">New Course:</label>
                <select id="new_course_id" name="new_course_id" required>
                    <?php
                    // Query to retrieve course information from the "courses" table
                    $query = "SELECT * FROM courses";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $selected = ($row['course_id'] == $student['course_id']) ? 'selected' : '';
                        echo '<option value="' . $row['course_id'] . '" ' . $selected . '>' . $row['course_name'] . ' (' . $row['course_code'] . ')</option>';
                    }
                    ?>
                </select><br><br>

                <input type="submit" name="save_changes" value="Save Changes">
            </form>
        <?php } ?>
    </div>
</body>
</html>
