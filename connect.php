<?php
// Database connection
$servername = "localhost";
$username = "root"; // nama server
$password = ""; // pass mysql klo ada
$dbname = "jobin1"; // nama database 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>