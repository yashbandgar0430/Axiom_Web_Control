<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'user_system', 5306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if (isset($_POST['submit'])) {
    $id = $_POST['course_id'];
    $title = $_POST['course_title'];
    $content = $_POST['course_content'];

    // Handle file upload
    $image_path = '';
    if (isset($_FILES['course_image']) && $_FILES['course_image']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir); // Ensure the uploads directory exists
        $image_name = basename($_FILES["course_image"]["name"]);
        $target_file = $target_dir . uniqid() . '_' . $image_name;
        move_uploaded_file($_FILES["course_image"]["tmp_name"], $target_file);
        $image_path = $target_file;
    }

    if ($id) {
        // Update existing course
        if ($image_path) {
            $stmt = $conn->prepare("UPDATE courses SET title=?, content=?, image=? WHERE id=?");
            $stmt->bind_param("sssi", $title, $content, $image_path, $id);
        } else {
            $stmt = $conn->prepare("UPDATE courses SET title=?, content=? WHERE id=?");
            $stmt->bind_param("ssi", $title, $content, $id);
        }
    } else {
        // Insert a new course
        $stmt = $conn->prepare("INSERT INTO courses (title, content, image) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $content, $image_path);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Course saved successfully!'); window.location.href='coursesuser.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
