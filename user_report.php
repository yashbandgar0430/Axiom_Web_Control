<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch user ID from session
$user_id = $_SESSION['user_id'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'user_system', 5306);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details
$stmt = $conn->prepare("SELECT username, email, profile_picture FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_query = $stmt->get_result();
$user = $user_query->fetch_assoc();
$stmt->close();

// Fetch current courses with taken date
$current_courses_query = $conn->prepare("
    SELECT courses.title, enrollment_date, 'current' AS status
    FROM enrollments 
    JOIN courses ON enrollments.course_id = courses.id 
    WHERE enrollments.user_id = ? AND enrollments.status = 'current'");
$current_courses_query->bind_param("i", $user_id);
$current_courses_query->execute();
$current_courses = $current_courses_query->get_result();

// Fetch completed courses with taken date
$completed_courses_query = $conn->prepare("
    SELECT courses.title, enrollment_date, 'completed' AS status
    FROM enrollments 
    JOIN courses ON enrollments.course_id = courses.id 
    WHERE enrollments.user_id = ? AND enrollments.status = 'completed'");
$completed_courses_query->bind_param("i", $user_id);
$completed_courses_query->execute();
$completed_courses = $completed_courses_query->get_result();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Course Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; }
        .container { max-width: 800px; margin-top: 50px; }
        h2 { color: #333; }
        .course-section { margin-bottom: 20px; }
        .course-section h5 { color: #007bff; }
        table { width: 100%; margin-top: 10px; }
        th, td { padding: 10px; text-align: left; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
    </style>
</head>
<body>

<div class="container">
    <h2><?php echo htmlspecialchars($user['username']); ?>'s Course Report</h2>

    <!-- Course Report Table (Current + Completed) -->
    <div class="course-section">
        <h5>Courses Report</h5>
        <?php if ($current_courses->num_rows > 0 || $completed_courses->num_rows > 0): ?>
            <table id="coursesTable">
                <thead>
                    <tr>
                        <th>Course Title</th>
                        <th>Taken Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Combine both current and completed courses in one table
                    while ($course = $current_courses->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($course['title']); ?></td>
                            <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($course['enrollment_date']))); ?></td>
                            <td><?php echo htmlspecialchars($course['status']); ?></td>
                        </tr>
                    <?php endwhile; 
                    while ($course = $completed_courses->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($course['title']); ?></td>
                            <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($course['enrollment_date']))); ?></td>
                            <td><?php echo htmlspecialchars($course['status']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No courses found.</p>
        <?php endif; ?>
    </div>
</div>

<!-- DataTable Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTable with export buttons and search option for all courses (current + completed)
        $('#coursesTable').DataTable({
            dom: '<"dt-controls"Bf>rt',
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: 'Copy'
                },
                {
                    extend: 'excelHtml5',
                    text: 'Export to Excel'
                },
                {
                    extend: 'csvHtml5',
                    text: 'Export to CSV'
                },
                {
                    extend: 'pdfHtml5',
                    text: 'Export to PDF',
                    customize: function(doc) {
                        // You can customize the PDF document here if needed
                        doc.styles.tableHeader = {
                            bold: true,
                            fontSize: 12,
                            color: 'white',
                            fillColor: '#007bff'
                        };
                    }
                }
            ]
        });
    });
</script>

</body>
</html>
