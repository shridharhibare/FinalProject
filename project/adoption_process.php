<?php
require 'config.php'; // Include database connection
require('fpdf.php'); // Include FPDF library

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $petName = $_POST['petName'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Validate inputs
    if (empty($fullName) || empty($email) || empty($phone) || empty($address)) {
        echo "All fields are required!";
        exit;
    }

    // Insert data into the database
    $sql = "INSERT INTO adoption_requests (petName, fullName, email, phone, address) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die("SQL Error: " . $conn->error);
    }

    $stmt->bind_param("sssss", $petName, $fullName, $email, $phone, $address);

    if ($stmt->execute()) {
        // Generate the certificate
        generateCertificate($fullName, $petName);
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

// Function to generate the certificate PDF
function generateCertificate($fullName, $petName) {
    $pdf = new FPDF();
    $pdf->AddPage();
    
    // Add a decorative border
    $pdf->SetLineWidth(2);
    $pdf->Rect(5, 5, 200, 287, 'D'); // Border around the certificate

    // Set Font for Title
    $pdf->SetFont('Courier', 'I', 28);
    $pdf->SetTextColor(0, 102, 204); // Blue color
    $pdf->Cell(0, 30, 'Certificate of Adoption', 0, 1, 'C');
    $pdf->Ln(10);

    // Subtitle
    $pdf->SetFont('Arial', 'I', 18);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(0, 10, 'This certificate proudly recognizes', 0, 1, 'C');
    $pdf->Ln(5);

    // Adopter Name
    $pdf->SetFont('Arial', 'B', 22);
    $pdf->SetTextColor(165, 42, 42); // Brown color
    $pdf->Cell(0, 10, strtoupper($fullName), 0, 1, 'C');
    $pdf->Ln(5);

    // Text
    $pdf->SetFont('Arial', 'I', 16);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(0, 10, 'for adopting and giving a loving home to', 0, 1, 'C');
    $pdf->Ln(5);

    // Pet Name
    $pdf->SetFont('Arial', 'I', 20);
    $pdf->SetTextColor(0, 153, 51); // Green color
    $pdf->Cell(0, 10, strtoupper($petName), 0, 1, 'C');
    $pdf->Ln(20);

    // Thank You Message
    $pdf->SetFont('Arial', '', 14);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(0, 10, 'Thank you for making the world a better place!', 0, 1, 'C');
    $pdf->Ln(10);

    // Date
    $pdf->SetFont('Arial', 'I', 12);
    $pdf->Cell(0, 10, 'Date of Adoption: ' . date("d M Y"), 0, 1, 'C');

    // Output the PDF
    $pdf->Output('D', 'Adoption_Certificate.pdf'); // 'D' forces download
}
?>
