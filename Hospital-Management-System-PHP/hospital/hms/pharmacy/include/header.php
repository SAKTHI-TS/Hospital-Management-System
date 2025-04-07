<?php error_reporting(0); ?>
<header class="navbar navbar-default navbar-static-top modern-header" style="background: #0074d9; color: #0074d9; transition: all 0.3s ease;">
	<!-- start: NAVBAR HEADER -->
	<div class="navbar-header">
		<a href="#" class="sidebar-mobile-toggler pull-left hidden-md hidden-lg btn btn-navbar sidebar-toggle" data-toggle-class="app-slide-off" data-toggle-target="#app" data-toggle-click-outside="#sidebar">
			<i class="ti-align-justify" style="color: #0074d9;"></i>
		</a>
		<a class="navbar-brand" href="#">
			<h2 class="brand-title" style="font-family: 'Poppins', sans-serif; font-weight: bold; color: #0074d9; transition: color 0.3s ease;">HMS</h2>
		</a>
		<a href="#" class="sidebar-toggler pull-right visible-md visible-lg" data-toggle-class="app-sidebar-closed" data-toggle-target="#app">
			<i class="ti-align-justify" style="color: #0074d9;"></i>
		</a>
		<a class="pull-right menu-toggler visible-xs-block" id="menu-toggler" data-toggle="collapse" href=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<i class="ti-view-grid" style="color: #0074d9;"></i>
		</a>	
	</div>
	<!-- end: NAVBAR HEADER -->
	<!-- start: NAVBAR COLLAPSE -->
	<div class="navbar-collapse collapse">
		<ul class="nav navbar-right">
			<!-- start: MESSAGES DROPDOWN -->
			<li class="navbar-title">
				<h2 style="font-family: 'Poppins', sans-serif; font-weight: 500; color: #0074d9;">Hospital Management System</h2>
			</li>
			<li class="dropdown current-user">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="transition: all 0.3s ease; color: #0074d9;">
					<img src="assets/images/images.jpg" class="user-avatar"> <span class="username">
					<?php $query=mysqli_query($con,"select pharmName from pharmacy where id='".$_SESSION['id']."'"); while($row=mysqli_fetch_array($query)) { echo $row['doctorName']; } ?> 
					<i class="ti-angle-down" style="color: #0074d9;"></i></span>
				</a>
				<ul class="dropdown-menu dropdown-dark">
					<li><a href="profile.php">My Profile</a></li>
					<li><a href="change-password.php">Change Password</a></li>
					<li><a href="logout.php">Log Out</a></li>
				</ul>
			</li>
			<!-- end: USER OPTIONS DROPDOWN -->
		</ul>
		<!-- start: MENU TOGGLER FOR MOBILE DEVICES -->
		<div class="close-handle visible-xs-block menu-toggler" data-toggle="collapse" href=".navbar-collapse">
			<div class="arrow-left"></div>
			<div the="arrow-right"></div>
		</div>
		<!-- end: MENU TOGGLER FOR MOBILE DEVICES -->
	</div>
	<!-- end: NAVBAR COLLAPSE -->
</header>
