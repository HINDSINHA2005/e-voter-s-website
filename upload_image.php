<?php
session_start();

if (!isset($_SESSION['voterId'])) {
    echo "<script>alert('You must log in first'); window.location.href = 'login.html';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload Image</title>
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
    <h2 class="text-center">Upload Profile Image</h2>
    <form action="upload_image_action.php" method="post" enctype="multipart/form-data" class="text-center mt-3">
      <input type="file" name="profileImage" class="form-control-file">
      <button type="submit" name="upload" class="btn btn-success mt-2">Upload Image</button>
    </form>
    <div class="text-center mt-3">
      <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
