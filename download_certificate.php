<?php
require('vendor/autoload.php'); // Include Composer's autoloader for jsPDF (if using Composer)

// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "user_system"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname,port:5306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the certificate ID from the URL
$certificateId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch certificate details from the database
$sql = "SELECT * FROM certificates WHERE id = $certificateId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fullName = $row["name"];
    $courseName = $row["course_name"];

    // Create PDF
    $pdf = new \FPDF('L', 'mm', 'A4');
    $pdf->AddPage();

    // Add certificate details
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(200, 10, "CERTIFICATE OF COMPLETION", 0, 1, 'C');
    $pdf->Ln(20);
    $pdf->SetFont('Arial', '', 14);
    $pdf->Cell(200, 10, "This is to certify that", 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'I', 20);
    $pdf->Cell(200, 10, $fullName, 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 14);
    $pdf->Cell(200, 10, "has successfully completed the course:", 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(200, 10, $courseName, 0, 1, 'C');
    $pdf->Ln(20);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(200, 10, "Date of Issue: " . $row["created_at"], 0, 1, 'C');

    // Output PDF (download)
    $pdf->Output('D', "$fullName-Certificate.pdf");

} else {
    echo "Certificate not found.";
}

// Close connection
$conn->close();
?>
