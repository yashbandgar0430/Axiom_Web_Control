<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'user_system', 5306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle record deletion
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM users WHERE id = $id");
}

// Handle record update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    
    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $username, $email, $id);
    $stmt->execute();
    $stmt->close();
}

// Fetch signup records
// Fetch signup records
$result = $conn->query("SELECT id, username, email, created_at, birthday FROM users");


// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Records</title>
    <style>
        /* Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            display: flex;
            justify-content: center;
            padding: 20px;
        }
        /* Main container for controls and report */
        .main-container {
            width: 90%;
            max-width: 900px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 20px;
        }

        h2 {
            background-color: #4a90e2;
            color: #fff;
            padding: 15px;
            text-align: center;
            margin: 0 -20px 20px -20px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .signuprecord-report {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #4a90e2;
            color: #fff;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }


        .edit-btn, .delete-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            margin: 0 5px;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-btn {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
<div class="main-container">
<h2>Signup Records</h2>

<table id="example" class="signuprecord-report">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Birthday</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    <td><?php echo htmlspecialchars($row['birthday']); ?></td>
                    <td>
                        <button class="edit-btn" onclick="editRecord(<?php echo $row['id']; ?>, '<?php echo htmlspecialchars($row['username']); ?>', '<?php echo htmlspecialchars($row['email']); ?>')">Edit</button>
                        <a href="?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No records found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<!-- Edit Form Modal -->
<div id="editModal" style="display:none; padding:20px; background:#fff; border: 1px solid #ccc; border-radius: 5px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
    <h3>Edit User</h3>
    <form method="POST" action="">
        <input type="hidden" name="id" id="edit-id">
        <label>Username:</label>
        <input type="text" name="username" id="edit-username" required>
        <label>Email:</label>
        <input type="email" name="email" id="edit-email" required>
        <button type="submit" name="update">Update</button>
        <button type="button" onclick="closeModal()">Cancel</button>
    </form>
</div>
</div>

<!-- jQuery and DataTables Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTable with export buttons
        $('#example').DataTable({
            dom: 'Bfrtip',
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
                    text: 'Export to PDF'
                }
            ]
        });

        // Modal control functions
        window.editRecord = function(id, username, email) {
            $('#edit-id').val(id);
            $('#edit-username').val(username);
            $('#edit-email').val(email);
            $('#editModal').show();
        };

        window.closeModal = function() {
            $('#editModal').hide();
        };
    });
</script>
</body>
</html>
