<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'user_system', 5306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if (isset($_POST['submit'])) {
    $id = $_POST['service_id'];
    $title = $_POST['service_title'];
    $content = $_POST['service_content'];

    // Handle file upload
    $image_path = '';
    if (isset($_FILES['service_image']) && $_FILES['service_image']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir); // Ensure the uploads directory exists
        $image_name = basename($_FILES["service_image"]["name"]);
        $target_file = $target_dir . uniqid() . '_' . $image_name;
        move_uploaded_file($_FILES["service_image"]["tmp_name"], $target_file);
        $image_path = $target_file;
    }

    if ($id) {
        // Update existing service
        if ($image_path) {
            $stmt = $conn->prepare("UPDATE blogs SET title=?, content=?, image=? WHERE id=?");
            $stmt->bind_param("sssi", $title, $content, $image_path, $id);
        } else {
            $stmt = $conn->prepare("UPDATE blogs SET title=?, content=? WHERE id=?");
            $stmt->bind_param("ssi", $title, $content, $id);
        }
    } else {
        // Insert a new service
        $stmt = $conn->prepare("INSERT INTO blogs (title, content, image) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $content, $image_path);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Service saved successfully!'); window.location.href='blogs1.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
