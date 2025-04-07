<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']==0)) {
 header('location:logout.php');
  } else{
if(isset($_POST['submit']))
{
	$docspecialization=$_POST['Doctorspecialization'];
$docname=$_POST['docname'];
$docaddress=$_POST['clinicaddress'];
$docfees=$_POST['docfees'];
$doccontactno=$_POST['doccontact'];
$docemail=$_POST['docemail'];
$sql=mysqli_query($con,"Update doctors set specilization='$docspecialization',doctorName='$docname',address='$docaddress',docFees='$docfees',contactno='$doccontactno' where id='".$_SESSION['id']."'");
if($sql)
{
echo "<script>alert('Doctor Details updated Successfully');</script>";

}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Doctor | Edit Profile</title>
	<!-- Replace existing styles with pharmacy profile styles -->
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
						<h1>Edit Doctor Profile</h1>
						<div class="panel">
							<?php 
							$sql = mysqli_query($con, "select * from doctors where id='" . $_SESSION['id'] . "'");
							while ($data = mysqli_fetch_array($sql)) {
							?>
							<h4><?php echo htmlentities($data['doctorName']); ?>'s Profile</h4>
							<p><b>Profile Reg. Date: </b><?php echo htmlentities($data['creationDate']); ?></p>
							<?php if ($data['updationDate']) { ?>
							<p><b>Profile Last Updation Date: </b><?php echo htmlentities($data['updationDate']); ?></p>
							<?php } ?>
							<hr />
							<form role="form" name="edit" method="post">
								<div class="form-group">
									<label for="DoctorSpecialization">Doctor Specialization</label>
									<select name="Doctorspecialization" class="form-control" required="required">
										<option value="<?php echo htmlentities($data['specilization']); ?>">
											<?php echo htmlentities($data['specilization']); ?>
										</option>
										<?php 
										$ret = mysqli_query($con, "select * from doctorspecilization");
										while ($row = mysqli_fetch_array($ret)) {
										?>
										<option value="<?php echo htmlentities($row['specilization']); ?>">
											<?php echo htmlentities($row['specilization']); ?>
										</option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
									<label for="doctorname">Doctor Name</label>
									<input type="text" name="docname" class="form-control" value="<?php echo htmlentities($data['doctorName']); ?>">
								</div>
								<div class="form-group">
									<label for="address">Clinic Address</label>
									<textarea name="clinicaddress" class="form-control"><?php echo htmlentities($data['address']); ?></textarea>
								</div>
								<div class="form-group">
									<label for="fess">Consultancy Fees</label>
									<input type="text" name="docfees" class="form-control" required="required" value="<?php echo htmlentities($data['docFees']); ?>">
								</div>
								<div class="form-group">
									<label for="fess">Contact Number</label>
									<input type="text" name="doccontact" class="form-control" required="required" value="<?php echo htmlentities($data['contactno']); ?>">
								</div>
								<div class="form-group">
									<label for="fess">Email</label>
									<input type="email" name="docemail" class="form-control" readonly="readonly" value="<?php echo htmlentities($data['docEmail']); ?>">
									<a href="change-emaild.php" class="text-info">Update your email id</a>
								</div>
								<button type="submit" name="submit" class="btn btn-primary">Update</button>
							</form>
							<?php } ?>
						</div>
					</div>
				</div>
				<?php include('include/footer.php'); ?>
				<?php include('include/setting.php'); ?>
			</div>
		</div>
	</div>
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
<?php } ?>