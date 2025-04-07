<?php
session_start();
include('include/config.php');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['prescriptionId'])) {
    $prescriptionId = filter_input(INPUT_POST, 'prescriptionId', FILTER_VALIDATE_INT);

    if (!$prescriptionId) {
        echo json_encode(['success' => false, 'message' => 'Invalid prescription ID']);
        exit;
    }

    try {
        // Fetch prescription details
        $query = "SELECT p.*, pt.PatientName, d.doctorName 
                  FROM prescriptions p
                  JOIN tblpatient pt ON p.patient_id = pt.ID
                  JOIN doctors d ON p.doctor_id = d.id
                  WHERE p.id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('i', $prescriptionId);
        $stmt->execute();
        $result = $stmt->get_result();
        $prescription = $result->fetch_assoc();

        if (!$prescription) {
            echo json_encode(['success' => false, 'message' => 'Prescription not found']);
            exit;
        }

        // Fetch prescribed medicines
        $medicinesQuery = "SELECT pm.medicine_id, m.medicine_name, pm.quantity_needed, m.price_per_unit 
                           FROM prescription_medicines pm
                           JOIN medicines m ON pm.medicine_id = m.id
                           WHERE pm.prescription_id = ?";
        $medicinesStmt = $con->prepare($medicinesQuery);
        $medicinesStmt->bind_param('i', $prescriptionId);
        $medicinesStmt->execute();
        $medicinesResult = $medicinesStmt->get_result();

        $medicines = [];
        $grandTotal = 0;
        while ($medicine = $medicinesResult->fetch_assoc()) {
            $total = $medicine['price_per_unit'] * $medicine['quantity_needed'];
            $grandTotal += $total;
            $medicines[] = [
                'medicine_name' => $medicine['medicine_name'],
                'quantity_needed' => $medicine['quantity_needed'],
                'price_per_unit' => $medicine['price_per_unit'],
                'total' => $total
            ];
        }

        // Return JSON response
        echo json_encode([
            'success' => true,
            'id' => $prescriptionId,
            'PatientName' => $prescription['PatientName'],
            'doctorName' => $prescription['doctorName'],
            'prescription_date' => $prescription['prescription_date'],
            'status' => $prescription['status'],
            'medicines' => $medicines,
            'grandTotal' => $grandTotal
        ]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method or missing prescription ID']);
}
?>