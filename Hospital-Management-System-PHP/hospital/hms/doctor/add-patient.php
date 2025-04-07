<?php
session_start();
error_reporting(0);
include('include/config.php');
if (strlen($_SESSION['id']) == 0) { // Fixed condition
	header('location:logout.php');
} else {

	if (isset($_POST['submit'])) {
		$docid = $_SESSION['id'];
		$patname = $_POST['patname'];
		$patcontact = $_POST['patcontact'];
		$patemail = $_POST['patemail'];
		$gender = $_POST['gender'];
		$pataddress = $_POST['pataddress'];
		$patage = $_POST['patage'];
		$medhis = $_POST['medhis'];
		$sql = mysqli_query($con, "insert into tblpatient(Docid,PatientName,PatientContno,PatientEmail,PatientGender,PatientAdd,PatientAge,PatientMedhis) values('$docid','$patname','$patcontact','$patemail','$gender','$pataddress','$patage','$medhis')");
		if ($sql) {
			echo "<script>alert('Patient info added Successfully');</script>";
			echo "<script>window.location.href ='manage-patient.php'</script>";
		}
	}
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Doctor | Add Patient</title>

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
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

		<script>
			function userAvailability() {
				$("#loaderIcon").show();
				jQuery.ajax({
					url: "check_availability.php",
					data: 'email=' + $("#patemail").val(),
					type: "POST",
					success: function(data) {
						$("#user-availability-status1").html(data);
						$("#loaderIcon").hide();
					},
					error: function() {}
				});
			}
		</script>
	</head>

	<body>
		<div id="app">
			<?php include('include/sidebar.php'); ?>
			<div class="app-content">
				<?php include('include/header.php'); ?>

				<div class="main-content">
					<div class="wrap-content container" id="container">
						
						<div class="container">
							<h1>Add Patient</h1>
							<div class="panel">
								<form role="form" name="add-patient" method="post">
									<div class="form-group">
										<label for="patname">Patient Name</label>
										<input type="text" name="patname" class="form-control" placeholder="Enter Patient Name" required>
									</div>
									<div class="form-group">
										<label for="patcontact">Patient Contact No</label>
										<input type="text" name="patcontact" class="form-control" placeholder="Enter Patient Contact No" required maxlength="10" pattern="[0-9]+">
									</div>
									<div class="form-group">
										<label for="patemail">Patient Email</label>
										<input type="email" id="patemail" name="patemail" class="form-control" placeholder="Enter Patient Email ID" required onBlur="userAvailability()">
										<span id="user-availability-status1" style="font-size:12px;"></span>
									</div>
									<div class="form-group">
										<label>Gender</label>
										<div class="clip-radio radio-primary">
											<input type="radio" id="rg-female" name="gender" value="female">
											<label for="rg-female">Female</label>
											<input type="radio" id="rg-male" name="gender" value="male">
											<label for="rg-male">Male</label>
										</div>
									</div>
									<div class="form-group">
										<label for="pataddress">Patient Address</label>
										<textarea name="pataddress" class="form-control" placeholder="Enter Patient Address" required></textarea>
									</div>
									<div class="form-group">
										<label for="patage">Patient Age</label>
										<input type="text" name="patage" class="form-control" placeholder="Enter Patient Age" required>
									</div>
									<div class="form-group">
										<label for="medhis">Medical History</label>
										<textarea name="medhis" class="form-control" placeholder="Enter Patient Medical History (if any)" required></textarea>
									</div>
									<button type="submit" name="submit" class="btn btn-primary">Add</button>
								</form>
							</div>
						</div>
					</div>
					<?php include('include/footer.php'); ?>
					<?php include('include/setting.php'); ?>
				</div>
			</div>
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
<?php } ?>