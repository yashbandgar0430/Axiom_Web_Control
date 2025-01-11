<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Debugging: Check if user_id is set
if (!isset($_SESSION['user_id'])) {
    die("User ID is not set in session. Please log in again.");
}

// Fetch user ID from session
$user_id = $_SESSION['user_id'];

// Debugging: Print user_id to check its value
echo "User ID: " . htmlspecialchars($user_id); 

// Database connection
$conn = new mysqli('localhost', 'root', '', 'user_system', 5306);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details using a prepared statement
$stmt = $conn->prepare("SELECT username, email, profile_picture, birthday FROM users WHERE id = ?");
if ($stmt) {
    $stmt->bind_param("i", $user_id); // "i" means the variable is an integer
    $stmt->execute();
    $user_query = $stmt->get_result();

    // Check if any user was found
    if ($user_query->num_rows === 0) {
        die("User not found.");
    }

    $user = $user_query->fetch_assoc();
} else {
    die("Failed to prepare statement: " . $conn->error);
}

// Fetch current and completed courses
$current_courses = $conn->query("SELECT courses.title FROM enrollments JOIN courses ON enrollments.course_id = courses.id WHERE enrollments.user_id = $user_id AND enrollments.status = 'current'");
$completed_courses = $conn->query("SELECT courses.title FROM enrollments JOIN courses ON enrollments.course_id = courses.id WHERE enrollments.user_id = $user_id AND enrollments.status = 'completed'");

// Close the statement and connection
$stmt->close();
$conn->close();
// Check if a search query is provided

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <style>
        /* General page styles */
        
    /* General page styles */
    body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('./images/img3.png'); /* Replace with your image path */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
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
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.navbar-brand img {
    max-width: 250px; /* Adjust this value as needed */
    height: auto; /* Maintain aspect ratio */
}

/* Navbar links */
/* Animation on hover */
.navbar-links a {
    color: black;
    text-decoration: none;
    padding: 14px 20px;
    font-size: 16px;
    transition: transform 0.3s ease, color 0.3s ease;
}

.navbar-links a:hover {
    transform: scale(1.1); /* Scale up on hover */
    color: #007bff; /* Change color on hover */
}

/* Fade-in animation for each link */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.navbar-links a {
    opacity: 0;
    animation: fadeIn 0.8s ease forwards;
}

/* Staggered animation delay for each link */
.navbar-links a:nth-child(1) { animation-delay: 0.1s; }
.navbar-links a:nth-child(2) { animation-delay: 0.2s; }
.navbar-links a:nth-child(3) { animation-delay: 0.3s; }
.navbar-links a:nth-child(4) { animation-delay: 0.4s; }
.navbar-links a:nth-child(5) { animation-delay: 0.5s; }
.navbar-links a:nth-child(6) { animation-delay: 0.6s; }

/* Profile dropdown */
.profile-dropdown {
    position: relative;
    display: inline-block;
}

.profile-icon img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    cursor: pointer;
    border: 2px solid #007bff; /* Adds a border around the profile image */
    transition: transform 0.2s;
}

.profile-icon img:hover {
    transform: scale(1.1); /* Slightly enlarges the icon on hover */
}

.profile-details {
    display: none; /* Initially hidden */
    position: absolute;
    top: 60px; /* Adjust as needed */
    right: 0;
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 15px;
    z-index: 100;
    min-width: 250px; /* Sets a minimum width for the dropdown */
}

.profile-details img {
    width: 100px; /* Fixed width for profile picture */
    height: 100px; /* Fixed height for profile picture */
    border-radius: 50%; /* Makes it circular */
    margin-bottom: 10px;
}

.profile-details h3 {
    margin: 0;
}

.profile-details p {
    margin: 5px 0;
    font-size: 14px;
}

