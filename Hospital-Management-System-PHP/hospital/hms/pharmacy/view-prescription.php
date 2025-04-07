<?php
session_start();
include('include/config.php');

// Fetch all prescriptions
$query = "SELECT p.*, pt.PatientName, d.doctorName 
          FROM prescriptions p
          JOIN tblpatient pt ON p.patient_id = pt.ID
          JOIN doctors d ON p.doctor_id = d.id
          WHERE p.pharmacy_id IS NULL OR p.pharmacy_id = 1"; // Assuming pharmacy ID is 1
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Prescriptions</title>
    <link
        href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic"
        rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
    <link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #74ebd5, #acb6e5);
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 50px;
            animation: fadeIn 1s ease-in-out;
        }

        h1 {
            font-weight: 600;
            color: #444;
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            background: #f8f9fa;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        th {
            background:rgb(106, 164, 214);
            color: #fff;
            text-align: center;
            padding: 15px;
        }

        td {
            text-align: center;
            padding: 10px;
            color: #333;
        }

        .btn {
            border-radius: 20px;
            transition: transform 0.3s ease, background-color 0.3s ease;
            margin: 2px;
        }

        .btn:hover {
            transform: scale(1.1);
        }

        .btn-success {
            background: #28a745;
            border: none;
            color: #fff;
        }

        .btn-info {
            background: #17a2b8;
            border: none;
            color: #fff;
        }

        .btn-warning {
            background: #ffc107;
            border: none;
            color: #333;
        }

        .btn-secondary {
            background: #6c757d;
            border: none;
            color: #fff;
        }

        .btn-primary {
            background: #007bff;
            border: none;
            color: #fff;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Payment Modal Styles */
        #paymentModal .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        #paymentModal .modal-header {
            background: rgb(106, 164, 214);
            color: white;
            border-radius: 15px 15px 0 0;
        }

        #paymentModal .modal-body {
            padding: 30px;
            text-align: center;
        }

        #paymentModal h4 {
            color: #333;
            margin-bottom: 20px;
        }

        #paymentModal p {
            color: #666;
            margin-bottom: 20px;
        }

        #paymentModal .payment-options {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        #paymentModal .btn {
            min-width: 120px;
            padding: 10px 20px;
            font-weight: 500;
        }

        #paymentModal .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        #paymentAmount {
            color: #28a745;
            font-weight: bold;
        }

        .qr-code {
            max-width: 250px;
            margin: 20px auto;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div id="app">
        <?php include('include/header.php');?>
        <?php include('include/sidebar.php');?>
        <div class="app-content">
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <h1 class="text-center">View Prescriptions</h1>
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th>Prescription ID</th>
                                <th>Patient Name</th>
                                <th>Doctor Name</th>
                                <th>Prescription Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['PatientName']; ?></td>
                                <td><?php echo $row['doctorName']; ?></td>
                                <td><?php echo $row['prescription_date']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                                <td>
                                    <?php if ($row['status'] === 'Pending'): ?>
                                        <button class="btn btn-success process-btn" data-id="<?php echo $row['id']; ?>">Process</button>
                                        <a href="generate-pdf.php?prescriptionId=<?php echo $row['id']; ?> " style="display: none; "class="btn btn-info">Print Bill</a>
                                        <button class="btn btn-primary pay-btn" data-id="<?php echo $row['id']; ?>" data-amount="" style="display: none;">Pay</button>
                                        <button class="btn btn-warning paid-btn" data-id="<?php echo $row['id']; ?>" style="display: none;">Paid</button>
                                    <?php elseif ($row['status'] === 'Processed'): ?>
                                        <a href="generate-pdf.php?prescriptionId=<?php echo $row['id']; ?>" class="btn btn-info">Print Bill</a>
                                        <button class="btn btn-primary pay-btn" data-id="<?php echo $row['id']; ?>" data-amount="">Pay</button>
                                        <button class="btn btn-warning paid-btn" data-id="<?php echo $row['id']; ?>" style="display: none;">Paid</button>
                                    <?php else: ?>
                                        <a href="generate-pdf.php?prescriptionId=<?php echo $row['id']; ?>" class="btn btn-info">Print Bill</a>
                                        <button class="btn btn-secondary" disabled>Delivered</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Process Prescription Modal -->
        <div class="modal fade" id="processModal" tabindex="-1" role="dialog" aria-labelledby="processModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="processModalLabel">Process Prescription</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="processForm">
                            <input type="hidden" id="prescriptionId" name="prescriptionId">
                            <div class="form-group">
                                <label>Medicines and Quantities</label>
                                <table class="table table-bordered" id="medicineTable">
                                    <thead>
                                        <tr>
                                            <th>Medicine</th>
                                            <th>Quantity</th>
                                            <th>Price per Unit</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Rows will be dynamically added here -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <label for="grandTotal">Grand Total</label>
                                <input type="text" class="form-control" id="grandTotal" name="grandTotal" readonly>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="submitBill">Submit Bill</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Modal -->
        <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paymentModalLabel">Complete Payment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4>Total Amount: <span id="paymentAmount"></span></h4>
                        <p>Scan the QR code below to make payment</p>
                        <img src="assets/images/qr_code.png" alt="Payment QR Code" 
     style="width: 300px; height: 350px;" class="img-fluid mx-auto d-block">
                        <div class="payment-options mt-4">
                            <button class="btn btn-success" id="confirmPayment">I've Paid</button>
                            <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- start: FOOTER -->
        <?php include('include/footer.php');?>
        <!-- end: FOOTER -->

        <!-- start: SETTINGS -->
        <?php include('include/setting.php');?>
        <!-- end: SETTINGS -->
    </div>
    <!-- start: MAIN JAVASCRIPTS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/modernizr/modernizr.js"></script>
    <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="vendor/switchery/switchery.min.js"></script>
    <!-- end: MAIN JAVASCRIPTS -->
    <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
    <script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="vendor/autosize/autosize.min.js"></script>
    <script src="vendor/selectFx/classie.js"></script>
    <script src="vendor/selectFx/selectFx.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <!-- start: CLIP-TWO JAVASCRIPTS -->
    <script src="assets/js/main.js"></script>
    <!-- Include jsPDF library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <!-- start: JavaScript Event Handlers for this page -->
    <script src="assets/js/form-elements.js"></script>
    <script>
        jQuery(document).ready(function () {
            Main.init();
            FormElements.init();

            // Handle Process Button Click
            $('.process-btn').click(function () {
                var prescriptionId = $(this).data('id');
                $('#prescriptionId').val(prescriptionId);

                // Fetch prescribed medicines for this prescription
                $.ajax({
                    url: 'fetch-prescribed-medicines.php',
                    type: 'POST',
                    data: { prescriptionId: prescriptionId },
                    success: function (response) {
                        var medicines = JSON.parse(response);
                        var tableBody = $('#medicineTable tbody');
                        tableBody.empty(); // Clear existing rows

                        var grandTotal = 0;
                        medicines.forEach(function (medicine) {
                            var total = medicine.price_per_unit * medicine.quantity_needed;
                            grandTotal += total;

                            var row = `<tr>
                                <td>${medicine.medicine_name}</td>
                                <td>${medicine.quantity_needed}</td>
                                <td>Rs. ${medicine.price_per_unit}</td>
                                <td class="total">Rs. ${total.toFixed(2)}</td>
                            </tr>`;
                            tableBody.append(row);
                        });

                        $('#grandTotal').val('Rs. ' + grandTotal.toFixed(2));
                        $('#processModal').modal('show');
                    },
                    error: function () {
                        alert('Error fetching prescribed medicines.');
                    }
                });
            });

            // Submit Bill
            $('#submitBill').click(function () {
                var prescriptionId = $('#prescriptionId').val();
                var grandTotal = $('#grandTotal').val().replace('₹', '');

                $.ajax({
                    url: 'process-prescription.php',
                    type: 'POST',
                    data: {
                        prescriptionId: prescriptionId,
                        grandTotal: grandTotal
                    },
                    success: function (response) {
                        var result = JSON.parse(response);
                        if (result.success) {
                            alert(result.message);
                            $('#processModal').modal('hide');
                            // Set amount on pay button
                            $('.pay-btn[data-id="' + prescriptionId + '"]').data('amount', 'Rs. ' + result.grandTotal);
                            // Refresh the page to reflect the updated status
                            location.reload();
                        } else {
                            alert('Error: ' + result.message);
                        }
                    },
                    error: function () {
                        alert('Error submitting bill.');
                    }
                });
            });

            // Print Bill using jsPDF with built-in font
            $('.print-btn').click(function () {
                var prescriptionId = $(this).data('id');

                // Fetch prescription details
                $.ajax({
                    url: 'fetch-prescription-details.php',
                    type: 'POST',
                    data: { prescriptionId: prescriptionId },
                    success: function (response) {
                        var prescription = JSON.parse(response);

                        // Create a PDF using jsPDF
                        const { jsPDF } = window.jspdf;
                        const doc = new jsPDF();

                        // Set font and size for the header
                        doc.setFontSize(18);
                        doc.setFont('helvetica', 'bold');
                        doc.text('City Pharmacy', 105, 15, { align: 'center' });
                        doc.setFontSize(12);
                        doc.setFont('helvetica', 'normal');
                        doc.text('123 Main St, Cityville', 105, 22, { align: 'center' });
                        doc.text('Phone: 123-456-7890 | Email: citypharmacy@example.com', 105, 28, { align: 'center' });

                        // Add a horizontal line
                        doc.setLineWidth(0.5);
                        doc.line(10, 32, 200, 32);

                        // Prescription Details
                        doc.setFontSize(14);
                        doc.setFont('helvetica', 'bold');
                        doc.text('Prescription Bill', 105, 40, { align: 'center' });

                        doc.setFontSize(12);
                        doc.setFont('helvetica', 'normal');
                        doc.text(`Prescription ID: ${prescription.id}`, 20, 50);
                        doc.text(`Patient Name: ${prescription.PatientName}`, 20, 60);
                        doc.text(`Doctor Name: ${prescription.doctorName}`, 20, 70);
                        doc.text(`Prescription Date: ${prescription.prescription_date}`, 20, 80);

                        // Add a horizontal line
                        doc.line(10, 85, 200, 85);

                        // Medicines Table
                        doc.setFontSize(12);
                        doc.setFont('helvetica', 'bold');
                        doc.text('Medicines', 20, 95);

                        // Table Headers
                        doc.setFontSize(10);
                        doc.text('Medicine Name', 20, 105);
                        doc.text('Quantity', 80, 105);
                        doc.text('Price per Unit', 120, 105);
                        doc.text('Total', 160, 105);

                        // Table Rows
                        let y = 115;
                        prescription.medicines.forEach((medicine) => {
                            doc.setFont('helvetica', 'normal');
                            doc.text(medicine.medicine_name, 20, y);
                            doc.text(medicine.quantity_needed, 80, y);
                            doc.text(`Rs. ${medicine.price_per_unit}`, 120, y);
                            doc.text(`Rs. ${medicine.total}`, 160, y);
                            y += 10;
                        });

                        // Add a horizontal line
                        doc.line(10, y, 200, y);

                        // Grand Total
                        doc.setFontSize(12);
                        doc.setFont('helvetica', 'bold');
                        doc.text(`Grand Total: Rs. ${prescription.grandTotal}`, 20, y + 10);

                        // Thank You Message
                        doc.setFontSize(10);
                        doc.setFont('helvetica', 'italic');
                        doc.text('Thank you for choosing City Pharmacy!', 105, y + 20, { align: 'center' });

                        // Save the PDF
                        doc.save(`bill_${prescriptionId}.pdf`);
                    },
                    error: function () {
                        alert('Error fetching prescription details.');
                    }
                });
            });

            // Handle Pay Button Click
            $('.pay-btn').click(function() {
                var prescriptionId = $(this).data('id');
                
                // Fetch the total amount from the database
                $.ajax({
                    url: 'fetch-prescription-total.php',
                    type: 'POST',
                    data: { prescriptionId: prescriptionId },
                    success: function(response) {
                        try {
                            var result = JSON.parse(response);
                            if (result.success) {
                                $('#paymentAmount').text('Rs. ' + result.total_amount);
                                $('#confirmPayment').data('id', prescriptionId);
                                $('#paymentModal').modal('show');
                            } else {
                                alert('Error: ' + result.message);
                            }
                        } catch(e) {
                            alert('Error processing the response');
                        }
                    },
                    error: function() {
                        alert('Error fetching payment details');
                    }
                });
            });

            // Confirm Payment
            $('#confirmPayment').click(function() {
                var prescriptionId = $(this).data('id');
                
                $.ajax({
                    url: 'mark-as-paid.php',
                    type: 'POST',
                    data: { prescriptionId: prescriptionId },
                    success: function(response) {
                        try {
                            var result = JSON.parse(response);
                            if (result.success) {
                                alert('Payment confirmed and status updated to Delivered.');
                                $('#paymentModal').modal('hide');
                                location.reload(); // Reload the page to reflect changes
                            } else {
                                alert('Error: ' + result.message);
                            }
                        } catch(e) {
                            alert('An unexpected error occurred.');
                        }
                    },
                    error: function() {
                        alert('Unable to update status at the moment. Please try again later.');
                    }
                });
            });

            // Mark as Paid
            $('.paid-btn').click(function () {
                var prescriptionId = $(this).data('id');

                // Update status to Delivered
                $.ajax({
                    url: 'mark-as-paid.php',
                    type: 'POST',
                    data: { prescriptionId: prescriptionId },
                    success: function (response) {
                        alert('Prescription marked as Delivered!');
                        // Refresh the page to reflect the updated status
                        location.reload();
                    },
                    error: function () {
                        alert('Error updating status.');
                    }
                });
            });
        });
    </script>
    <script>
    $(document).ready(function() {
        // Handle "I've Paid" button click
        $('#confirmPayment').click(function() {
            var prescriptionId = $(this).data('id');

            $.ajax({
                url: 'update-payment-status.php',
                type: 'POST',
                data: { prescriptionId: prescriptionId },
                success: function(response) {
                    try {
                        var result = JSON.parse(response);
                        if (result.success) {
                            alert(result.message);
                            $('#paymentModal').modal('hide');
                            location.reload(); // Automatically reload the page
                        } else {
                            alert('Error: ' + result.message);
                        }
                    } catch (e) {
                    }
                },
                error: function() {
                    alert('Unable to confirm payment at the moment. Please check your connection and try again.');
                }
            });
        });
    });
</script>
</body>
</html>