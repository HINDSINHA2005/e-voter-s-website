<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "evote_registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve and sanitize form inputs
$voterId = $conn->real_escape_string($_POST['voterId']);
$password = $conn->real_escape_string($_POST['password']);

// Check if user exists
$sql = "SELECT * FROM voters WHERE voter_id = '$voterId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Verify password
    if (password_verify($password, $row['password'])) {
        // Password is correct, start a session
        $_SESSION['voterId'] = $voterId;
        $_SESSION['firstName'] = $row['first_name'];
        echo "<script>alert('Login successful'); window.location.href = 'dashboard2.php';</script>";
    } else {
        echo "<script>alert('Incorrect password'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Voter ID not found'); window.history.back();</script>";
}

$conn->close();
?>
