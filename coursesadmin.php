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
    $image_path = '';

    // Handle file upload
    if (isset($_FILES['course_image']) && $_FILES['course_image']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $image_name = basename($_FILES["course_image"]["name"]);
        $target_file = $target_dir . uniqid() . '_' . $image_name;
        move_uploaded_file($_FILES["course_image"]["tmp_name"], $target_file);
        $image_path = $target_file;
    }

    if ($id) {
        // Update course
        if ($image_path) {
            $stmt = $conn->prepare("UPDATE courses SET title=?, content=?, image=? WHERE id=?");
            $stmt->bind_param("sssi", $title, $content, $image_path, $id);
        } else {
            $stmt = $conn->prepare("UPDATE courses SET title=?, content=? WHERE id=?");
            $stmt->bind_param("ssi", $title, $content, $id);
        }
    } else {
        // Insert new course
        $stmt = $conn->prepare("INSERT INTO courses (title, content, image) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $content, $image_path);
    }

    if ($stmt->execute()) {
        echo "Course saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch current courses from the database
$result = $conn->query("SELECT * FROM courses");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Course Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
    <style>
        .navbar-brand img {
            width: 200px;
            height: auto;
            margin-right: 15px;
        }
        /* Navbar and layout styles */
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="images/navname1.png" alt="Logo" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact-us.php">Contact Us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="text-center">Manage Courses</h1>

    <form action="courses.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="course_id" id="course_id" value="">
        <div class="mb-3">
            <label for="course_title" class="form-label">Course Title</label>
            <input type="text" class="form-control" id="course_title" name="course_title" required>
        </div>
        <div class="mb-3">
            <label for="course_content" class="form-label">Course Content</label>
            <textarea class="form-control" id="course_content" name="course_content" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label for="course_image" class="form-label">Course Image</label>
            <input type="file" class="form-control" id="course_image" name="course_image">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Save Course</button>
    </form>

    <h2>Current Courses</h2>
    <table id="feedbackTable" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['title'] ?></td>
                    <td><?= $row['content'] ?></td>
                    <td><img src="<?= $row['image'] ?>" alt="Course Image" style="width: 100px; height: auto;"></td>
                    <td>
                        <button class="btn btn-warning" onclick="editCourse(<?= $row['id'] ?>, '<?= addslashes($row['title']) ?>', '<?= addslashes($row['content']) ?>')">Edit</button>
                        <button class="btn btn-danger" onclick="deleteCourse(<?= $row['id'] ?>)">Delete</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
    function editCourse(id, title, content) {
        document.getElementById('course_id').value = id;
        document.getElementById('course_title').value = title;
        document.getElementById('course_content').value = content;
    }

    function deleteCourse(id) {
        if (confirm("Are you sure you want to delete this course?")) {
            window.location = "delete_courses.php?id=" + id;
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#feedbackTable').DataTable({
            dom: '<"dt-controls"Bf>rt',
            buttons: [
                { extend: 'copyHtml5', text: 'Copy' },
                { extend: 'excelHtml5', text: 'Export to Excel' },
                { extend: 'csvHtml5', text: 'Export to CSV' },
                { extend: 'pdfHtml5', text: 'Export to PDF' }
            ]
        });
    });
</script>

<?php $conn->close(); ?>
</body>
</html>
