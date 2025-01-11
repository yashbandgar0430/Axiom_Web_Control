<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'user_system', 5306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch courses from the database
$result = $conn->query("SELECT * FROM blogs");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Courses</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
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
        }
        /* Back Button Styling */
.back-button {
    display: inline-block;
    padding: 12px 24px;
    font-size: 16px;
    color: #fff;
    background-color: #007bff;
    text-decoration: none;
    border-radius: 8px;
    transition: transform 0.3s ease, background-color 0.3s ease;
    position: fixed;
    top: 20px;
    left: 20px;
    z-index: 1000; /* Keeps button on top */
}

/* Hover and active effect for the Back Button */
.back-button:hover {
    transform: scale(1.1);
    background-color: #0056b3;
}

.back-button:active {
    transform: scale(0.9);
}

        .animated-image {
            width: 60%;
            height: auto;
            animation: pulse 2s infinite; /* Example animation */
        }

        @keyframes slideIn {
            0% {
                transform: translateX(-100%);
                opacity: 0;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .animated-card {
            animation: slideIn 0.5s ease forwards;
        }

        /* Scale up on hover */
        .card {
            transition: transform 0.3s ease-in-out, background-color 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
            background-color: #f8f9fa; /* Light gray background */
        }

        /* Rotate image on hover */
        .card:hover img {
            transform: rotate(5deg);
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>
<body>
<a href="javascript:history.back()" class="back-button">Back</a>

<div class="container mt-5">
    <h1 class="text-center" style="color:white;">Our opportunities </h1>

    <div class="row">
    <?php
    while ($row = $result->fetch_assoc()) {
        // Display each course in a card with animation
        echo "<div class='col-md-4'>
                <div class='card mb-4 animated-card' style='cursor:pointer;'>
                    <img src='{$row['image']}' class='card-img-top' alt='Service Image' onclick='showCourseDetails(\"{$row['title']}\", \"{$row['content']}\", \"{$row['id']}\")'>
                    <div class='card-body'>
                        <h5 class='card-title'>{$row['title']}</h5>
                        <p class='card-text'>{$row['content']}</p>
                        <a href='profile.php?id={$row['id']}' class='btn btn-primary'>Know More</a> <!-- Know More Button -->
                    </div>
                </div>
              </div>";
    }
    ?>
    </div>
</div>

<!-- Modal for Course Information -->
<div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="courseModalLabel">Course Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="courseDescription">Here, you can provide more details about the course, its objectives, benefits, and any other relevant information.</p>
                <ul>
                    <li>Course Duration: 4 weeks</li>
                    <li>Format: Online</li>
                    <li>Level: Beginner</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a id="courseLink" href="#" class="btn btn-primary">Know More</a>
            </div>
        </div>
    </div>
</div>

<script>
    function showCourseDetails(title, content, id) {
        // Update modal content
        document.getElementById('courseModalLabel').innerText = title;
        document.getElementById('courseDescription').innerText = content;

        // Set the link to redirect to the specific course's profile page
        document.getElementById('courseLink').href = `profile.php?id=${id}`;

        // Show the modal
        var courseModal = new bootstrap.Modal(document.getElementById('courseModal'));
        courseModal.show();
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
