<?php
if (!isset($_SESSION)) session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome to MHS Campus</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php include('navbar.php'); ?>
<br><br><br><br> 
    
    	<div class="container">
        	<h1 class="welcome-text">Welcome to C113310 Campus</h1>
        	<p class="intro-text">
            		An institution dedicated to academic excellence and a nurturing learning environment.
            		We take pride in providing top-tier education and support for all our students.
        	</p>        
    	</div>



<?php include('footer.php'); ?>
</body>
</html>
