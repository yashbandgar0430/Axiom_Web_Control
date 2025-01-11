<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        /* Body and background styles */
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('images/img1.png');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            color: #333;
        }

        /* Navbar styling */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #FFFFFF;
            padding: 10px 20px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar-brand img {
            width: 200px;
            height: auto;
        }

        .navbar-links {
            display: flex;
            justify-content: flex-end;
        }

        .navbar-links a {
            color: black;
            text-decoration: none;
            padding: 14px 20px;
            font-size: 16px;
            transition: color 0.3s;
        }

        .navbar-links a:hover {
            color: #0069FF;
        }

        .navbar-links a.active {
            color: #0069FF;
        }

        .signup-container {
    position: relative; /* Enables positioning of ::before within this element */
    padding: 30px;
    width: 300px;
    margin: 50px auto;
    text-align: center;
    background-color: rgba(255, 255, 255, 0.9); /* Slightly transparent background */
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 2; /* Places content above the background image */
}

/* Background image styling for the container */
.signup-container::before {
    content: "";
    background-image: url('images/homepage2.png');
    background-size: cover;
    background-position: center;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1; /* Keeps the background behind the container content */
    opacity: 0.3; /* Controls the visibility of the background image */
    border-radius: 8px; /* Matches the border radius of the container */
}

/* Ensures form content appears above background */
.signup-container * {
    position: relative;
    z-index: 2;
}

        /* Form styling */
        form label {
            display: block;
            font-size: 16px;
            margin-bottom: 8px;
            color: #555;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        /* Button styling */
        form button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        form button:hover {
            background-color: #0056b3;
        }
      
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <a class="navbar-brand" href="{{ url('/') }}">
        <img src="./images/navname1.png" alt="Company Logo">
    </a>
    <div class="navbar-links">
        <a href="./home.php" class="active animate__animated animate__fadeInDown">Home</a>
        <a href="#" class="animate__animated animate__fadeInDown">Portfolio</a>
        <a href="#" class="animate__animated animate__fadeInDown">Services</a>
        <a href="blogs.php" class="animate__animated animate__fadeInDown">Blog</a>
        <a href="contact-us.php" class="btn-custom animate__animated animate__fadeInDown">Contact Us</a>
    </div>
</div>

<!-- Signup form container -->
<div class="signup-container">
    <h2>Signup</h2>
    <form action="signup.php" method="POST" enctype="multipart/form-data">
        <label>Username:</label>
        <input type="text" name="username" required>
        
        <label>Email:</label>
        <input type="email" name="email" required>
        
        <label>Password:</label>
        <input type="password" name="password" required>

        <label>Profile Picture:</label>
        <input type="file" name="profile_picture" accept="image/*">

        <label>Birthday:</label>
        <input type="date" name="birthday">

        <button type="submit" name="signup">Signup</button>
    </form>
</div>

<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'user_system', 5306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hashing password
    $birthday = $_POST['birthday'];

    // Handle profile picture upload
    $profile_picture = null;
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $target_dir = "uploads/"; // Ensure this directory exists and is writable
        $target_file = $target_dir . basename($_FILES['profile_picture']['name']);
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file);
        $profile_picture = $target_file;
    }

    // Insert user data into database
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, profile_picture, birthday) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $email, $password, $profile_picture, $birthday);
    $stmt->execute();
    $stmt->close();

    echo "Signup successful. <a href='login.php'>Login here</a>";
}
?>

