<?php
session_start();
include('include/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prescriptionId = $_POST['prescriptionId'];

    // Directly fetch the total amount without additional checks
    $query = "SELECT total_amount FROM prescriptions WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $prescriptionId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode([
            'success' => true,
            'total_amount' => $row['total_amount']
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Prescription not found.'
        ]);
    }

    mysqli_stmt_close($stmt);
}
?>