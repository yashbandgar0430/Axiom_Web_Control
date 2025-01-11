<?php
$conn = new mysqli('localhost', 'username', 'password', 'user_system',port:5306);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];

$sql = "DELETE FROM blogs WHERE id=$id";
$conn->query($sql);
$conn->close();
?>
