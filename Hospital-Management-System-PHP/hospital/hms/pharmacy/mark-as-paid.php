<?php
session_start();
include('include/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prescriptionId = $_POST['prescriptionId'];

    // Directly update the status to Delivered and payment_status to Paid
    $query = "UPDATE prescriptions SET status = 'Delivered', payment_status = 'Paid', payment_date = NOW() WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $prescriptionId);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode([
            'success' => true,
            'message' => 'Status updated to Delivered and payment marked as Paid.'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to update status.'
        ]);
    }

    mysqli_stmt_close($stmt);
}
?>