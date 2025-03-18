
<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
    session_start();

    // Check if the user is already logged in
    if (isset($_SESSION['student_id'])) {
        header("Location: index.php");
        exit();
    }

    // database connection file 
    	include('db_connection.php');

	include('navbar.php');

    // Check if the form fields are set
    if (isset($_POST['student_username']) && isset($_POST['student_password'])) {
        $student_username = mysqli_real_escape_string($conn, $_POST['student_username']);
        $student_password = mysqli_real_escape_string($conn, $_POST['student_password']);

        // Query the student table for authentication
        $query = "SELECT student_id, student_name, student_password FROM students WHERE student_username = '$student_username'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Check the number of rows in the result set
            if (mysqli_num_rows($result) == 1) {
                // Student login successful
                $row = mysqli_fetch_assoc($result);
                $student_id = $row['student_id'];
                $student_name = $row['student_name'];
                $hashed_password = $row['student_password'];

                // Verify the password
                if (password_verify($student_password, $hashed_password)) {
                    $_SESSION['student_id'] = $student_id;
                    $_SESSION['student_name'] = $student_name;
                    header("Location: index.php");
                    exit();
                } else {
                    // Incorrect password
                    $_SESSION['login_error'] = "Incorrect password.";
                    header("Location: student_login.php");
                    exit();
                }
            } else {
                // Student not found
                $_SESSION['login_error'] = "Student not found.";
                header("Location: student_login.php");
                exit();
            }
        } else {
            // Query failed, handle the error
            echo "Error: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    }
    ?>
<br><br><br><br> 
    <div class="container">
        <h1>Student Login</h1>
        <?php
        if (isset($_SESSION['login_error'])) {
            echo '<p class="error">' . $_SESSION['login_error'] . '</p>';
            unset($_SESSION['login_error']);
        }
        ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="student_username">Username:</label>
            <input type="text" id="student_username" name="student_username" required><br><br>

            <label for="student_password">Password:</label>
            <input type="password" id="student_password" name="student_password" required><br><br>

            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
