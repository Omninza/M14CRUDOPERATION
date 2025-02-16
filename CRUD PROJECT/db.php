<?php
$host = "localhost";
$user = "root"; // Change if using another username
$pass = ""; // Change if your MySQL has a password
$dbname = "hospital_management";

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
