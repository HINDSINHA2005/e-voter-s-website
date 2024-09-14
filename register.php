<?php
$servername = "localhost";
$username = "root"; // Default XAMPP MySQL username
$password = ""; // Default XAMPP MySQL password (usually empty)
$dbname = "evote_registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve and sanitize form inputs
$firstName = $conn->real_escape_string($_POST['firstName']);
$lastName = $conn->real_escape_string($_POST['lastName']);
$age = $conn->real_escape_string($_POST['age']);
$gender = $conn->real_escape_string($_POST['gender']);
$voterId = $conn->real_escape_string($_POST['voterId']);
$aadharCard = $conn->real_escape_string($_POST['aadharCard']);
$address = $conn->real_escape_string($_POST['address']);
$mobileNumber = $conn->real_escape_string($_POST['mobileNumber']);
$dob = $conn->real_escape_string($_POST['dob']);
$email = $conn->real_escape_string($_POST['email']);
$password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_DEFAULT);
$confirmPassword = $_POST['confirmPassword'];

// Check if passwords match
if ($_POST['password'] !== $_POST['confirmPassword']) {
    echo "<script>alert('Passwords do not match.')</script>";
}

// Insert data into database
$sql = "INSERT INTO voters (first_name, last_name, age, gender, voter_id, aadhar_card, address, mobile_number, date_of_birth, email, password) VALUES ('$firstName', '$lastName', '$age', '$gender', '$voterId', '$aadharCard', '$address', '$mobileNumber', '$dob', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('You are successfully Registered'); window.location.href = 'main.html';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
