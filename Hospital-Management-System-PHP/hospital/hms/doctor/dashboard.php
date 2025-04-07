<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']==0)) {
 header('location:logout.php');
  } else{

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Doctor | Dashboard</title>
		
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
				transition: transform 0.3s ease, box-shadow 0.3s ease;
			}

			.panel:hover {
				transform: scale(1.05);
				box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
			}

			.btn {
				border-radius: 20px;
				transition: transform 0.3s ease, background-color 0.3s ease;
			}

			.btn-primary {
				background: #6c63ff;
				border: none;
			}

			.btn-primary:hover {
				background: #5a54d6;
				transform: scale(1.1);
			}

			.btn-success {
				background: #28a745;
				border: none;
			}

			.btn-success:hover {
				background: #218838;
				transform: scale(1.1);
			}

			.btn-warning {
				background: #ffc107;
				border: none;
			}

			.btn-warning:hover {
				background: #e0a800;
				transform: scale(1.1);
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
<?php include('include/sidebar.php');?>
			<div class="app-content">
				
						<?php include('include/header.php');?>
						
				<!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container">
					
						<!-- start: BASIC EXAMPLE -->
						<div class="container">
							<h1>Doctor Dashboard</h1>
							<div class="row">
								<!-- Profile Button -->
								<div class="col-sm-4">
									<div class="panel text-center">
										<div class="panel-body">
											<span class="fa-stack fa-2x">
												<i class="fa fa-square fa-stack-2x text-primary"></i>
												<i class="fa fa-user fa-stack-1x fa-inverse"></i>
											</span>
											<h2 class="StepTitle">My Profile</h2>
											<p class="links cl-effect-1">
												<a href="edit-profile.php">
													<button class="btn btn-primary btn-lg">Go to Profile</button>
												</a>
											</p>
										</div>
									</div>
								</div>

								<!-- Appointment History Button -->
								<div class="col-sm-4">
									<div class="panel text-center">
										<div class="panel-body">
											<span class="fa-stack fa-2x">
												<i class="fa fa-square fa-stack-2x text-success"></i>
												<i class="fa fa-calendar fa-stack-1x fa-inverse"></i>
											</span>
											<h2 class="StepTitle">My Appointments</h2>
											<p class="links cl-effect-1">
												<a href="appointment-history.php">
													<button class="btn btn-success btn-lg">View History</button>
												</a>
											</p>
										</div>
									</div>
								</div>

								<!-- Manage Patients Button -->
								<div class="col-sm-4">
									<div class="panel text-center">
										<div class="panel-body">
											<span class="fa-stack fa-2x">
												<i class="fa fa-square fa-stack-2x text-warning"></i>
												<i class="fa fa-users fa-stack-1x fa-inverse"></i>
											</span>
											<h2 class="StepTitle">Manage Patients</h2>
											<p class="links cl-effect-1">
												<a href="manage-patient.php">
													<button class="btn btn-warning btn-lg">View Patients</button>
												</a>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
			
					
					
						
						
					
						<!-- end: SELECT BOXES -->
						
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
