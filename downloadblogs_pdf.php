<?php
require 'vendor/autoload.php'; // Load FPDF through Composer

// Database connection
$conn = new mysqli('localhost', 'root', '', 'user_system', 5306);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query the blogs table
$result = $conn->query("SELECT id, title, content, image FROM blogs");

// Initialize FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Header for PDF
$pdf->Cell(0, 10, 'Blogs Report', 0, 1, 'C');
$pdf->Ln(5);

// Table headers
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 10, 'ID', 1);
$pdf->Cell(60, 10, 'Title', 1);
$pdf->Cell(100, 10, 'Content', 1);
$pdf->Ln();

// Table data rows
$pdf->SetFont('Arial', '', 10);
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(20, 10, $row['id'], 1);
    $pdf->Cell(60, 10, substr($row['title'], 0, 25), 1);
    $pdf->Cell(100, 10, substr($row['content'], 0, 50) . '...', 1);
    $pdf->Ln();
}

// Close the connection
$conn->close();

// Output the PDF
$pdf->Output('D', 'blogs_report.pdf'); // 'D' prompts the file download
?>