/* Container styles */
.container {
    max-width: 800px;
    margin: 80px auto 20px; /* Add margin-top for navbar */
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h2 {
    margin-bottom: 20px;
    color: #333;
}

/* Ads Carousel */
.adsCarousel {
    max-width: 800px; /* Adjust the max-width as needed */
    margin: 0 auto;   /* Center the carousel */
}

.adsCarousel .carousel-inner img {
    max-height: 500px; /* Adjust the max-height as needed */
    width: auto;       /* Maintain the image aspect ratio */
    object-fit: cover; /* Ensures images fit within the defined area */
}
.carousel-caption {
    background: rgba(0, 0, 0, 0.5);
    padding: 10px;
    border-radius: 5px;
}

/* Course list styles */
h5 {
    margin-top: 15px;
    color: #007bff;
}

ul {
    list-style-type: none;
    padding: 0;
}

ul li {
    background: #f8f9fa;
    margin: 5px 0;
    padding: 10px;
    border-radius: 5px;
    transition: background 0.3s;
}

ul li:hover {
    background: #e9ecef; /* Change background on hover */
}

</style>
    <script>
        function toggleProfileDetails() {
            const details = document.querySelector('.profile-details');
            details.style.display = details.style.display === 'block' ? 'none' : 'block';
        }

        // Close dropdown if clicked outside
        window.onclick = function(event) {
            if (!event.target.matches('.profile-icon img')) {
                const details = document.querySelector('.profile-details');
                if (details.style.display === 'block') {
                    details.style.display = 'none';
                }
            }
        }
    </script>
</head>
<body>

    <!-- Navbar with profile icon -->
    <div class="navbar">
        <a class="navbar-brand" href="./home.php">
            <img src="./images/navname1.png" alt="Company Logo">
        </a>
        <div class="navbar-links">
            <a href="home.php" class="active">Home</a>
            <a href="#">Portfolio</a>
            <a href="coursesuser.php">Courses</a>
            <a href="blogsuser.php">Blog</a>
            <a href="contact-us.php">Contact Us</a>
            <a href="signup.php" class="btn-register animate__animated animate__bounceIn">Register</a>
           

            <div class="profile-dropdown">
                <!-- Profile Icon -->
                <a href="#" class="profile-icon" onclick="toggleProfileDetails()">
                    <img src="./images/profilelogo.png" alt="User Icon">
                </a>
                <!-- Profile Details -->
                <div class="profile-details">
                    <img src="<?php echo $user['profile_picture']; ?>" alt="Profile Picture" class="img-fluid rounded-circle mb-3" style="width: 100px; height: 100px;">
                    <h3><?php echo htmlspecialchars($user['username']); ?></h3>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                    <p><strong>Birthday:</strong> <?php echo htmlspecialchars($user['birthday']); ?></p>
                    <h5>Current Courses</h5>
                    <?php if ($current_courses->num_rows > 0): ?>
                        <ul>
                            <?php while ($course = $current_courses->fetch_assoc()): ?>
                                <li><?php echo htmlspecialchars($course['title']); ?></li>
                            <?php endwhile; ?>
                        </ul>
                    <?php else: ?>
                        <p>No current courses.</p>
                    <?php endif; ?>
                    <h5>Completed Courses</h5>
                    <?php if ($completed_courses->num_rows > 0): ?>
                        <ul>
                            <?php while ($course = $completed_courses->fetch_assoc()): ?>
                                <li><?php echo htmlspecialchars($course['title']); ?></li>
                            <?php endwhile; ?>
                        </ul>
                    <?php else: ?>
                        <p>No completed courses.</p>
                    <?php endif; ?>
                    <h5>Upload New Profile Picture</h5>
    <form action="update_profile.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="profile_picture" id="profile_picture" accept="image/*" class="form-control mb-3" onchange="this.form.submit()">
       
    </form>
        
    
                    <form action="logout.php" method="POST" class="mt-3">
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Message -->
    <div class="container mt-5 pt-5 text-center">
        <h2 style="color:white;">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p style="color:white;">This is your profile page.</p>
    </div>

    <!-- Ads Carousel -->
    <div id="adsCarousel" class="carousel slide adsCarousel" data-bs-ride="carousel">
    <div class="carousel-inner">
        
        <!-- Ad 1 -->
        <div class="carousel-item active">
            <img src="./images/Web-Development1.png" class="d-block w-100" alt="Course Ad 1">
            <div class="carousel-caption d-none d-md-block">
                <h5>Learn Web Development</h5>
                <p>Get started with our beginner-friendly web development course. Limited time offer!</p>
            </div>
        </div>

        <!-- Ad 2 -->
        <div class="carousel-item">
            <img src="./images/webdevlopmentcourses.png" class="d-block w-100" alt="Course Ad 2">
            <div class="carousel-caption d-none d-md-block">
                <h5>Web Development Courses</h5>
                <p>Explore advanced topics and enhance your skills. Join now!</p>
            </div>
        </div>

        <!-- Ad 3 -->
        <div class="carousel-item">
            <img src="./images/add1.jpg" class="d-block w-100" alt="Course Ad 3">
            <div class="carousel-caption d-none d-md-block">
                <h5>Here is a New arrived </h5>
                <p>Responsive website Design ,Mobile Application Development , E-commerce Webisite Design </p>
            </div>
        </div>

        <!-- Ad 4 -->
        <div class="carousel-item">
            <img src="./images/ecommerce.png" class="d-block w-100" alt="Course Ad 4">
            <div class="carousel-caption d-none d-md-block">
                <h5>E-commerce Design</h5>
                <p>Create powerful online stores. Limited seats available!</p>
            </div>
        </div>

        <!-- Ad 5 -->
        <div class="carousel-item">
            <img src="./images/uiuxdesign.png" class="d-block w-100" alt="Course Ad 5">
            <div class="carousel-caption d-none d-md-block">
                <h5>UI/UX Design</h5>
                <p>Master user experience and design skills. Sign up now!</p>
            </div>
        </div>

        <!-- Ad 6 -->
        <div class="carousel-item">
            <img src="./images/datascience.png" class="d-block w-100" alt="Course Ad 6">
            <div class="carousel-caption d-none d-md-block">
                <h5>Data Science</h5>
                <p>Dive into data analysis and machine learning. Join our program!</p>
            </div>
        </div>

    </div>

    <!-- Carousel controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#adsCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#adsCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


    <script>
        // Carousel auto-slide
        var myCarousel = document.querySelector('#adsCarousel');
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 3000,
            ride: 'carousel'
        });
    </script>
</body>
</html>
