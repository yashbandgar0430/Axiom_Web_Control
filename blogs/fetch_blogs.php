<?php
$conn = new mysqli('localhost', 'root', '', 'user_system',port:5306); // Update with your DB credentials

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM blogs";
$result = $conn->query($sql);

$blogs = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $blogs[] = $row;
    }
}

$conn->close();
echo json_encode($blogs);
?>

