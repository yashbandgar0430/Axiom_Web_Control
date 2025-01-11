<?php
// Database connection
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = "";     // Replace with your database password
$dbname = "user_system";

$conn = new mysqli($servername, $username, $password, $dbname,port:5306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$signup_query = "SELECT id, username, email, created_at, profile_picture, birthday FROM users";
$signup_result = $conn->query($signup_query);

$courses_query = "SELECT id, title, content, image, created_at FROM courses";
$courses_result = $conn->query($courses_query);

$feedback_query = "SELECT name, feedback FROM feedback";
$feedback_result = $conn->query($feedback_query);
$feedbacks = [];
if ($feedback_result->num_rows > 0) {
    while ($row = $feedback_result->fetch_assoc()) {
        $feedbacks[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
       body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-image: url('./images/background2.jpg'); /* Replace with your image path */
    background-repeat: repeat; /* Repeat the image */
    background-size: auto; /* Default size for repeated patterns */
    background-position: top left; /* Start repeating from the top-left corner */
}

        .navbar {
            display: flex;
            justify-content: space-between; /* Space between brand and links */
            align-items: center; /* Vertically center items */
            background-color: #282c34; /* Dark background */
            padding: 15px; /* Padding around the navbar */
        }

        .brand {
            font-size: 2em; /* Increase font size */
            font-weight: bold; /* Make the font bold */
            color: #61dafb; /* Bright color for the text */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Subtle shadow effect */
            animation: fadeIn 1.5s ease-in-out; /* Animation for the title */
        }

        /* Animation keyframes */
        @keyframes fadeIn {
            from {
                opacity: 0; /* Start with opacity 0 */
                transform: translateY(-20px); /* Start slightly higher */
            }
            to {
                opacity: 1; /* End with full opacity */
                transform: translateY(0); /* Move to original position */
            }
        }

        .nav-links {
            display: flex;
            align-items: center; /* Align items vertically in the middle */
        }

        .nav-links a {
            color: #ffffff; /* Text color for links */
            padding: 10px 15px; /* Padding for links */
            text-decoration: none; /* Remove underline from links */
            transition: color 0.3s ease; /* Smooth color transition */
        }

        .nav-links a:hover {
            color: #61dafb; /* Change color on hover */
        }

        .profile {
            position: relative; /* Position relative for dropdown positioning */
            cursor: pointer; /* Cursor changes to pointer */
        }

        .profile-icon {
            width: 40px; /* Set icon size */
            height: 40px; /* Set icon size */
            border-radius: 50%; /* Make icon circular */
        }

        .dropdown-content {
            display: none; /* Hide dropdown by default */
            position: absolute; /* Position dropdown relative to profile */
            right: 0; /* Align to the right */
            background-color: #f9f9f9; /* Light background */
            min-width: 100px; /* Minimum width for dropdown */
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); /* Shadow for dropdown */
            z-index: 1; /* Ensure dropdown appears above other elements */
        }

        .dropdown-content a {
            color: black; /* Text color for dropdown items */
            padding: 12px 16px; /* Padding for dropdown items */
            text-decoration: none; /* Remove underline */
            display: block; /* Make dropdown items block elements */
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1; /* Background color on hover */
        }
        .container {
            padding: 20px;
        }

        .section {
            display: none;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .active {
            display: block;
        }
      
        button {
            padding: 10px 15px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
     
        .feedback-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            overflow: hidden;
        }

        .feedback-slide {
            display: none;
        }

        .feedback-slide.active {
            display: block;
        }

        .feedback-name {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .feedback-text {
            font-size: 16px;
            color: #555;
        }
    

/* Container styling */
.container {
    max-width: 1200px;
    margin: auto;
    padding: 20px;
}

/* Card styling */
.card {
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    margin-bottom: 20px;
    overflow: hidden;
}

/* Card header styling */
.card-header {
    font-weight: bold;
    font-size: 18px;
    text-align: center;
    padding: 10px 0;
}

/* Tables inside the cards */
.table {
    margin: 0;
    font-size: 14px;
    text-align: left;
    background-color: white;
}

.table th {
    background-color: black; /* Dark header background */
    color: white;
    text-align: center;
    padding: 10px;
}

.table td {
    padding: 8px;
    text-align: center;
    vertical-align: middle;
}

/* Hover effects for rows */
.table tbody tr:hover {
    background-color: black;
    color: white; /* Light gray hover effect */
}

/* Profile picture styling (optional) */
.table img {
    width: 40px;
    height: 40px;
    border-radius: 50%; /* Circular profile picture */
    object-fit: cover;
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .card {
        margin-bottom: 15px;
    }

    .table {
        font-size: 12px;
    }
}


    </style>
</head>
<body>
    <div class="navbar">
        <div class="brand">Admin Panel</div>
        <div class="nav-links">
            <a href="#" onclick="showSection('dashboard')">Signup Entries</a>
            <a href="#" onclick="showSection('manageStudents')">Manage student courses</a>
            <a href="#" onclick="showSection('manageAds')">Customize Course</a>
            <a href="#" onclick="showSection('manageCourses')">Manage Courses</a>
            <a href="#" onclick="showSection('manageBlogs')">Manage Blogs</a>
            <a href="#" onclick="showSection('feedback')">User Feedback</a>
            <a href="#" onclick="showSection('contactus')">Contact_us</a>
            <a href="#" onclick="showSection('certificate')">Certificates</a>

            <div class="profile" onclick="toggleDropdown()">
                <img src="images/profilelogo.png" alt="Profile" class="profile-icon">
                <div class="dropdown-content" id="profileDropdown">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
    <!-- Dashboard Section -->
    <div id="dashboard" class="section fade-in">
        <h2 style="color:white;">Signup Entries</h2>
        <a href="signup_records.php" class="add-btn" onclick="showStudentForm()" style="color:white;">Overview of student movements </a>
    </div>

    <!-- Manage Students Section -->
    <div id="manageStudents" class="section fade-in">
        <h2 style="color:white;">Manage student courses</h2>
        <a href="user_report.php"class="add-btn" onclick="showStudentForm()">Manage student courses</a>
        <div id="studentList">
            <!-- Student records will be displayed here -->
        </div>
    </div>

    <!-- Manage Ads Section -->
    <div id="manageAds" class="section fade-in">
        <h2 style="color:white;">Customize Course</h2>
        <a href="custom_courses_report.php" class="add-btn" onclick="showAdForm()">Customize Course</a>
        <div id="adList">
            <!-- Ad records will be displayed here -->
        </div>
    </div>

    <!-- Manage Blogs Section -->
    <div id="manageCourses" class="section fade-in">
        <h2 style="color:white;">Manage Courses</h2>
        <a href="coursesadmin.php" class="add-btn" onclick="showBlogForm()">Add Course</a>
        <div id="blogList">
            <!-- Blog records will be displayed here -->
        </div>
    </div> 

    <!-- Manage Courses Section -->
    <div id="manageBlogs" class="section fade-in">
        <h2 style="color:white;">Manage Blogs</h2>
        <a href="blogs1.php" class="add-btn">Add Blogs</a>
        <div id="courseList">
            <!-- Course records will be displayed here -->
        </div>
    </div>
    <div id="feedback" class="section fade-in">
        <h2 style="color:white;">User Feedback</h2>
        <a href="user_feedback_report.php" class="add-btn">See Feedback</a>
        <div id="feedbacklist">
            <!-- Course records will be displayed here -->
        </div>
    </div>
    <div id="contactus" class="section fade-in">
        <h2 style="color:white;">Contact_Us</h2>
        <a href="contact_us_report.php" class="add-btn">See Contact_us</a>
        <div id="contactuslist">
            <!-- Course records will be displayed here -->
        </div>
    </div>
    <div id="certificate" class="section fade-in">
        <h2 style="color:white;">Certificates Records</h2>
        <a href="user_certificate_report.php" class="add-btn">See Certificate Records</a>
        <div id="certificateList">
            <!-- Course records will be displayed here -->
        </div>
    </div>
    <div class="feedback-container">
    <?php foreach ($feedbacks as $index => $feedback): ?>
        <div class="feedback-slide <?= $index === 0 ? 'active' : '' ?>">
            <div class="feedback-name"><?= htmlspecialchars($feedback['name']) ?></div>
            <div class="feedback-text"><?= htmlspecialchars($feedback['feedback']) ?></div>
        </div>
    <?php endforeach; ?>
</div>
<div class="container mt-4">
    <div class="row">
        <!-- Signup Records Container -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <target><h4 style="color:white;">Signup Records</h4></target>
                </div>
                <div class="card-body">
                    <?php
                    // Fetch all signup records
                    $signup_query = "SELECT * FROM users";
                    $signup_result = $conn->query($signup_query);

                    // Get total count of signups
                    $count_query = "SELECT COUNT(*) AS total_signups FROM users";
                    $count_result = $conn->query($count_query);
                    $total_signups = $count_result->fetch_assoc()['total_signups'];
                    ?>

                    <?php if ($signup_result->num_rows > 0): ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr style="color:black">
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Birthday</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $signup_result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= $row['username'] ?></td>
                                        <td><?= $row['email'] ?></td>
                                        <td><?= $row['created_at'] ?></td>
                                        <td><?= $row['birthday'] ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <p><strong style="color:#f1f1f1;">Total Signups:</strong> 
    <span style="color: #ffffff; font-size: 2em;"><?= $total_signups ?></span>
</p>
<?php else: ?>
<p>No signup records found.</p>
<?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>


            <!-- Courses Records Container -->
           <!-- Courses Records Container -->
<div class="col-md-6">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h4 style="color:white;">All Courses</h4>
        </div>
        <div class="card-body">
            <?php 
            // Get the count of courses
            $course_count = $courses_result->num_rows;
            ?>
            <p><strong style="color:white;">Total Courses:</strong> 
                <span style="color: white; font-size: 2em;"><?= $course_count ?></span>
            </p>
            <?php if ($course_count > 0): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $courses_result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['title'] ?></td>
                                <td><?= $row['content'] ?></td>
                                <td><?= $row['created_at'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No courses found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    

</div>
    <script>
    // Toggle dropdown visibility
    function toggleDropdown() {
        var dropdown = document.getElementById("profileDropdown");
        dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.profile-icon')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.style.display === 'block') {
                    openDropdown.style.display = 'none';
                }
            }
        }
    }

    // Show a specific section and hide others
    function showSection(sectionId) {
        hideAllSections(); // Hide all sections before showing the active one
        const activeSection = document.getElementById(sectionId);
        activeSection.style.display = "block"; // Show the selected section
    }

    // Hide all sections
    function hideAllSections() {
        var sections = ['dashboard', 'manageStudents', 'manageAds', 'manageBlogs', 'manageServices', 'manageCourses'];
        sections.forEach(function(section) {
            var element = document.getElementById(section);
            if (element) {
                element.style.display = 'none'; // Hide all sections
            }
        });
    }

    // Functions to show different forms
    function showStudentForm() {
        alert("Show student form");
    }

    function showAdForm() {
        alert("Show ad form");
    }

    function showBlogForm() {
        alert("Show courses form");
    }

    function showServiceForm() {
        alert("Show service form");
    }

    function showCourseForm() {
        alert("Show blogs form");
    }
    const slides = document.querySelectorAll('.feedback-slide');
    let currentIndex = 0;

    function showNextSlide() {
        slides[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % slides.length; // Cycle through slides
        slides[currentIndex].classList.add('active');
    }

    // Change slide every 3 seconds
    setInterval(showNextSlide, 3000);
</script>


</body>
</html>
