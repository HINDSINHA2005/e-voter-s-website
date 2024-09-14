<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "voting_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $voter_id = $_POST['voter_id'];
    
    // Check if the voter has already voted
    $check_query = "SELECT * FROM votes WHERE voter_id = '$voter_id'";
    $check_result = $conn->query($check_query);
    
    if ($check_result && $check_result->num_rows > 0) {
        echo "You have already voted.";
    } else {
        // If the voter has not voted yet, proceed with inserting the vote
        $party = $_POST['party'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $legislative_assembly = $_POST['legislative_assembly'];
        $name = $_POST['name'];
        $reason = $_POST['reason'];

        // Insert data into database
        $sql = "INSERT INTO votes (party, voter_id, state, city, legislative_assembly, name, reason)
                VALUES ('$party', '$voter_id', '$state', '$city', '$legislative_assembly', '$name', '$reason')";

        if ($conn->query($sql) === TRUE) {
            // Retrieve the last inserted record
            $last_id = $conn->insert_id;
            $result = $conn->query("SELECT * FROM votes WHERE id = $last_id");
            $row = $result->fetch_assoc();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
$conn->close();
?>s

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote Submission Confirmation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <?php if (isset($row)): ?>
            <div class="alert alert-success">
                <h4 class="alert-heading">Thank you for your vote!</h4>
                <p><b>Party:</b> <?php echo htmlspecialchars($row['party']); ?></p>
                <p><b>Voter ID:</b> <?php echo htmlspecialchars($row['voter_id']); ?></p>
                <p><b>State:</b> <?php echo htmlspecialchars($row['state']); ?></p>
                <p><b>City:</b> <?php echo htmlspecialchars($row['city']); ?></p>
                <p><b>Legislative Assembly:</b> <?php echo htmlspecialchars($row['legislative_assembly']); ?></p>
                <p><b>Name:</b> <?php echo htmlspecialchars($row['name']); ?></p>
                <p><b>Reason:</b> <?php echo nl2br(htmlspecialchars($row['reason'])); ?></p>
            </div>
            <a href="vote.html" class="btn btn-primary">Return to Form</a>
            
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
        <?php else: ?>
            <div class="alert alert-danger">
                <h4 class="alert-heading">Error</h4>
                <p>There was a problem processing your vote. Please try again.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
