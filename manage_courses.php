<?php
if (!isset($_SESSION)) {
    session_start();
}

include('db_connection.php'); 

// Check if the user is logged in as staff
if (!isset($_SESSION['staff_id'])) {
    header("Location: staff_login.php");
    exit();
}

// course delete
if (isset($_POST['delete_course'])) {
    $course_id = $_POST['course_id'];
    $query = "DELETE FROM courses WHERE course_id = $course_id";
    mysqli_query($conn, $query);
}

// add new course 
if (isset($_POST['add_course'])) {
    $course_name = $_POST['course_name'];
    $course_code = $_POST['course_code'];
    $course_description = $_POST['course_description'];

    //data validation and sanitation 

    $query = "INSERT INTO courses (course_name, course_code, course_description) 
              VALUES ('$course_name', '$course_code', '$course_description')";
    mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Courses</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php include('navbar.php'); ?>

    <div class="container">
        <h1>Manage Courses</h1>

        <h2>Add New Course</h2>
        <form method="post">
            <label for="course_name">Course Name:</label>
            <input type="text" name="course_name" required>

            <label for="course_code">Course Code:</label>
            <input type="text" name="course_code" required>

            <label for="course_description">Course Description:</label>
<br>
            <textarea name="course_description" rows="10" required></textarea>
<br>

            <input type="submit" name="add_course" value="Add Course">
        </form>

        <h2>Existing Courses</h2>
        <ul>
            <?php
            $query = "SELECT * FROM courses";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>{$row['course_name']} ({$row['course_code']})</li>";
                echo "<p>{$row['course_description']}</p>";
                echo "<form method='post'><input type='hidden' name='course_id' value='{$row['course_id']}'><input type='submit' name='delete_course' value='Delete'></form>";
            }
            ?>
        </ul>
    </div>
</body>
</html>
