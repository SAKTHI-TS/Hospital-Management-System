<?php session_start();
error_reporting(0);
include("include/config.php");
if(isset($_POST['submit']))
{
$puname=$_POST['username'];	
$ppwd=md5($_POST['password']);
$ret=mysqli_query($con,"SELECT * FROM users WHERE email='$puname' and password='$ppwd'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$_SESSION['login']=$_POST['username'];
$_SESSION['id']=$num['id'];
$pid=$num['id'];
$host=$_SERVER['HTTP_HOST'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
// For stroing log if user login successfull
$log=mysqli_query($con,"insert into userlog(uid,username,userip,status) values('$pid','$puname','$uip','$status')");
header("location:dashboard.php");
}
else
{
// For stroing log if user login unsuccessfull
$_SESSION['login']=$_POST['username'];	
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
mysqli_query($con,"insert into userlog(username,userip,status) values('$puname','$uip','$status')");

echo "<script>alert('Invalid username or password');</script>";
echo "<script>window.location.href='user-login.php'</script>";
}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>User Login</title>
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
				width: 100%; /* Adjust width */
				max-width: 600px; /* Increase max width */
			}
			.card-body {
				padding: 2.5rem; /* Increase padding */
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
				flex-grow: 1; /* Allow the container to grow and push the footer down */
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
						<a href="../index.php"><h2 class="text-primary">HMS | Patient Login</h2></a>
					</div>
					<form method="post">
						<fieldset>
							<legend class="text-center mb-3">Sign in to your account</legend>
							<p class="text-danger text-center">
								<?php echo $_SESSION['errmsg']; ?><?php echo $_SESSION['errmsg']="";?>
							</p>
							<div class="form-group">
								<label for="username">Email</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-user"></i></span>
									</div>
									<input type="email" class="form-control" name="username" id="username" placeholder="Enter your email" required>
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
							<div class="form-group text-right">
								<a href="forgot-password.php" class="text-muted">Forgot Password?</a>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block" name="submit">
									Login <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
							<div class="text-center mt-3">
								<p>Don't have an account yet? <a href="registration.php">Create an account</a></p>
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