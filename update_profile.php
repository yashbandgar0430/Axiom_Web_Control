<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'user_system', 5306);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user ID from session
$user_id = $_SESSION['user_id'];

// Check if a file was uploaded
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['profile_picture']['tmp_name'];
    $fileName = $_FILES['profile_picture']['name'];
    $fileSize = $_FILES['profile_picture']['size'];
    $fileType = $_FILES['profile_picture']['type'];
    
    // Define allowed file types and max size
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $maxFileSize = 2 * 1024 * 1024; // 2MB

    // Validate file type and size
    if (in_array($fileType, $allowedTypes) && $fileSize <= $maxFileSize) {
        // Specify the upload directory
        $uploadDir = './uploads/profile_pictures/';
        
        // Create the directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Generate a unique file name to prevent overwriting
        $newFileName = uniqid('profile_', true) . '-' . basename($fileName);
        $destination = $uploadDir . $newFileName;

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($fileTmpPath, $destination)) {
            // Update the database with the new profile picture path
            $stmt = $conn->prepare("UPDATE users SET profile_picture = ? WHERE id = ?");
            if ($stmt) {
                $stmt->bind_param("si", $destination, $user_id);
                $stmt->execute();
                $stmt->close();
                
                // Set success message
                $_SESSION['success'] = "Profile picture updated successfully.";
            } else {
                $_SESSION['error'] = "Database update failed: " . $conn->error;
            }
        } else {
            $_SESSION['error'] = "There was an error moving the uploaded file.";
        }
    } else {
        $_SESSION['error'] = "Invalid file type or size exceeds 2MB.";
    }
} else {
    $_SESSION['error'] = "No file uploaded or an upload error occurred.";
}

// Close the database connection
$conn->close();

// Redirect back to the profile page
header("Location: profile.php");
exit();
