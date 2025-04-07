<?php
session_start();
error_reporting(0);
include("include/config.php");
if(isset($_POST['submit']))
{
$uname=$_POST['username'];
$upassword=$_POST['password'];

$ret=mysqli_query($con,"SELECT * FROM admin WHERE username='$uname' and password='$upassword'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$_SESSION['login']=$_POST['username'];
$_SESSION['id']=$num['id'];
header("location:dashboard.php");

}
else
{
$_SESSION['errmsg']="Invalid username or password";

}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin Login</title>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<style>
			body {
				font-family: 'Roboto', sans-serif;
				background: linear-gradient(135deg, #6a11cb, #2575fc);
				display: flex;
				flex-direction: column;
				justify-content: center;
				align-items: center;
				height: 100vh;
				margin: 0;
				color: #fff;
			}
			.card {
				border-radius: 15px;
				box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
				background-color: #fff;
				color: #333;
				width: 100%;
				max-width: 600px;
			}
			.card-body {
				padding: 2.5rem;
			}
			.btn-primary {
				background-color: #6a11cb;
				border-color: #6a11cb;
			}
			.btn-primary:hover {
				background-color: #2575fc;
				border-color: #2575fc;
			}
			.input-group-text {
				background-color: #f8f9fa;
				border: 1px solid #ced4da;
			}
			.input-group-text i {
				color: #6c757d;
			}
			.text-primary {
				color: #6a11cb !important;
			}
			.text-muted {
				color: #6c757d !important;
			}
			.container {
				display: flex;
				justify-content: center;
				align-items: center;
				width: 100%;
				max-width: 400px;
				flex-grow: 1;
			}
			footer {
				width: 100%;
				text-align: center;
				padding: 1rem 0;
				background-color: rgba(0, 0, 0, 0.1);
				color: #fff;
			}
			.form-group label {
				font-weight: 500;
			}
			.text-center a {
				color: #6a11cb;
				text-decoration: none;
			}
			.text-center a:hover {
				text-decoration: underline;
			}
		</style>
	</head>
	<body class="login">
		<div class="container">
			<div class="card shadow-lg border-0">
				<div class="card-body">
					<div class="text-center mb-4">
						<h2 class="text-primary">HMS | Admin Login</h2>
					</div>
					<form method="post">
						<fieldset>
							<legend class="text-center mb-3">Sign in to your account</legend>
							<p class="text-danger text-center">
								<?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg']="");?>
							</p>
							<div class="form-group">
								<label for="username">Username</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-user"></i></span>
									</div>
									<input type="text" class="form-control" name="username" id="username" placeholder="Enter your username" required>
								</div>
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-lock"></i></span>
									</div>
									<input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block" name="submit">
									Login <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
							<div class="text-center mt-3">
								<a href="../../index.php" class="text-primary">Back to Home Page</a>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
		<footer>
			<div class="text-center">
				<small>&copy; <span class="text-bold">Hospital Management System</span></small>
			</div>
		</footer>
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/js/main.js"></script>
	</body>
</html>