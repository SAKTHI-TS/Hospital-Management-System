<?php
session_start();
include('include/config.php');

if (isset($_POST['prescriptionId'])) {
    $prescriptionId = $_POST['prescriptionId'];

    // Fetch prescribed medicines for the given prescription ID
    $query = "SELECT pm.medicine_id, m.medicine_name, pm.quantity_needed, m.price_per_unit 
              FROM prescription_medicines pm
              JOIN medicines m ON pm.medicine_id = m.id
              WHERE pm.prescription_id = $prescriptionId";
    $result = mysqli_query($con, $query);

    $medicines = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $medicines[] = $row;
    }

    echo json_encode($medicines);
}
?>