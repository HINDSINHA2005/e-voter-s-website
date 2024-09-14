<?php
session_start();

if (!isset($_SESSION['voterId'])) {
    echo "<script>alert('You must log in first'); window.location.href = 'login.html';</script>";
    exit;
}

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
$voterId = $_SESSION['voterId'];
$firstName = $conn->real_escape_string($_POST['firstName']);
$lastName = $conn->real_escape_string($_POST['lastName']);
$age = $conn->real_escape_string($_POST['age']);
$gender = $conn->real_escape_string($_POST['gender']);
$aadharCard = $conn->real_escape_string($_POST['aadharCard']);
$address = $conn->real_escape_string($_POST['address']);
$mobileNumber = $conn->real_escape_string($_POST['mobileNumber']);
$dob = $conn->real_escape_string($_POST['dob']);
$email = $conn->real_escape_string($_POST['email']);

// Update data in database
$sql = "UPDATE voters SET 
        first_name='$firstName', 
        last_name='$lastName', 
        age='$age', 
        gender='$gender', 
        aadhar_card='$aadharCard', 
        address='$address', 
        mobile_number='$mobileNumber', 
        date_of_birth='$dob', 
        email='$email' 
        WHERE voter_id='$voterId'";

if ($conn->query($sql) === TRUE) {
    $_SESSION['firstName'] = $firstName;
    echo "<script>alert('Profile updated successfully'); window.location.href = 'dashboard.php';</script>";
} else {
    echo "<script>alert('Error updating profile: " . $conn->error . "'); window.history.back();</script>";
}

$conn->close();
?>
