<?php
// customize_course.php

// Database connection parameters
$host = 'localhost'; // Change if your host is different
$dbname = 'user_system'; // Your database name
$username = 'root'; // Your database username
$password = ''; // Your database password

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname ,port:5306);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_POST['submit_custom_course'])) {
    // Sanitize input data
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $desired_course = $conn->real_escape_string($_POST['desired_course']);
    $description = $conn->real_escape_string($_POST['description']);

    // Prepare the SQL statement
    $sql = "INSERT INTO custom_courses (username, email, desired_course, description) VALUES ('$username', '$email', '$desired_course', '$description')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Custom course request submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customize Course</title>
    <link rel="stylesheet" href="styles.css"> <!-- Optional: Link to your CSS -->
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('./images/img3.png'); /* Replace with your image path */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            overflow: hidden; /* Prevent scrollbars */
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.9); 
            background-image: url('./images/homepage2.png');/* Slightly transparent white */
            padding: 30px; /* Increased padding for better spacing */
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Deeper shadow for depth */
            max-width: 400px; /* Max width of the form */
            width: 90%; /* Use 90% width on smaller screens */
            opacity: 0; /* Start invisible for animation */
            animation: fadeIn 0.5s forwards; /* Animation */
        }

        /* Fade-in animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); } /* Start above */
            to { opacity: 1; transform: translateY(0); } /* End at original position */
        }

        h2 {
            text-align: center; /* Center the heading */
            margin-bottom: 20px; /* Space below the heading */
            color: #333; /* Darker color for better readability */
        }

        form label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #555; /* Darker text for labels */
        }

        form input, form textarea {
            width: 100%;
            padding: 12px; /* Increased padding for inputs */
            margin-bottom: 15px; /* More space between fields */
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px; /* Larger font size */
            transition: border-color 0.3s ease; /* Transition effect on focus */
        }

        form input:focus, form textarea:focus {
            border-color: #007bff; /* Highlight border on focus */
            outline: none; /* Remove default outline */
        }

        .submit-btn {
            padding: 12px 20px; /* Increased padding */
            font-size: 18px; /* Larger font size */
            font-weight: bold;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease; /* Add transform transition */
        }

        .submit-btn:hover {
            background-color: #0056b3;
            transform: scale(1.05); /* Slightly enlarge on hover */
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Request a Custom Course</h2>
    <form action="customize_course.php" method="POST">
        <label for="username">Name:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="desired_course">Course Title:</label>
        <input type="text" id="desired_course" name="desired_course" required>

        <label for="description">Course Description:</label>
        <textarea id="description" name="description" rows="4"></textarea>

        <button type="submit" name="submit_custom_course" class="submit-btn">Submit</button>
    </form>
</div>

</body>
</html>
