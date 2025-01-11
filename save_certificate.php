<?php
header('Content-Type: application/json');

// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "user_system"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname,port:5306);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Database connection failed.']);
    exit;
}

// Get the JSON input data
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['fullName'], $data['courseName'])) {
    $fullName = $conn->real_escape_string($data['fullName']);
    $courseName = $conn->real_escape_string($data['courseName']);

    // Insert data into the certificates table
    $sql = "INSERT INTO certificates (name, course_name) VALUES ('$fullName', '$courseName')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid input.']);
}

$conn->close();
?>
