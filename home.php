<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Axiom Web Control</title>
    <link rel="stylesheet" href="style.css">
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

        .videoContainer {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
            width: 80%; /* Adjust width as needed */
            max-width: 600px; /* Set a max width for responsiveness */
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .videoContainer h2 {
            margin: 0;
            margin-bottom: 10px;
            font-size: 1.2em;
            color: #333;
        }

        .videoContainer video {
            width: 40%; /* Make video take full width of container */
            height: auto; /* Maintain aspect ratio */
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <button id="homeButton">Home</button>
    <div id="videoContainer" class="videoContainer" style="display: none;">
        <h2> About Web Development</h2> <!-- Video topic/title here -->
        <video id="introVideo" controls>
            <source src="images/vid.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    <div id="videoContainer" class="videoContainer" style="display: none;">
        <h2> MongoDB</h2> <!-- Video topic/title here -->
        <video id="introVideo" controls>
            <source src="" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <script>
        document.getElementById("homeButton").addEventListener("click", function() {
            const videoContainer = document.getElementById("videoContainer");
            const introVideo = document.getElementById("introVideo");

            // Show the video container and play the video
            videoContainer.style.display = "flex";
            introVideo.play();
        });
    </script>
</body>
</html>
