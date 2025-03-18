<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="navbar">
        <ul>
            <li <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo 'class="active"'; ?>><a href="index.php">Home</a></li>
            <li <?php if (basename($_SERVER['PHP_SELF']) == 'courses.php') echo 'class="active"'; ?>><a href="courses.php">Courses</a></li>

            <?php
            if (isset($_SESSION['student_id'])) {
                $student_id = $_SESSION['student_id'];
                $student_name = $_SESSION['student_name'];

                // Show Student name and ID
                echo '<li class="student-info">Logged as, ' . $student_name . ' - S.ID: ' . $student_id .'</li>';
                echo '<li ';
                if (basename($_SERVER['PHP_SELF']) == 'view_student_details.php') echo 'class="active"';
                echo '><a href="view_student_details.php">View My Details</a></li>';
                echo '<li ';
                if (basename($_SERVER['PHP_SELF']) == 'lms.php') echo 'class="active"';
                echo '><a href="lms.php" target="_blank">LMS</a></li>';
            } else if (isset($_SESSION['staff_id'])) {
                echo '<li ';
                if (basename($_SERVER['PHP_SELF']) == 'manage_students.php') echo 'class="active"';
                echo '><a href="manage_students.php">Manage Students</a></li>';
                echo '<li ';
                if (basename($_SERVER['PHP_SELF']) == 'manage_courses.php') echo 'class="active"';
                echo '><a href="manage_courses.php">Manage Courses</a></li>';
            }
            ?>

            <?php
            // Check if the user is logged in as a student or staff
            if (isset($_SESSION['student_id']) || isset($_SESSION['staff_id'])) {
                // If logged in, show the "Logout" button
                echo '<a href="logout.php" class="login-logout-button">Logout</a>';
            } else {
                // If not logged in, show "Student Login," "Staff Login," "Register Online," "About Us," and "Contact Us" tabs
                $currentPage = basename($_SERVER['PHP_SELF']); // current page name as variables
                $tabs = array(
                    'student_login.php' => 'Student Login',
                    'staff_login.php' => 'Staff Login',
                    'student_register.php' => 'Register Online',
                    'about_us.php' => 'About Us',
                    'contact_us.php' => 'Contact Us'
                );

                foreach ($tabs as $page => $label) {
                    echo '<li ';
                    if ($currentPage == $page) echo 'class="active"';
                    echo '><a href="' . $page . '">' . $label . '</a></li>';
                }
            }
            ?>
        </ul>
    </div>
</body>
</html>
