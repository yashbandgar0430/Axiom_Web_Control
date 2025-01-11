<?php
require 'vendor/autoload.php'; // Load FPDF through Composer

// Database connection
$conn = new mysqli('localhost', 'root', '', 'user_system', 5306);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT id, username, email FROM users");

$pdf = new FPDF(); // Instantiate FPDF without any namespace
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Table header
$pdf->Cell(40, 10, 'ID', 1);
$pdf->Cell(60, 10, 'Username', 1);
$pdf->Cell(60, 10, 'Email', 1);
$pdf->Ln();

while ($row = $result->fetch_assoc()) {
    $pdf->Cell(40, 10, $row['id'], 1);
    $pdf->Cell(60, 10, $row['username'], 1);
    $pdf->Cell(60, 10, $row['email'], 1);
    $pdf->Ln();
}

$conn->close();

// Output the PDF for download
$pdf->Output('D', 'signup_records.pdf'); // 'D' prompts the file download
?>
