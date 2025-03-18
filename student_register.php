<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
    
    	include('db_connection.php');
	include('navbar.php');

    // prepare variables
    $nic = $name = $student_username = $student_password = $student_password_confirm = $address = $telno = $course_id = "";
    
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $nic = $_POST["nic"];
        $name = $_POST["name"];
        $student_username = $_POST["student_username"];
        $student_password = $_POST["student_password"];
        $student_password_confirm = $_POST["confirm_password"];
        $address = $_POST["student_address"];
        $telno = $_POST["student_telno"];
        $course_id = $_POST["course_id"];

        // Password validation
        if ($student_password !== $student_password_confirm) {
            echo "Passwords do not match. Please go back and try again.";
        } else {
            // Hash the password for security
            $hashed_password = password_hash($student_password, PASSWORD_DEFAULT);

            // Insert data into the database
            $sql = "INSERT INTO students (student_nic, student_name, student_username, student_password, student_address, student_telno, course_id)
                    VALUES ('$nic', '$name', '$student_username', '$hashed_password', '$address', '$telno', $course_id)";

            if (mysqli_query($conn, $sql)) {
                // Registration successful
                header("Location: registration_success.php");
                exit();
            } else {
                // Registration failed
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
    ?>
<br><br><br><br> 
    <div class="container">
        <h1>Student Registration</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="nic">NIC:</label>
            <input type="text" id="nic" name="nic" required><br><br>
            
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="student_username">User Name:</label>
            <input type="text" id="student_username" name="student_username" required><br><br>

            <label for="student_password">Password:</label>
            <input type="password" id="student_password" name="student_password" required><br><br>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required><br><br>

            <label for="student_address">Address:</label>
            <input type="text" id="student_address" name="student_address" required><br><br>

            <label for="student_telno">Telno:</label>
            <input type="text" id="student_telno" name="student_telno" required><br><br>

            <label for="course_id">Course:</label>
            <select id="course_id" name="course_id" required>
                <?php
                // Query to retrieve course information from the "courses" table
                $query = "SELECT * FROM courses";
                $result = mysqli_query($conn, $query);

                // Check if there are courses available
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['course_id'] . '">' . $row['course_name'] . ' (' . $row['course_code'] . ')</option>';
                    }
                } else {
                    echo '<option value="" disabled>No courses available</option>';
                }
                ?>
            </select><br><br>

            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
