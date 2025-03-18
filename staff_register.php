<!DOCTYPE html>
<html>
<head>
    <title>Staff Registration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
    // database connection 
    include('db_connection.php');

    // Prepare variables
    $staff_username = $staff_password = $confirm_password = $staff_name = $staff_role = $department = "";

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $staff_username = $_POST["staff_username"];
        $staff_password = $_POST["staff_password"];
        $confirm_password = $_POST["confirm_password"];
        $staff_name = $_POST["staff_name"];
        $staff_role = $_POST["staff_role"];
        $department = $_POST["department"];

        // Password validation
        if ($staff_password !== $confirm_password) {
            echo "Passwords do not match. Please go back and try again.";
        } else {
            // Hash the password for security
            $hashed_password = password_hash($staff_password, PASSWORD_DEFAULT);

            // Insert data into the database
            $sql = "INSERT INTO staff (staff_username, staff_password, staff_name, staff_role, department)
                    VALUES ('$staff_username', '$hashed_password', '$staff_name', '$staff_role', '$department')";

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

    <div class="container">
        <h1>Staff Registration</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="staff_username">Username:</label>
            <input type="text" id="staff_username" name="staff_username" required><br><br>

            <label for="staff_password">Password:</label>
            <input type="password" id="staff_password" name="staff_password" required><br><br>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required><br><br>

            <label for="staff_name">Name:</label>
            <input type="text" id="staff_name" name="staff_name" required><br><br>

            <label for="staff_role">Role:</label>
            <input type="text" id="staff_role" name="staff_role" required><br><br>

            <label for="department">Department:</label>
            <input type="text" id="department" name="department"><br><br>

            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
