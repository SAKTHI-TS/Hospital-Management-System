<?php
session_start();
//error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if(isset($_POST['submit']))
{
$specilization=$_POST['Doctorspecialization'];
$doctorid=$_POST['doctor'];
$userid=$_SESSION['id'];
$fees=$_POST['fees'];
$appdate=$_POST['appdate'];
$time=$_POST['apptime'];
$userstatus=1;
$docstatus=1;
$query=mysqli_query($con,"insert into appointment(doctorSpecialization,doctorId,userId,consultancyFees,appointmentDate,appointmentTime,userStatus,doctorStatus) values('$specilization','$doctorid','$userid','$fees','$appdate','$time','$userstatus','$docstatus')");
	if($query)
	{
		echo "<script>alert('Your appointment successfully booked');</script>";
	}

}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>User | Book Appointment</title>
	
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
		<link rel="stylesheet" href="assets/css/themes/theme-6.css">
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
		<style>
			body {
				font-family: 'Poppins', sans-serif;
				background-color: #f8f9fa;
				color: #333;
				margin: 0;
				padding: 0;
			}

			.container {
				margin-top: 50px;
				max-width: 800px;
				margin-left: auto;
				margin-right: auto;
			}

			h1 {
				font-weight: 600;
				color: #444;
				text-align: center;
				margin-bottom: 30px;
			}

			.card {
				background: #fff;
				border-radius: 8px;
				padding: 20px;
				box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
			}

			.card-body {
				padding: 15px;
			}

			.form-group label {
				font-weight: 500;
				color: #555;
			}

			.form-control {
				border-radius: 5px;
				border: 1px solid #ced4da;
				padding: 10px;
				font-size: 14px;
			}

			.form-control:focus {
				border-color: #007bff;
				box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
			}

			.btn-primary {
				background: #007bff;
				border: none;
				border-radius: 5px;
				padding: 10px 20px;
				color: #fff;
				font-weight: 500;
				transition: background-color 0.3s ease;
			}

			.btn-primary:hover {
				background: #0056b3;
			}

			.text-danger {
				color: #dc3545;
				font-size: 14px;
			}

			select.form-control {
				appearance: none;
				background: #fff url('data:image/svg+xml;charset=US-ASCII,%3Csvg xmlns%3D%27http%3A//www.w3.org/2000/svg%27 viewBox%3D%270 0 4 5%27%3E%3Cpath fill%3D%27%23333%27 d%3D%27M2 0L0 2h4zM0 3l2 2 2-2z%27/%3E%3C/svg%3E') no-repeat right 10px center;
				background-size: 10px 10px;
			}

			.datepicker {
				cursor: pointer;
			}
		</style>
		
		<script>
function getdoctor(val) {
	$.ajax({
	type: "POST",
	url: "get_doctor.php",
	data:'specilizationid='+val,
	success: function(data){
		$("#doctor").html(data);
	}
	});
}
</script>	


<script>
function getfee(val) {
	$.ajax({
	type: "POST",
	url: "get_doctor.php",
	data:'doctor='+val,
	success: function(data){
		$("#fees").html(data);
	}
	});
}
</script>	

<script>
	document.addEventListener('DOMContentLoaded', function () {
		// Force the default theme-6 to be applied
		document.getElementById('skin_color').setAttribute('href', 'assets/css/themes/theme-6.css');

		// Ensure proper toggling behavior for the navbar
		const menuToggler = document.getElementById('menu-toggler');
		if (menuToggler) {
			menuToggler.addEventListener('click', function (e) {
				e.preventDefault();
				const navbarCollapse = document.querySelector('.navbar-collapse');
				if (navbarCollapse.classList.contains('collapse')) {
					navbarCollapse.classList.remove('collapse');
				} else {
					navbarCollapse.classList.add('collapse');
				}
			});
		}
	});
</script>

	</head>
	<body>
		<div id="app">		
<?php include('include/sidebar.php');?>
			<div class="app-content">
					
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<!-- <section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">User | Book Appointment</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>User</span>
									</li>
									<li class="active">
										<span>Book Appointment</span>
									</li>
								</ol>
						</section> -->
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container">
							<h1>Book Appointment</h1>
							<div class="card">
								<div class="card-body">
									<p class="text-danger"><?php echo htmlentities($_SESSION['msg1']); ?>
									<?php echo htmlentities($_SESSION['msg1'] = ""); ?></p>
									<form role="form" name="book" method="post">
										<div class="form-group">
											<label for="DoctorSpecialization">Doctor Specialization</label>
											<select name="Doctorspecialization" class="form-control" onChange="getdoctor(this.value);" required="required">
												<option value="">Select Specialization</option>
												<?php $ret = mysqli_query($con, "select * from doctorspecilization");
												while ($row = mysqli_fetch_array($ret)) { ?>
													<option value="<?php echo htmlentities($row['specilization']); ?>">
														<?php echo htmlentities($row['specilization']); ?>
													</option>
												<?php } ?>
											</select>
										</div>
										<div class="form-group">
											<label for="doctor">Doctors</label>
											<select name="doctor" class="form-control" id="doctor" onChange="getfee(this.value);" required="required">
												<option value="">Select Doctor</option>
											</select>
										</div>
										<div class="form-group">
											<label for="consultancyfees">Consultancy Fees</label>
											<select name="fees" class="form-control" id="fees" readonly>
											</select>
										</div>
										<div class="form-group">
											<label for="AppointmentDate">Date</label>
											<input class="form-control datepicker" name="appdate" required="required" data-date-format="yyyy-mm-dd">
										</div>
										<div class="form-group">
											<label for="Appointmenttime">Time</label>
											<input class="form-control" name="apptime" id="timepicker1" required="required" placeholder="eg: 10:00 PM">
										</div>
										<button type="submit" name="submit" class="btn btn-primary">
											Submit
										</button>
									</form>
								</div>
							</div>
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

			$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-3d'
});
		</script>
		  <script type="text/javascript">
            $('#timepicker1').timepicker();
        </script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>

	</body>
</html>
