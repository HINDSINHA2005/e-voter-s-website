<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['voterId'])) {
    echo "<script>alert('You must log in first'); window.location.href = 'login.html';</script>";
    exit;
}

// Database connection parameters
$servername = "localhost";
$username = "root";      // Replace with your database username
$password = "";          // Replace with your database password
$dbname = "evote_registration";  // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch profile image path for the logged-in user
$voterId = $_SESSION['voterId'];
$sql = "SELECT profileImage FROM voters WHERE voterId='$voterId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    $row = $result->fetch_assoc();
    $profileImage = $row['profileImage'];
} else {
    echo "No profile image found.";
    $profileImage = "default_profile.jpg";  // Default image if no profile image is found
}

$conn->close();
?>
