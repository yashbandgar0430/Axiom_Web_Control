
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Generator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .form-container {
            max-width: 400px;
            margin: 0 auto 20px;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background: #4A90E2;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .form-container button:hover {
            background: #357ABD;
        }

        .certificate-container {
            display: none;
            width: 800px;
            height: 600px;
            margin: 20px auto;
            padding: 40px;
            text-align: center;
            position: relative;
            background-image: url('./images/certificateborder3.png'); /* Add your background image here */
            background-size: cover;
            background-position: center;
        }

        .certificate-header {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .certificate-subheader {
            font-size: 20px;
            margin-bottom: 30px;
            color: #555;
        }

        .company-logo {
            width: 250px;
            margin: 20px auto;
        }

        .student-name {
            font-size: 30px;
            font-weight: bold;
            margin: 20px 0;
            color: #000;
        }

        .course-name {
            font-size: 22px;
            margin: 10px 0;
            color: #444;
        }

        .signatures {
    display: flex;
    justify-content: space-evenly; /* Ensures even spacing but less than space-between */
    margin-top: 50px;
    padding: 0 20px; /* Reduce padding for less horizontal spacing */
}

.signature {
    text-align: center;
}

.signature img {
    width: 100px;
    height: auto;
}

.signature p {
    margin: 5px 0 0;
    font-size: 14px;
    color: #333;
}
    </style>
</head>
<body>

<div class="form-container">
    <h2>Generate Your Certificate</h2>
    <form id="certificateForm">
        <input type="text" id="fullName" placeholder="Enter your full name" required>
        <input type="text" id="courseName" placeholder="Enter the course name" required>
        <button type="submit">Generate Certificate</button>
    </form>
</div>

<div class="certificate-container" id="certificate" style="display: none;">
    <div class="certificate-header">CERTIFICATE OF COMPLETION</div>
    <div class="certificate-subheader">This is to certify that</div>
    <img class="company-logo" src="./images/navname1.png" alt="Company Logo">
    <i><div class="student-name" id="studentName"></div></i>
    <div class="course-name">has successfully completed the course:</div>
    <b><div class="course-name" id="courseNameDisplay"></div></b>
    <div class="signatures">
        <div class="signature">
            <img src="./images/SrushtiSign.png" alt="Signature 1">
            <b><p>Srusht Awati</p></b>
            <b><p>Co-Founder</p></b>
        </div>
        <div class="signature">
            <img src="./images/YashSign.png" alt="Signature 2">
            <b><p>Yash Bandgar</p></b>
            <b><p>Founder</p></b>
        </div>
    </div>
</div>

<!-- Include jsPDF library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

<script>
 document.getElementById('certificateForm').addEventListener('submit', function (e) {
    e.preventDefault();

    // Get the entered values
    const fullName = document.getElementById('fullName').value;
    const courseName = document.getElementById('courseName').value;

    // Set the values in the certificate preview
    document.getElementById('studentName').textContent = fullName;
    document.getElementById('courseNameDisplay').textContent = courseName;

    // Show the certificate preview
    const certificate = document.getElementById('certificate');
    certificate.style.display = 'block';

    // Generate PDF using jsPDF
    const { jsPDF } = window.jspdf;
    const pdf = new jsPDF({
        orientation: 'landscape',
        unit: 'px',
        format: [800, 600], // Adjust according to your certificate size
    });

    // Add background image for the certificate
    pdf.addImage('./images/certificateborder3.png', 'PNG', 0, 0, 800, 600); // Certificate border

    // Add company logo
    pdf.addImage('./images/navname1.png', 'PNG', 275, 80, 250, 100);

    // Add certificate text
    pdf.setFontSize(28);
    pdf.text('CERTIFICATE OF COMPLETION', 300, 150);

    pdf.setFontSize(20);
    pdf.text('This is to certify that', 300, 190);

    pdf.setFontSize(30);
    pdf.text(fullName, 300, 230);

    pdf.setFontSize(22);
    pdf.text('has successfully completed the course:', 300, 270);

    pdf.setFontSize(22);
    pdf.text(courseName, 300, 310);

    // Add signatures
    pdf.addImage('./images/SrushtiSign.png', 'PNG', 100, 450, 100, 50); // Signature 1
    pdf.text('Srusht Awati', 100, 510);
    pdf.text('Co-Founder', 100, 530);

    pdf.addImage('./images/YashSign.png', 'PNG', 500, 450, 100, 50); // Signature 2
    pdf.text('Yash Bandgar', 500, 510);
    pdf.text('Founder', 500, 530);

    // Save the PDF
    pdf.save(`${fullName}_Certificate.pdf`);

    // Send data to the backend to save in the database
    fetch('save_certificate.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ fullName, courseName })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Certificate data saved successfully.');
        } else {
            console.error('Error saving certificate data:', data.error);
        }
    })
    .catch(error => {
        console.error('Request failed:', error);
    });
});
</script>

</body>
</html>
