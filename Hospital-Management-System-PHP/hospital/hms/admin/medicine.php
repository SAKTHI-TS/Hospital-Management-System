<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin | Edit Doctor Details</title>
		
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


	</head>
	<body>
		<div id="app">		
<?php include('include/sidebar.php');?>
			<div class="app-content">
				
						<?php include('include/header.php');?>
						<!-- start: MENU TOGGLER FOR MOBILE DEVICES -->
					
				<!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<h3>Add Medicine</h3>
						<form method="POST" action="">
							<div class="form-group">
								<label for="medicine_name">Medicine Name</label>
								<input type="text" class="form-control" name="medicine_name" id="medicine_name" required>
							</div>
							<div class="form-group">
								<label for="batch_number">Batch Number</label>
								<input type="text" class="form-control" name="batch_number" id="batch_number" required>
							</div>
							<div class="form-group">
								<label for="expiry_date">Expiry Date</label>
								<input type="date" class="form-control" name="expiry_date" id="expiry_date" required>
							</div>
							<div class="form-group">
								<label for="quantity_available">Quantity Available</label>
								<input type="number" class="form-control" name="quantity_available" id="quantity_available" required>
							</div>
							<div class="form-group">
								<label for="price_per_unit">Price Per Unit</label>
								<input type="number" step="0.01" class="form-control" name="price_per_unit" id="price_per_unit" required>
							</div>
							<div class="form-group">
								<label for="pharmacy_id">Pharmacy ID</label>
								<input type="number" class="form-control" name="pharmacy_id" id="pharmacy_id" required>
							</div>
							<button type="submit" name="add_medicine" class="btn btn-primary">Add Medicine</button>
						</form>

                        <br
						<?php
						if (isset($_POST['add_medicine'])) {
							include('include/config.php'); // Ensure database connection is included
							$medicine_name = $_POST['medicine_name'];
							$batch_number = $_POST['batch_number'];
							$expiry_date = $_POST['expiry_date'];
							$quantity_available = $_POST['quantity_available'];
							$price_per_unit = $_POST['price_per_unit'];
							$pharmacy_id = $_POST['pharmacy_id'];

							$query = "INSERT INTO medicines (medicine_name, batch_number, expiry_date, quantity_available, price_per_unit, pharmacy_id) 
									  VALUES ('$medicine_name', '$batch_number', '$expiry_date', '$quantity_available', '$price_per_unit', '$pharmacy_id')";
							$result = mysqli_query($con, $query);

							if ($result) {
								echo "<div class='alert alert-success'>Medicine added successfully.</div>";
							} else {
								echo "<div class='alert alert-danger'>Error adding medicine: " . mysqli_error($con) . "</div>";
							}
						}
						

						?>
						<!-- Check Quantity Availability -->
						<h3>Check Medicine Quantity</h3>
						<form method="POST" action="">
							<div class="form-group">
								<label for="check_medicine_name">Select Medicine</label>
								<select class="form-control" name="check_medicine_name" id="check_medicine_name" required>
									<option value="">-- Select Medicine --</option>
									<?php
									include('include/config.php'); // Ensure database connection is included
									$query = "SELECT DISTINCT medicine_name FROM medicines";
									$result = mysqli_query($con, $query);
									while ($row = mysqli_fetch_assoc($result)) {
										echo "<option value='" . $row['medicine_name'] . "'>" . $row['medicine_name'] . "</option>";
									}
									?>
								</select>
							</div>
							<button type="submit" name="check_quantity" class="btn btn-info">Check Quantity</button>
						</form>
						<?php
						if (isset($_POST['check_quantity'])) {
							$check_medicine_name = $_POST['check_medicine_name'];

							$query = "SELECT quantity_available FROM medicines WHERE medicine_name = '$check_medicine_name'";
							$result = mysqli_query($con, $query);

							if ($result && mysqli_num_rows($result) > 0) {
								$row = mysqli_fetch_assoc($result);
								echo "<div class='alert alert-info'>Quantity Available for <strong>$check_medicine_name</strong>: " . $row['quantity_available'] . "</div>";
							} else {
								echo "<div class='alert alert-warning'>No medicine found with the name <strong>$check_medicine_name</strong>.</div>";
							}
						}
						?>
                    </div>
                </div>
            </div>
            	<?php include('include/footer.php');?>
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->
	<?php include('include/setting.php');?>
			<>
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
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>
