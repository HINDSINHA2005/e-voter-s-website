<?php
session_start();

if (!isset($_SESSION['voterId'])) {
    echo "<script>alert('You must log in first'); window.location.href = 'login.html';</script>";
    exit;
}

$firstName = isset($_SESSION['firstName']) ? $_SESSION['firstName'] : 'Guest';
$voterId = isset($_SESSION['voterId']) ? $_SESSION['voterId'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-Vote Dashboard</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-image: url('backr.jpg');
      background-repeat: no-repeat;
      background-size: cover;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <h2 class="text-center">Welcome, <?php echo htmlspecialchars($firstName); ?>!</h2>
    <p class="text-center">You have successfully logged in with Voter ID: <?php echo htmlspecialchars($voterId); ?></p>
    <div class="text-center">
      <a href="edit_profile.php" class="btn btn-primary">Edit Profile</a>
      <a href="user_details.php" class="btn btn-info">View Details</a>
      <a href="logout.php" class="btn btn-danger">Logout</a>
      <a href="upload_image.php" class="btn btn-success">Upload Image</a>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
