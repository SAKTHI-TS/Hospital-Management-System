<?php error_reporting(0); ?>
<header class="navbar navbar-default navbar-static" style="<?php echo basename($_SERVER['PHP_SELF']) == 'bookappointment.php' ? 'background-color: black; color: white;' : ''; ?>">
	<!-- start: NAVBAR HEADER -->
	<div class="navbar-header">
		<a href="#" class="sidebar-mobile-toggler pull-left hidden-md hidden-lg btn btn-navbar sidebar-toggle" data-toggle-class="app-slide-off" data-toggle-target="#app" data-toggle-click-outside="#sidebar">
			<i class="ti-align-justify" style="<?php echo basename($_SERVER['PHP_SELF']) == 'bookappointment.php' ? 'color: white;' : ''; ?>"></i>
		</a>
		<a class="navbar-brand" href="#">
			<h2 style="padding-top:20%; <?php echo basename($_SERVER['PHP_SELF']) == 'bookappointment.php' ? 'color: white;' : ''; ?>">HMS</h2>
		</a>
		<a href="#" class="sidebar-toggler pull-right visible-md visible-lg" data-toggle-class="app-sidebar-closed" data-toggle-target="#app">
			<i class="ti-align-justify" style="<?php echo basename($_SERVER['PHP_SELF']) == 'bookappointment.php' ? 'color: white;' : ''; ?>"></i>
		</a>
		<a class="pull-right menu-toggler visible-xs-block" id="menu-toggler" data-toggle="collapse" href=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<i class="ti-view-grid" style="<?php echo basename($_SERVER['PHP_SELF']) == 'bookappointment.php' ? 'color: white;' : ''; ?>"></i>
		</a>
	</div>
	<!-- end: NAVBAR HEADER -->
	<!-- start: NAVBAR COLLAPSE -->
	<div class="navbar-collapse collapse">
		<ul class="nav navbar-right">
			<!-- start: MESSAGES DROPDOWN -->
			<li style="padding-top:2%;">
				<h2 style="<?php echo basename($_SERVER['PHP_SELF']) == 'bookappointment.php' ? 'color: white;' : ''; ?>">Hospital Management System</h2>
			</li>
			<li class="dropdown current-user">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<img src="assets/images/images.jpg"> <span class="username" style="<?php echo basename($_SERVER['PHP_SELF']) == 'bookappointment.php' ? 'color: white;' : ''; ?>">
					<?php $query=mysqli_query($con,"select fullName from users where id='".$_SESSION['id']."'"); while($row=mysqli_fetch_array($query)) { echo $row['fullName']; } ?> 
					<i class="ti-angle-down" style="<?php echo basename($_SERVER['PHP_SELF']) == 'bookappointment.php' ? 'color: white;' : ''; ?>"></i></span>
				</a>
				<ul class="dropdown-menu dropdown-dark">
					<li><a href="edit-profile.php">My Profile</a></li>
					<li><a href="change-password.php">Change Password</a></li>
					<li><a href="logout.php">Log Out</a></li>
				</ul>
			</li>
			<!-- end: USER OPTIONS DROPDOWN -->
		</ul>
		<!-- start: MENU TOGGLER FOR MOBILE DEVICES -->
		<div class="close-handle visible-xs-block menu-toggler" data-toggle="collapse" href=".navbar-collapse">
			<div class="arrow-left"></div>
			<div class="arrow-right"></div>
		</div>
		<!-- end: MENU TOGGLER FOR MOBILE DEVICES -->
	</div>
	<!-- end: NAVBAR COLLAPSE -->
</header>
<style>
	.navbar-collapse.collapse {
		background-color: transparent !important;
		border: none !important;
		box-shadow: none !important;
	}
	<?php if (basename($_SERVER['PHP_SELF']) == 'bookappointment.php') { ?>
		.navbar-default {
			background-color: black !important;
			color: white !important;
		}
	<?php } ?>
</style>
<script>
	document.addEventListener('DOMContentLoaded', function () {
		// Ensure proper toggling behavior for the navbar
		const menuToggler = document.getElementById('menu-toggler');
		if (menuToggler) {
			menuToggler.addEventListener('click', function (e) {
				e.preventDefault();
				const navbarCollapse = document.querySelector('.navbar-collapse');
				navbarCollapse.classList.toggle('collapse');
			});
		}
	});
</script>
