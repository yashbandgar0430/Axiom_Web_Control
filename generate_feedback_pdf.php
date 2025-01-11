<?php
require 'vendor/autoload.php'; // Include FPDF library

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_system";
$port = 5306;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch feedback data
$sql = "SELECT id, name, contact, email, feedback, created_at FROM feedback ORDER BY created_at DESC";
$result = $conn->query($sql);

// PDF configuration and generation
class PDF extends FPDF {
    // Page header
    function Header() {
        $this->SetFont('Arial', 'B', 16);
        $this->SetFillColor(106, 17, 203); // Dark purple header background
        $this->SetTextColor(255, 255, 255); // White header text
        $this->Cell(0, 10, 'User Feedback Report', 0, 1, 'C', true);
        $this->Ln(10);
    }

    // Page footer
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Initialize PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Table header
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 10, 'ID', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Name', 1, 0, 'C', true);
$pdf->Cell(25, 10, 'Contact', 1, 0, 'C', true);
$pdf->Cell(45, 10, 'Email', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'Feedback', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Date/Time', 1, 1, 'C', true); // Adjusted width for Date

// Table content
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(0);
$pdf->SetFillColor(245, 245, 245); // Light gray fill for table rows

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(10, 12, $row['id'], 1, 0, 'C', true); // Increased cell height
        $pdf->Cell(30, 12, $row['name'], 1, 0, 'C', true);
        $pdf->Cell(25, 12, $row['contact'], 1, 0, 'C', true);
        $pdf->Cell(45, 12, $row['email'], 1, 0, 'C', true);

        // Use MultiCell for Feedback to wrap text within cell
        $pdf->SetX(120); // Position for Feedback cell to align it correctly
        $pdf->MultiCell(60, 6, $row['feedback'], 1, 'L', true);

        // Position Date cell after Feedback, ensuring alignment
        $pdf->SetXY(180, $pdf->GetY() - 12); // Adjust Y position for Date
        $pdf->Cell(30, 12, $row['created_at'], 1, 1, 'C', true);
    }
} else {
    $pdf->Cell(0, 10, 'No feedback available.', 1, 1, 'C');
}

// Close the connection
$conn->close();

// Output PDF
$pdf->Output('D', 'User_Feedback_Report.pdf'); // 'D' forces download
?>
