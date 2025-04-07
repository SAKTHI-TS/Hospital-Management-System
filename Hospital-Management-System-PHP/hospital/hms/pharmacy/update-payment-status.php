<?php
session_start();
include('include/config.php');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prescriptionId = filter_input(INPUT_POST, 'prescriptionId', FILTER_VALIDATE_INT);

    if (!$prescriptionId) {
        echo json_encode(['success' => false, 'message' => 'Invalid prescription ID']);
        exit;
    }

    try {
        $updateStmt = $con->prepare("UPDATE prescriptions 
                                   SET status = 'Delivered', 
                                       payment_status = 'Paid',
                                       payment_date = NOW() 
                                   WHERE id = ?");
        $updateStmt->bind_param('i', $prescriptionId);

        if ($updateStmt->execute()) {
            echo json_encode([
                'success' => true, 
                'message' => 'Payment confirmed and prescription marked as delivered'
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update payment status']);
        }

        $updateStmt->close();
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
    } finally {
        $con->close();
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>