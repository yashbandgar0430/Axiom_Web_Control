<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'user_system', 5306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch courses from the database
$result = $conn->query("SELECT * FROM courses");
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
            background-image: url('./images/img3.png');
            background-repeat: repeat;
            background-size: auto;
            background-position: top left;
            height: 100vh;
        }
        .back-button {
            display: inline-block;
            padding: 12px 24px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 8px;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }
        .back-button:hover {
            transform: scale(1.1);
            background-color: #0056b3;
        }
        h1.text-center {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: #007bff;
        }
        .course-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }
        .course-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            background-color: pink;
        }
        .course-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .course-card:hover img {
            transform: scale(1.05);
        }
        .course-card .card-body {
            padding: 15px;
            text-align: left;
        }
        .card-title {
            color: #007bff;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            body {
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background: #f0f0f0;
    }
        }
        .custom-button {
      display: inline-block;
      padding: 15px 30px;
      font-size: 18px;
      font-weight: bold;
      color: #fff;
      text-decoration: none;
      text-transform: uppercase;
      background: linear-gradient(90deg, #ff7e5f, #feb47b);
      border-radius: 50px;
      position: relative;
      overflow: hidden;
      transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    .custom-button:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }
    .custom-button::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(255, 255, 255, 0.3);
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.3s ease-in-out;
    }
    .custom-button:hover::before {
      transform: scaleX(1);
    }
    </style>
</head>
<body>
<a href="javascript:history.back()" class="back-button">Back</a>
<div class="container mt-5">
    <h1 class="text-center" style="color:white;">Our Courses</h1>
    <div class="row">
    <?php
while ($row = $result->fetch_assoc()) {
    echo "<div class='col-md-4 mb-4'>
            <div class='course-card'>
                <img src='{$row['image']}' alt='Course Image'>
                <div class='card-body'>
                    <h5 class='card-title'>{$row['title']}</h5>
                    <p class='card-text'>" . substr($row['content'], 0, 50) . "...</p>
                    <a href='buy_course.php?course_id={$row['id']}' class='btn btn-primary btn-sm'>Buy</a>
                    <a href='course_details.php?course_id={$row['id']}' class='btn btn-info btn-sm'>Know More</a>
                </div>
            </div>
        </div>";
}
?>
<a href="Customize_Course.php" class="custom-button">Customize Course</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
