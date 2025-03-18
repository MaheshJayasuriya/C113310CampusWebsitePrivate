<?php

$servername = "localhost:3308"; 
$username = "root"; 
$password = ""; 
$database = "privatecampus"; 

$conn = mysqli_connect($servername, $username, $password, $database);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
