<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'user_system', 5306);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
    $user_id = $_SESSION['user_id'];

    // Mark any existing "current" courses as "completed" for this user
    $conn->query("UPDATE enrollments SET status = 'completed' WHERE user_id = $user_id AND status = 'current'");

    // Enroll the user in the new course
    $stmt = $conn->prepare("INSERT INTO enrollments (user_id, course_id, status) VALUES (?, ?, 'current')");
    $stmt->bind_param("ii", $user_id, $course_id);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Course purchased successfully!'); window.location.href='profile.php';</script>";
} else {
    echo "<p>Invalid course selection.</p>";
}

$conn->close();
?>
