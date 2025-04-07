<?php
session_start();
error_reporting(0);
include('include/config.php');

// Validate session
if (!isset($_SESSION['id']) || strlen($_SESSION['id']) == 0) {
    header('location:logout.php');
    exit();
}

// Fetch patients, doctors, and medicines from the database
$patients = [];
$doctors = [];
$medicines = [];

$patient_query = mysqli_query($con, "SELECT ID, PatientName as name FROM tblpatient");
$doctor_query = mysqli_query($con, "SELECT id, doctorName as name FROM doctors");
$medicine_query = mysqli_query($con, "SELECT id, medicine_name FROM medicines");

while ($row = mysqli_fetch_assoc($patient_query)) {
    $patients[] = $row;
}

while ($row = mysqli_fetch_assoc($doctor_query)) {
    $doctors[] = $row;
}

while ($row = mysqli_fetch_assoc($medicine_query)) {
    $medicines[] = $row;
}

// Handle form submission
if (isset($_POST['submit'])) {
    $patient_id = intval($_POST['patient_id']);
    $doctor_id = intval($_POST['doctor_id']);
    $prescription_date = mysqli_real_escape_string($con, $_POST['prescription_date']);
    $details = mysqli_real_escape_string($con, $_POST['details']);
    $medicines = $_POST['medicines'];
    $quantities = $_POST['quantities'];

    // Insert prescription into the database
    $stmt = mysqli_prepare($con, "INSERT INTO prescriptions (patient_id, doctor_id, prescription_date, details) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "iiss", $patient_id, $doctor_id, $prescription_date, $details);

    if (mysqli_stmt_execute($stmt)) {
        $prescription_id = mysqli_insert_id($con);

        // Insert medicines into the database
        for ($i = 0; $i < count($medicines); $i++) {
            $medicine_id = intval($medicines[$i]);
            $quantity = intval($quantities[$i]);

            $stmt2 = mysqli_prepare($con, "INSERT INTO prescription_medicines (prescription_id, medicine_id, quantity_needed) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmt2, "iii", $prescription_id, $medicine_id, $quantity);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_close($stmt2);
        }

        echo "<script>alert('Prescription added successfully');</script>";
        echo "<script>window.location.href ='pharma.php'</script>";
    } else {
        echo "<script>alert('Error adding prescription');</script>";
    }
    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Doctor | Add Prescription</title>
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
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

        .panel {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: #6c63ff;
            border: none;
            border-radius: 20px;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .btn-primary:hover {
            background: #5a54d6;
            transform: scale(1.05);
        }

        .btn-danger {
            background: #ff4d4d;
            border: none;
            border-radius: 20px;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .btn-danger:hover {
            background: #e60000;
            transform: scale(1.05);
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
    </style>
</head>

<body>
    <div id="app">
        <?php include('include/sidebar.php'); ?>
        <div class="app-content">
            <?php include('include/header.php'); ?>
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <div class="container">
                        <h1>Add Prescription</h1>
                        <div class="panel">
                            <form method="POST">
                                <div class="form-group">
                                    <label for="patient_id">Patient Name</label>
                                    <select name="patient_id" class="form-control" required>
                                        <option value="">Select Patient</option>
                                        <?php foreach ($patients as $patient) { ?>
                                            <option value="<?= $patient['ID'] ?>"><?= $patient['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="doctor_id">Doctor Name</label>
                                    <select name="doctor_id" class="form-control" required>
                                        <option value="">Select Doctor</option>
                                        <?php foreach ($doctors as $doctor) { ?>
                                            <option value="<?= $doctor['id'] ?>"><?= $doctor['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="prescription_date">Prescription Date</label>
                                    <input type="date" name="prescription_date" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="details">Details</label>
                                    <textarea name="details" class="form-control" placeholder="Enter prescription details" required></textarea>
                                </div>
                                <div id="medicineFields">
                                    <div class="form-group">
                                        <label for="medicines[]">Medicine</label>
                                        <select name="medicines[]" class="form-control" required>
                                            <option value="">Select Medicine</option>
                                            <?php foreach ($medicines as $medicine) { ?>
                                                <option value="<?= $medicine['id'] ?>"><?= $medicine['medicine_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantities[]">Quantity</label>
                                        <input type="number" name="quantities[]" class="form-control" min="1" placeholder="Enter quantity" required>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" onclick="addMedicineField()">+ Add Medicine</button>
                                <hr>
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-danger">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php include('include/footer.php'); ?>
                <?php include('include/setting.php'); ?>
            </div>
        </div>
    </div>
    <script>
        function addMedicineField() {
            const container = document.getElementById("medicineFields");
            const div = document.createElement("div");
            div.className = "form-group";
            div.innerHTML = `
                <label for="medicines[]">Medicine</label>
                <select name="medicines[]" class="form-control" required>
                    <option value="">Select Medicine</option>
                    <?php foreach ($medicines as $medicine) { ?>
                        <option value="<?= $medicine['id'] ?>"><?= $medicine['medicine_name'] ?></option>
                    <?php } ?>
                </select>
                <label for="quantities[]">Quantity</label>
                <input type="number" name="quantities[]" class="form-control" min="1" placeholder="Enter quantity" required>
                <button type="button" class="btn btn-danger mt-2" onclick="this.parentElement.remove()">Remove</button>
            `;
            container.appendChild(div);
        }
    </script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/modernizr/modernizr.js"></script>
    <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="vendor/switchery/switchery.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/form-elements.js"></script>
    <script>
        jQuery(document).ready(function () {
            Main.init();
            FormElements.init();
        });
    </script>
</body>

</html>