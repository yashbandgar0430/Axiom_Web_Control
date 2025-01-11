<?php
$conn = new mysqli('localhost', 'username', 'password', 'user_system',port:5306);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];
$image = $_POST['image'];

$sql = "UPDATE blogs SET title='$title', content='$content', image='$image' WHERE id=$id";
$conn->query($sql);
$conn->close();
?>
