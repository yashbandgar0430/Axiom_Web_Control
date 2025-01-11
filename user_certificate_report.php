<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_system";
$port = 5306;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch certificate data
$sql = "SELECT id, name, course_name, created_at    FROM certificates";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            display: flex;
            justify-content: center;
            padding: 20px;
        }

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

        .certificate-report {
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

        .no-certificates {
            padding: 20px;
            text-align: center;
            color: #777;
        }

        .dt-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .dt-buttons .dt-button {
            display: inline-block;
            padding: 8px 16px;
            margin-right: 5px;
            background-color: #4a90e2;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .dt-buttons .dt-button:hover {
            background-color: #357abd;
        }
    </style>
</head>
<body>

<div class="main-container">
    <h2>Certificate Records</h2>

    <!-- DataTable controls for export buttons and search bar -->
    <div class="dt-controls">
        <!-- Export Buttons -->
      
        
        <!-- Search bar provided by DataTables -->
        <div class="search-bar">
            <!-- DataTables will automatically add the search input here -->
        </div>
    </div>

    <div class="certificate-report">
        <?php if ($result->num_rows > 0): ?>
            <table id="certificateTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Course Name</th>
                        <th>Download Date</th>
                     
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo htmlspecialchars($row["name"]); ?></td>
                            <td><?php echo htmlspecialchars($row["course_name"]); ?></td>
                            <td><?php echo htmlspecialchars($row["created_at"]); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-certificates">No certificates available.</div>
        <?php endif; ?>
    </div>
</div>

<?php $conn->close(); ?>

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
        // Initialize DataTable with export buttons and search option
        $('#certificateTable').DataTable({
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
                    text: 'Export to PDF'
                }
            ]
        });
    });
</script>

</body>
</html>
