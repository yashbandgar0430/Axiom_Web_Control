<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'user_system', 5306);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch custom course requests
$result = $conn->query("SELECT id, username, email, desired_course, description, created_at FROM custom_courses");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Course Requests Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #343a40;
            margin-bottom: 20px;
            font-size: 2rem;
        }

        .download-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
            transition: background-color 0.3s ease-in-out;
        }

        .download-btn:hover {
            background-color: #0056b3;
            color: white;
        }

        table.dataTable {
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            background-color: white;
            margin: 0 auto;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        table.dataTable thead {
            background-color: #007bff;
            color: white;
        }

        table.dataTable thead th {
            font-weight: bold;
            text-align: center;
        }

        table.dataTable tbody tr {
            transition: background-color 0.3s;
        }

        table.dataTable tbody tr:hover {
            background-color: #f1f1f1;
        }

        table.dataTable tbody td {
            text-align: center;
            vertical-align: middle;
        }

        footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
</head>
<body>

<h2>Custom Course Requests</h2>

<table id="custom_courses_table" class="display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Course Title</th>
            <th>Description</th>
            <th>Requested At</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['desired_course']); ?></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td><?php echo $row['created_at']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<footer>
    © 2024 Custom Course Reports. All rights reserved.
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        $('#custom_courses_table').DataTable({
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
                    text: 'Export to PDF',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    customize: function(doc) {
                        doc.styles.tableHeader = {
                            bold: true,
                            fontSize: 11,
                            color: 'white',
                            fillColor: '#007bff',
                            alignment: 'center'
                        };
                        doc.content[1].table.widths = ['10%', '20%', '20%', '20%', '20%', '10%'];
                    }
                }
            ]
        });
    });
</script>
</body>
</html>
