<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']==0)) {
 header('location:logout.php');
  } else{
if(isset($_GET['cancel']))
		  {
		          mysqli_query($con,"update appointment set userStatus='0' where id = '".$_GET['id']."'");
                  $_SESSION['msg']="Your appointment canceled !!";
		  }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>User | Appointment History</title>
		
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

			.btn-primary {
				background: #007bff;
				border: none;
				color: #fff;
			}

			.btn-primary:hover {
				background: #0056b3;
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
						<!-- start: PAGE TITLE -->
						
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container">
							<h1>Appointment History</h1>
							<table class="table table-bordered mt-4">
								<thead>
									<tr>
										<th>#</th>
										<th>Doctor Name</th>
										<th>Specialization</th>
										<th>Consultancy Fee</th>
										<th>Appointment Date / Time</th>
										<th>Creation Date</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sql = mysqli_query($con, "select doctors.doctorName as docname,appointment.* from appointment join doctors on doctors.id=appointment.doctorId where appointment.userId='" . $_SESSION['id'] . "'");
									$cnt = 1;
									while ($row = mysqli_fetch_array($sql)) {
									?>
										<tr>
											<td><?php echo $cnt; ?>.</td>
											<td><?php echo $row['docname']; ?></td>
											<td><?php echo $row['doctorSpecialization']; ?></td>
											<td><?php echo $row['consultancyFees']; ?></td>
											<td><?php echo $row['appointmentDate']; ?> / <?php echo $row['appointmentTime']; ?></td>
											<td><?php echo $row['postingDate']; ?></td>
											<td>
												<?php
												if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 1)) {
													echo "Active";
												} elseif (($row['userStatus'] == 0) && ($row['doctorStatus'] == 1)) {
													echo "Canceled by You";
												} elseif (($row['userStatus'] == 1) && ($row['doctorStatus'] == 0)) {
													echo "Canceled by Doctor";
												}
												?>
											</td>
											<td>
												<?php if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 1)) { ?>
													<a href="appointment-history.php?id=<?php echo $row['id']; ?>&cancel=update" onClick="return confirm('Are you sure you want to cancel this appointment?')" class="btn btn-primary btn-sm">Cancel</a>
												<?php } else {
													echo "Canceled";
												} ?>
											</td>
										</tr>
									<?php
										$cnt++;
									} ?>
								</tbody>
							</table>
						</div>
						
						<!-- end: BASIC EXAMPLE -->
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