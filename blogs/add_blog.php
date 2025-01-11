<?php
$conn = new mysqli('localhost', 'username', 'password', 'user_system',port:5306);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title = $_POST['title'];
$content = $_POST['content'];
$image = $_POST['image'];

$sql = "INSERT INTO blogs (title, content, image) VALUES ('$title', '$content', '$image')";
$conn->query($sql);
$conn->close();
?>
