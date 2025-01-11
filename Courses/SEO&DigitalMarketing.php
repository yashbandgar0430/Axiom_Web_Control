<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Marketing & Management Services</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('path/to/your/background-image.jpg'); /* Add your background image path here */
            background-size: cover;
            background-position: center;
            color: #fff;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 40px;
            background: rgba(0, 0, 0, 0.7); /* Semi-transparent background for readability */
            border-radius: 10px;
        }

        h1 {
            font-size: 36px;
            text-align: center;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 28px;
            text-align: center;
            margin-bottom: 15px;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
            text-align: center;
            margin-bottom: 20px;
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
        <h1>Digital Marketing & Management Services</h1>

        <h2>Cultivate Online Success with Axiom's Expert SEO & Digital Marketing Strategies</h2>

        <p>Axiom is a leading provider of SEO and digital marketing services, dedicated to helping businesses grow online. Our mission is to empower businesses to reach their full potential through strategic SEO and digital marketing strategies.</p>
        <a href="../selectcourse.php" class="proceed-btn">Proceed</a>
    </div>
</body>
</html>