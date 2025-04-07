<?php
session_start();
include('include/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prescriptionId = $_POST['prescriptionId'];
    $grandTotal = $_POST['grandTotal'];

    // Fetch prescribed medicines for the given prescription
    $query = "SELECT medicine_id, quantity_needed FROM prescription_medicines WHERE prescription_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $prescriptionId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Update the available quantity for each medicine
    while ($row = $result->fetch_assoc()) {
        $medicineId = $row['medicine_id'];
        $quantityNeeded = $row['quantity_needed'];

        $updateQuery = "UPDATE medicines SET quantity_available = quantity_available - ? WHERE id = ?";
        $updateStmt = $con->prepare($updateQuery);
        $updateStmt->bind_param("ii", $quantityNeeded, $medicineId);
        $updateStmt->execute();
    }

    // Update the prescription status to "Processed"
    $updatePrescriptionQuery = "UPDATE prescriptions SET status = 'Processed', total_amount = ? WHERE id = ?";
    $updatePrescriptionStmt = $con->prepare($updatePrescriptionQuery);
    $updatePrescriptionStmt->bind_param("di", $grandTotal, $prescriptionId);
    $updatePrescriptionStmt->execute();

    echo json_encode(['success' => true, 'message' => 'Prescription processed successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>