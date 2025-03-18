<?php
if (!isset($_SESSION)) session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Courses</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
    include('db_connection.php');
    include('navbar.php');
    ?>
    <br><br><br><br> 
    <div class="container">
        <h1>Available Courses</h1>
<p>Please click on a course to view details.</p> <br>
        <?php
        $query = "SELECT * FROM courses";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<ul>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>";
                echo "<a href='course_details.php?course_id=" . $row['course_id'] . "'>";
                echo $row['course_name'] . " (" . $row['course_code'] . ")";
                echo "</a>";
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No courses available at the moment.</p>";
        }
        ?>
    </div>
</body>
</html>
