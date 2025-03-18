<?php
// Start the session (if it's not already started)
session_start();

// Destroy the session
session_destroy();

// Redirect to the home page 
header("Location: index.php"); 
exit();
?>
