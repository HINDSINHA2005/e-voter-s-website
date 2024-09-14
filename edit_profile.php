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

$voterId = $_SESSION['voterId'];

// Retrieve current user details
$sql = "SELECT * FROM voters WHERE voter_id = '$voterId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "<script>alert('User not found'); window.location.href = 'dashboard.php';</script>";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .form-container {
      max-width: 600px;
      margin: auto;
      padding-top: 50px;
    }
  </style>
</head>
<body>
  <div class="container form-container">
    <h2 class="text-center">Edit Profile</h2>
    <form action="update_profile.php" method="post">
      <div class="form-group">
        <label for="firstName">First Name</label>
        <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $user['first_name']; ?>" required>
      </div>
      <div class="form-group">
        <label for="lastName">Last Name</label>
        <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $user['last_name']; ?>" required>
      </div>
      <div class="form-group">
        <label for="age">Age</label>
        <input type="number" class="form-control" id="age" name="age" value="<?php echo $user['age']; ?>" required>
      </div>
      <div class="form-group">
        <label for="gender">Gender</label>
        <select class="form-control" id="gender" name="gender" required>
          <option value="Male" <?php if ($user['gender'] == 'Male') echo 'selected'; ?>>Male</option>
          <option value="Female" <?php if ($user['gender'] == 'Female') echo 'selected'; ?>>Female</option>
          <option value="Other" <?php if ($user['gender'] == 'Other') echo 'selected'; ?>>Other</option>
        </select>
      </div>
      <div class="form-group">
        <label for="aadharCard">Aadhar Card Number</label>
        <input type="text" class="form-control" id="aadharCard" name="aadharCard" value="<?php echo $user['aadhar_card']; ?>" required>
      </div>
      <div class="form-group">
        <label for="address">Address</label>
        <textarea class="form-control" id="address" name="address" rows="3" required><?php echo $user['address']; ?></textarea>
      </div>
      <div class="form-group">
        <label for="mobileNumber">Mobile Number</label>
        <input type="tel" class="form-control" id="mobileNumber" name="mobileNumber" value="<?php echo $user['mobile_number']; ?>" required>
      </div>
      <div class="form-group">
        <label for="dob">Date of Birth</label>
        <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $user['date_of_birth']; ?>" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Update Profile</button>
    </form>
  </div>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
