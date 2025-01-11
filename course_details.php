<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('./images/img3.png');
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
   
        .course-container {
            width: 80%;
            max-width: 800px;
            text-align: center;
        }
        .course-title {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }
        .course-list {
            list-style-type: none;
            padding: 0;
        }
        .course-item {
            margin: 15px 0;
            padding: 15px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, background-color 0.3s;
            cursor: pointer;
            overflow: hidden;
            position: relative;
        }
        .course-item:hover {
            transform: scale(1.05);
            background-color: #FF12FA;
        }
        .course-item span {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="course-container">
        <target><div class="course-title" style="color:white;">Available Courses</div></target>
        <ul class="course-list">
            <!-- Static Course List with Specific Destinations -->
            <li class="course-item" onclick="window.location.href='./Courses/UXandUI.php'">
                <span>UI & UX Course</span>
            </li>
            <li class="course-item" onclick="window.location.href='./Courses/Graphicdesign.php'">
                <span>Graphic Design Course</span>
            </li>
            <li class="course-item" onclick="window.location.href='./Courses/3DDesign.php'">
                <span>3D Designing Course</span>
            </li>
            <li class="course-item" onclick="window.location.href='./Courses/BrandEvolution.php'">
                <span>Brand Evolution Course</span>
            </li>
            <li class="course-item" onclick="window.location.href='./Courses/ContentMarketing.php'">
                <span>Content Marketing</span>
            </li>
            <li class="course-item" onclick="window.location.href='./Courses/DedicatedServerHosting.php'">
                <span>Dedicated Server Hosting Course</span>
            </li>
            <li class="course-item" onclick="window.location.href='./Courses/DomainRegistration&Management.php'">
                <span>Domain Registration & Management Course</span>
            </li>
            <li class="course-item" onclick="window.location.href='./Courses/ERP&CRM Development.php'">
                <span>ERP & CRM Development Course</span>
            </li>
            <li class="course-item" onclick="window.location.href='./Courses/GameDesign.php'">
                <span>Game Design Course</span>
            </li>
            <li class="course-item" onclick="window.location.href='./Courses/GraphicDesign.php'">
                <span>Graphic Design Course</span>
            </li>
            <li class="course-item" onclick="window.location.href='./Courses/MobileApplication.php'">
                <span>Mobile Application Course</span>
            </li>
            <li class="course-item" onclick="window.location.href='./Courses/SEO&DigitalMarketing.php'">
                <span>SEO & Digital Marketing Course</span>
            </li>
            <li class="course-item" onclick="window.location.href='./Courses/SocialMediaManagement.php'">
                <span>Social Media Management Course</span>
            </li>
            <li class="course-item" onclick="window.location.href='./Courses/Static&DynamicWebsite.php'">
                <span>Static & Dynamic Website Course</span>
            </li>
            <li class="course-item" onclick="window.location.href='./Courses/Website Hosting.php'">
                <span>Website Hosting Course</span>
            </li>
            <li class="course-item" onclick="window.location.href='./Courses/Website Maintenance & Support.php'">
                <span>Website Maintenance & Support Course</span>
            </li>
        </ul>
    </div>
</body>
</html>
