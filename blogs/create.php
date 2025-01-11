<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Blog</title>
</head>
<body>

<h1>Create New Blog</h1>
<form action="create.php" method="POST">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required>
    
    <label for="content">Content:</label>
    <textarea id="content" name="content" required></textarea>

    <button type="submit" name="create">Create Blog</button>
</form>

<?php
if (isset($_POST['create'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_POST['image'];
    
    $stmt = $conn->prepare("INSERT INTO blogs (title, content, image) VALUES (?, ?, ?)");
    $stmt->bind_param("ss", $title, $content);
    $stmt->execute();
    $stmt->close();
    
    header("Location: index.php"); // Redirect to the blog list
}
?>

</body>
</html>
