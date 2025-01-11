<?php
require 'vendor/autoload.php'; // Make sure FPDF is installed with composer require fpdf/fpdf

// Database connection
$conn = new mysqli('localhost', 'root', '', 'user_system', 5306);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch custom courses data
$result = $conn->query("SELECT id, username, email, desired_course, description, created_at FROM custom_courses");

// Create PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// PDF Header
$pdf->Cell(0, 10, 'Custom Course Requests Report', 0, 1, 'C');
$pdf->Ln(10);

// Table header
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 10, 'ID', 1);
$pdf->Cell(40, 10, 'Name', 1);
$pdf->Cell(50, 10, 'Email', 1);
$pdf->Cell(40, 10, 'Course Title', 1);
$pdf->Cell(50, 10, 'Description', 1);
$pdf->Ln();

// Table data
$pdf->SetFont('Arial', '', 10);
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(10, 10, $row['id'], 1);
    $pdf->Cell(40, 10, $row['username'], 1);
    $pdf->Cell(50, 10, $row['email'], 1);
    $pdf->Cell(40, 10, $row['desired_course'], 1);
    $pdf->Cell(50, 10, substr($row['description'], 0, 40) . '...', 1);
    $pdf->Ln();
}

// Close the connection
$conn->close();

// Output the PDF as a download
$pdf->Output('D', 'custom_course_requests.pdf');
?>
