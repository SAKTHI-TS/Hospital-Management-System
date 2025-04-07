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
		<title>Doctor | Manage Patients</title>
		
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
				background: #6c63ff;
				border: none;
				color: #fff;
			}

			.btn-warning {
				background: #ffc107;
				border: none;
				color: #333;
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
<div class="main-content" >
<div class="wrap-content container" id="container">
						<h1 class="text-center">Manage Patients</h1>
						<div class="container">
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
									$docid=$_SESSION['id'];
									$sql=mysqli_query($con,"select * from tblpatient where Docid='$docid' ");
									$cnt=1;
									while($row=mysqli_fetch_array($sql))
									{
									?>
									<tr>
										<td><?php echo $cnt;?>.</td>
										<td><?php echo $row['PatientName'];?></td>
										<td><?php echo $row['PatientContno'];?></td>
										<td><?php echo $row['PatientGender'];?></td>
										<td><?php echo $row['CreationDate'];?></td>
										<td><?php echo $row['UpdationDate'];?></td>
										<td>
											<a href="edit-patient.php?editid=<?php echo $row['ID'];?>" class="btn btn-primary btn-sm">Edit</a>
											<a href="view-patient.php?viewid=<?php echo $row['ID'];?>" class="btn btn-warning btn-sm">View Details</a>
										</td>
									</tr>
									<?php 
									$cnt=$cnt+1;
									}?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include('include/footer.php'); ?>
		<?php include('include/setting.php'); ?>
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<script src="assets/js/main.js"></script>
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
	</body>
</html>
<?php } ?>