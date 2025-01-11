<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "user_systems"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname,port:5306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch certificates from the database
$sql = "SELECT * FROM certificates ORDER BY created_at DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificates</title>
</head>
<body>
    <h2>List of Certificates</h2>
    <?php
    if ($result->num_rows > 0) {
        // Display records
        while($row = $result->fetch_assoc()) {
            echo "<div class='certificate-item'>";
            echo "<p><strong>Name:</strong> " . $row["name"] . "</p>";
            echo "<p><strong>Course:</strong> " . $row["course_name"] . "</p>";
            echo "<p><strong>Issued On:</strong> " . $row["created_at"] . "</p>";
            echo "<a href='download_certificate.php?id=" . $row["id"] . "'>Download Certificate</a>";
            echo "</div><hr>";
        }
    } else {
        echo "No certificates found.";
    }

    // Close connection
    $conn->close();
    ?>
</body>
</html>
