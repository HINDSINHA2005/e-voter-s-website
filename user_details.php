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
  <title>User Details</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>
<body>
  <div class="container mt-5">
    <h2 class="text-center">User Details</h2>
    <table class="table table-bordered mt-4">
      <tr>
        <th>First Name</th>
        <td><?php echo htmlspecialchars($user['first_name']); ?></td>
      </tr>
      <tr>
        <th>Last Name</th>
        <td><?php echo htmlspecialchars($user['last_name']); ?></td>
      </tr>
      <tr>
        <th>Age</th>
        <td><?php echo htmlspecialchars($user['age']); ?></td>
      </tr>
      <tr>
        <th>Gender</th>
        <td><?php echo htmlspecialchars($user['gender']); ?></td>
      </tr>
      <tr>
        <th>Voter ID</th>
        <td><?php echo htmlspecialchars($user['voter_id']); ?></td>
      </tr>
      <tr>
        <th>Aadhar Card Number</th>
        <td><?php echo htmlspecialchars($user['aadhar_card']); ?></td>
      </tr>
      <tr>
        <th>Address</th>
        <td><?php echo htmlspecialchars($user['address']); ?></td>
      </tr>
      <tr>
        <th>Mobile Number</th>
        <td><?php echo htmlspecialchars($user['mobile_number']); ?></td>
      </tr>
      <tr>
        <th>Date of Birth</th>
        <td><?php echo htmlspecialchars($user['date_of_birth']); ?></td>
      </tr>
      <tr>
        <th>Email</th>
        <td><?php echo htmlspecialchars($user['email']); ?></td>
      </tr>
    </table>
    <div class="text-center mt-4">
    <button id="screenshotButton" class="btn btn-primary">Save as image</button>
    <script>
        document.getElementById('screenshotButton').addEventListener('click', function() {
            html2canvas(document.body).then(function(canvas) {
                // Convert the canvas to a data URL and create an anchor element
                let link = document.createElement('a');
                link.href = canvas.toDataURL('image/png');
                link.download = 'screenshot.png';
                // Trigger the download by simulating a click
                link.click();
            });
        });
    </script>
      <a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>
    </div>
  </div>
  <div>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
