<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['staff_id'])) {
    header("Location: index.php");
    exit();
}


include('db_connection.php');

include('navbar.php');

// Check if the form fields are set
if (isset($_POST['staff_username']) && isset($_POST['staff_password'])) {
    $staff_username = mysqli_real_escape_string($conn, $_POST['staff_username']);
    $staff_password = mysqli_real_escape_string($conn, $_POST['staff_password']);

    // Query the staff table for authentication
    $query = "SELECT staff_id, staff_name, staff_password FROM staff WHERE staff_username = '$staff_username'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Check the number of rows in the result set
        if (mysqli_num_rows($result) == 1) {
            // Staff login successful
            $row = mysqli_fetch_assoc($result);
            $staff_id = $row['staff_id'];
            $staff_name = $row['staff_name'];
            $hashed_password = $row['staff_password'];

            // Verify the password
            if (password_verify($staff_password, $hashed_password)) {
                $_SESSION['staff_id'] = $staff_id;
                $_SESSION['staff_name'] = $staff_name;
                header("Location: index.php");
                exit();
            } else {
                // Incorrect password
                $_SESSION['login_error'] = "Incorrect password.";
                header("Location: staff_login.php");
                exit();
            }
        } else {
            // Staff not found
            $_SESSION['login_error'] = "Staff not found.";
            header("Location: staff_login.php");
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

<!DOCTYPE html>
<html>
<head>
    <title>Staff Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<br><br><br><br> 
    <div class="container">
        <h1>Staff Login</h1>
        <?php
        if (isset($_SESSION['login_error'])) {
            echo '<p class="error">' . $_SESSION['login_error'] . '</p>';
            unset($_SESSION['login_error']);
        }
        ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="staff_username">Username:</label>
            <input type="text" id="staff_username" name="staff_username" required><br><br>

            <label for="staff_password">Password:</label>
            <input type="password" id="staff_password" name="staff_password" required><br><br>

            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
