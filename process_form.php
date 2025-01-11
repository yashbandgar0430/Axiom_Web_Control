<?php
// Start session to handle success messages
session_start();

// Database connection
$servername = "localhost"; // or your server
$username = "root"; // your MySQL username
$password = ""; // your MySQL password
$dbname = "user_system"; // name of the database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname,port:5306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$services = $_POST['services'];
$message = $_POST['message'];

// Insert data into the database
$sql = "INSERT INTO contact_us (first_name, last_name, email, phone, services, message)
        VALUES ('$first_name', '$last_name', '$email', '$phone', '$services', '$message')";

if ($conn->query($sql) === TRUE) {
    // Success message
    $_SESSION['success'] = "Your message has been sent successfully!";
    header("Location: contact-us.php"); // Redirect to contact page
} else {
    // Error message
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
