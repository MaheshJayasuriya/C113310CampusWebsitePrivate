
<!DOCTYPE html>
<html>
<head>
    <title>Course Details</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
    include('db_connection.php');
    include('navbar.php');
    ?>

    <br><br><br><br> 
    <div class="container">
        <?php
        if (isset($_GET['course_id'])) {
            $courseId = $_GET['course_id'];
            
            $query = "SELECT * FROM courses WHERE course_id = $courseId";
            $result = mysqli_query($conn, $query);
            
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo '<h1>' . $row['course_name'] . '</h1>';
                echo '<p>' . $row['course_description'] . '</p>';
            } else {
                echo '<p>Course not found.</p>';
            }
        } else {
            echo '<p>Invalid request. Please select a course to view details.</p>';
        }
        ?>
    </div>
</body>
</html>
