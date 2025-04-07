<?php
require('fpdf/fpdf.php');
include('include/config.php');

if (isset($_GET['prescriptionId'])) {
    $prescriptionId = $_GET['prescriptionId'];

    // Fetch prescription details
    $query = "SELECT p.*, pt.PatientName, d.doctorName 
              FROM prescriptions p
              JOIN tblpatient pt ON p.patient_id = pt.ID
              JOIN doctors d ON p.doctor_id = d.id
              WHERE p.id = $prescriptionId";
    $result = mysqli_query($con, $query);
    $prescription = mysqli_fetch_assoc($result);

    // Fetch prescribed medicines
    $medicinesQuery = "SELECT pm.medicine_id, m.medicine_name, pm.quantity_needed, m.price_per_unit 
                       FROM prescription_medicines pm
                       JOIN medicines m ON pm.medicine_id = m.id
                       WHERE pm.prescription_id = $prescriptionId";
    $medicinesResult = mysqli_query($con, $medicinesQuery);

    // Create PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    
    // Header with background color
    $pdf->SetFillColor(51, 153, 255);
    $pdf->Rect(0, 0, 210, 40, 'F');
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('Arial', 'B', 24);
    $pdf->Cell(0, 20, 'City Pharmacy', 0, 1, 'C');
    
    // Pharmacy details with styling
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 5, '123 Main St, Cityville', 0, 1, 'C');
    $pdf->Cell(0, 5, 'Phone: 123-456-7890 | Email: citypharmacy@example.com', 0, 1, 'C');
    $pdf->Ln(15);

    // Bill title with color
    $pdf->SetTextColor(51, 153, 255);
    $pdf->SetFont('Arial', 'B', 20);
    $pdf->Cell(0, 15, 'Prescription Bill', 0, 1, 'C');
    $pdf->Ln(5);

    // Prescription details in a box
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(240, 240, 240);
    $pdf->Cell(0, 10, 'Prescription Details', 1, 1, 'C', true);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 8, 'Prescription ID: ' . $prescriptionId, 'LR', 1);
    $pdf->Cell(0, 8, 'Patient Name: ' . $prescription['PatientName'], 'LR', 1);
    $pdf->Cell(0, 8, 'Doctor Name: ' . $prescription['doctorName'], 'LR', 1);
    $pdf->Cell(0, 8, 'Prescription Date: ' . $prescription['prescription_date'], 'LRB', 1);
    $pdf->Ln(10);

    // Medicines table with colors
    $pdf->SetFillColor(51, 153, 255);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(60, 10, 'Medicine', 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Quantity', 1, 0, 'C', true);
    $pdf->Cell(50, 10, 'Price per Unit', 1, 0, 'C', true);
    $pdf->Cell(50, 10, 'Total', 1, 1, 'C', true);

    $pdf->SetTextColor(0, 0, 0);
    $grandTotal = 0;
    $rowCount = 0;
    while ($medicine = mysqli_fetch_assoc($medicinesResult)) {
        $total = $medicine['price_per_unit'] * $medicine['quantity_needed'];
        $grandTotal += $total;

        // Alternating row colors
        $pdf->SetFillColor($rowCount % 2 == 0 ? 245 : 255, 245, 245);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(60, 10, $medicine['medicine_name'], 1, 0, 'L', true);
        $pdf->Cell(30, 10, $medicine['quantity_needed'], 1, 0, 'C', true);
        $pdf->Cell(50, 10, 'Rs. ' . number_format($medicine['price_per_unit'], 2), 1, 0, 'R', true);
        $pdf->Cell(50, 10, 'Rs. ' . number_format($total, 2), 1, 1, 'R', true);
        $rowCount++;
    }

    // Grand total with highlight
    $pdf->SetFillColor(51, 153, 255);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(140, 10, 'Grand Total', 1, 0, 'R', true);
    $pdf->Cell(50, 10, 'Rs. ' . number_format($grandTotal, 2), 1, 1, 'R', true);

    // Add footer
    $pdf->Ln(10);
    $pdf->SetTextColor(128, 128, 128);
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(0, 10, 'Thank you for your business!', 0, 1, 'C');

    // Output PDF
    $pdf->Output('D', 'bill_' . $prescriptionId . '.pdf');
    exit;
}
?>