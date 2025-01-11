<?php
session_start();

// Define admin credentials
$adminUsername = "admin";
$adminPassword = "admin123"; // For security, use a hashed password in production

// Database connection
$conn = new mysqli('localhost', 'root', '', 'user_system', 5306);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the credentials match the admin account
    if ($username === $adminUsername && $password === $adminPassword) {
        // Set session variables for the admin
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = "admin"; // Optional, as a placeholder for admin
        header("Location: admin-panel.php"); // Redirect to the admin panel
        exit();
    } else {
        // Prepare and execute query for normal users
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Verify the hashed password in the database
            if (password_verify($password, $user['password'])) {
                // Set session variables for the user
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_id'] = $user['id']; // Store user ID in session
                header("Location: profile.php"); // Redirect to user profile
                exit();
            } else {
                echo "Incorrect password!";
            }
        } else {
            echo "User not found!";
        }
        $stmt->close();
    }
}
$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
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

        /* Container styling */
/* Signup container styling */
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

/* Login and Signup Button Styling */
/* Login and Signup Button Styling */
.btn-login, .btn-signup {
    display: inline-block;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    color: #fff;
    font-weight: bold;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
    text-decoration: none;
}

/* Add margin to the Login button to create a gap */
.btn-login {
    background-color: #007bff;
    margin-right: 10px; /* Adds space between Login and Signup buttons */
}

.btn-login:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}

.btn-signup {
    background-color: #007bff;
    margin-right: 10px;
}

.btn-signup:hover {
    background-color: #5a6268;
    transform: scale(1.05);
}



/* Remove outline on button focus */
.btn-login:focus, .btn-signup:focus {
    outline: none;
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
<div class="signup-container">
    <h2>Login</h2>
    <form action="login.php" method="POST">
        <label>Username:</label>
        <input type="text" name="username" required><br><br>
        
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        
        <button type="submit" name="login" class="btn-login">Login</button>
        <a href="./signup.php" class="btn-signup">Signup</a>
       
    </form>
</div>


</body>
</html>


