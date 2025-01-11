<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_system";
$port = 5306; // specify your port here

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ""; // Initialize message variable

// Check if form data is sent
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST["name"]);
    $contact = $conn->real_escape_string($_POST["contact"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $feedback = $conn->real_escape_string($_POST["feedback"]);

    // Insert data into feedback table
    $sql = "INSERT INTO feedback (name, contact, email, feedback) VALUES ('$name', '$contact', '$email', '$feedback')";

    if ($conn->query($sql) === TRUE) {
        $message = "Thank you for your feedback!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>We are welcoming your Suggesions here.....</title>
  <style>
    /* Basic reset and styling */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      color: #fff;
    }

    .feedback-container {
      background-color: #d3d3d3;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      backdrop-filter: blur(10px);
      animation: fadeIn 1.5s ease-in-out;
    }

    h2 {
      text-align: center;
      margin-bottom: 1rem;
      font-size: 2rem;
    }

    .feedback-form {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .feedback-form input, .feedback-form textarea {
      width: 100%;
      padding: 0.8rem;
      border: none;
      border-radius: 5px;
      background: rgba(255, 255, 255, 0.2);
      color: #fff;
      font-size: 1rem;
      outline: none;
      transition: background 0.3s ease;
    }

    .feedback-form input:hover, .feedback-form textarea:hover {
      background: rgb(255, 102, 153);
    }

    .feedback-form button {
      padding: 0.8rem;
      border: none;
      border-radius: 5px;
      background: #ff6a00;
      color: #fff;
      font-size: 1.1rem;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .feedback-form button:hover {
      background: #ff8800;
    }

    /* Keyframe animations */
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes pulse {
      0%, 100% {
        box-shadow: 0 0 5px rgba(255, 106, 0, 0.8), 0 0 10px rgba(255, 106, 0, 0.4);
      }
      50% {
        box-shadow: 0 0 20px rgba(255, 106, 0, 0.8), 0 0 40px rgba(255, 106, 0, 0.4);
      }
    } 

    .feedback-form button {
      animation: pulse 2s infinite;
    }
  </style>
</head>
<body>

  <div class="feedback-container">
    <h2 style="color:rgb(255, 102, 153)">We are welcoming your Suggesions here.....</h2>
    <form class="feedback-form" action="#" method="post">
      <input type="text" name="name" placeholder="Your Name" required>
      <input type="tel" name="contact" placeholder="Your Contact Number" required>
      <input type="email" name="email" placeholder="Your Email" required>
      <textarea name="feedback" rows="4" placeholder="Your Feedback" required></textarea>
      <button type="submit">Submit Feedback</button>
    </form>
  </div>

</body>
</html>