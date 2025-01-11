<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UI & UX Design</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            font-size: 36px;
            color: #3498db;
            text-align: center;
            margin-top: 20px;
        }

        p {
            font-size: 18px;
            margin-bottom: 20px;
            text-align: justify;
        }

        .subheading {
            font-size: 24px;
            color: #2980b9;
            margin-bottom: 15px;
        }

        .highlight {
            background-color: #eaf7ff;
            padding: 10px;
            border-left: 5px solid #3498db;
            margin-bottom: 20px;
        }

        .image-container {
            text-align: center;
            margin: 30px 0;
        }

        .image-container img {
            max-width: 20%;
            height: auto;
            border-radius: 8px;
        }

        ul {
            margin: 20px 0;
            padding: 0;
            list-style-type: none;
        }

        ul li {
            background: #3498db;
            color: #fff;
            margin: 5px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .proceed-btn {
            display: inline-block;
            padding: 15px 30px;
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            border-radius: 50px;
            position: relative;
            transition: all 0.4s ease;
            overflow: hidden;
            z-index: 1;
        }

        .proceed-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: 300%;
            background-color: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%) scale(0);
            transition: transform 0.5s ease;
            border-radius: 50%;
            z-index: -1;
        }

        .proceed-btn:hover::before {
            transform: translate(-50%, -50%) scale(1);
        }

        .proceed-btn:hover {
            background-color: #218838;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            transform: scale(1.05);
        }

        .proceed-btn:active {
            background-color: #1e7e34;
            transform: scale(0.95);
        }
    </style>
</head>
<body>

<div class="container">
    <h1>UI & UX Design</h1>

    <p>
        UI (User Interface) and UX (User Experience) Design are crucial aspects of modern web and app development. They focus on creating intuitive, engaging, and efficient interactions between users and digital products. UI Design deals with the layout, visual design, and aesthetics of a digital interface, while UX Design focuses on the overall experience, ensuring that the product meets the needs of the user efficiently and effectively.
    </p>

    <div class="image-container">
        <img src="../images/UIUX.png" alt="UI & UX Design">
    </div>

    <div class="highlight">
            UI Design is about crafting the look and feel of a product’s interface. UX Design is all about creating a seamless and effective user journey.
        </p>
    </div>

    <h2 class="subheading">Key Aspects of UI & UX Design</h2>
    
    <ul>
        <li><strong>Wireframing and Prototyping</strong> - Creating blueprints for the design before development.</li>
        <li><strong>Information Architecture</strong> - Structuring content and features in an intuitive way.</li>
        <li><strong>Visual Design</strong> - Crafting beautiful and responsive interfaces.</li>
        <li><strong>User Research</strong> - Understanding user needs, goals, and behaviors.</li>
        <li><strong>Interaction Design</strong> - Ensuring that users can efficiently interact with the interface.</li>
        <li><strong>Usability Testing</strong> - Testing the product with users to identify pain points.</li>
    </ul>

    <p>
        UI & UX Designers work together to create products that are not only visually appealing but also functional and easy to use. The ultimate goal is to ensure a product offers a seamless, enjoyable, and effective user experience from start to finish.
    </p>

    <h2 class="subheading">Why UI & UX Design is Important?</h2>

    <p>
        Good UI & UX design improves customer satisfaction, increases user retention, and enhances the overall usability of the product. Investing in UI & UX design leads to higher conversion rates and ensures that users will have a positive experience, which encourages them to return and recommend the product to others.
    </p>

    <a href="Certificate.php" class="proceed-btn">Take Certificate</a>
</div>
</body>
</html>