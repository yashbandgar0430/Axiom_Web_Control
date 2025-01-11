<?php
session_start(); // Start the session to handle success messages
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('./images/navbarbackground.png'); /* Replace with your image path */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
        }
        .navbar {
            background-image: url(''); /* Replace with the path to your image */
            background-size: cover;
            background-position: center;
        }
        .navbar-brand img {
            width: 200px;
            height: auto;
            margin-right: 15px;
        }
        .nav-link {
            position: relative;
            padding-bottom: 5px;
            transition: color 0.3s;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 2px;
            background: #007bff;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        .nav-link:hover {
            color: #007bff;
        }
        .nav-link:hover::after {
            transform: scaleX(1);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="images/navname1.png" alt="Logo" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact-us.php">Contact Us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
}
?>

<div class="container">
    <h1 style="color:white;" class="mt-5">Turn Your Product Vision Into Reality</h1>
    <form action="process_form.php" method="POST">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label style="color:white;" for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Enter First Name" required>
            </div>
            <div class="form-group col-md-6">
                <label style="color:white;" for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Enter Last Name" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label style="color:white;" for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email Address" required>
            </div>
            <div class="form-group col-md-6">
                <label style="color:white;" for="phone">Phone Number</label>
                <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone Number" required>
            </div>
        </div>
        <div class="form-group">
            <label style="color:white;" for="services">Select Services</label>
            <select name="services" id="services" class="form-control" required>
                <option value="">Select...</option>
                <option value="Web Development">Web Development</option>
                <option value="Mobile App Development">Mobile App Development</option>
                <option value="SEO Services">SEO Services</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label style="color:white;" for="message">How can we help you?</label>
            <textarea name="message" id="message" class="form-control" rows="4" placeholder="Please explain in detail" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>
