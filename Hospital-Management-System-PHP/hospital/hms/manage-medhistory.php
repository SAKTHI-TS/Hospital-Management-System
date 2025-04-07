<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Reg Users | View Medical History</title>

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

		table {
			background: #f8f9fa;
			border-radius: 10px;
			overflow: hidden;
			box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
		}

		th {
			background: rgb(106, 164, 214);
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
		}

		.btn:hover {
			transform: scale(1.1);
		}

		.btn-info {
			background: #17a2b8;
			border: none;
			color: #fff;
		}

		.btn-info:hover {
			background: #138496;
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
					
					<div class="container-fluid container-fullw bg-white">
						<div class="row">
							<div class="col-md-12">
								
								<div class="container">
									<h1>Medical History</h1>
									<table class="table table-bordered mt-4">
										<thead>
											<tr>
												<th>#</th>
												<th>Patient Name</th>
												<th>Contact Number</th>
												<th>Gender</th>
												<th>Creation Date</th>
												<th>Updation Date</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$uid = $_SESSION['id'];
											$sql = mysqli_query($con, "select tblpatient.* from tblpatient join users on users.email=tblpatient.PatientEmail where users.id='$uid'");
											$cnt = 1;
											while ($row = mysqli_fetch_array($sql)) {
											?>
												<tr>
													<td><?php echo $cnt; ?>.</td>
													<td><?php echo $row['PatientName']; ?></td>
													<td><?php echo $row['PatientContno']; ?></td>
													<td><?php echo $row['PatientGender']; ?></td>
													<td><?php echo $row['CreationDate']; ?></td>
													<td><?php echo $row['UpdationDate']; ?></td>
													<td>
														<a href="view-medhistory.php?viewid=<?php echo $row['ID']; ?>" class="btn btn-info btn-sm">View Details</a>
													</td>
												</tr>
											<?php
												$cnt++;
											} ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- start: FOOTER -->

	<!-- end: FOOTER -->

	<!-- start: SETTINGS -->
	<?php include('include/setting.php'); ?>

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