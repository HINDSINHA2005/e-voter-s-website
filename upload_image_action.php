<?php
session_start();

if (!isset($_SESSION['voterId'])) {
    echo "<script>alert('You must log in first'); window.location.href = 'login.html';</script>";
    exit;
}

if (isset($_POST['upload'])) {
    // Database connection
    $servername = "localhost";
    $username = "root";  // replace with your database username
    $password = "";      // replace with your database password
    $dbname = "evote_registration";  // replace with your database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["profileImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Ensure the uploads directory exists
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    // Check if file is selected
    if (!isset($_FILES['profileImage']) || $_FILES['profileImage']['error'] == UPLOAD_ERR_NO_FILE) {
        echo "No file was uploaded.";
        $uploadOk = 0;
    }

    // Check if image file is an actual image or fake image
    if ($uploadOk == 1 && $check = getimagesize($_FILES["profileImage"]["tmp_name"])) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["profileImage"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["profileImage"]["name"])) . " has been uploaded.";
            
            // Save the file path in the database
            $voterId = $_SESSION['voterId'];
            $sql = "UPDATE users SET profileImage='$targetFile' WHERE voterId='$voterId'";
            if ($conn->query($sql) === TRUE) {
                echo "Profile image updated successfully.";
            } else {
                echo "Error updating profile image: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $conn->close();
}
?>
