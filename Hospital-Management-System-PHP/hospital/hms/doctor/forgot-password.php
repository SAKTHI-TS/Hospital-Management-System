<?php
session_start();
error_reporting(0);
include("include/config.php");
//Checking Details for reset password
if(isset($_POST['submit'])){
$contactno=$_POST['contactno'];
$email=$_POST['email'];
$query=mysqli_query($con,"select id from  doctors where contactno='$contactno' and docEmail='$email'");
$row=mysqli_num_rows($query);
if($row>0){

$_SESSION['cnumber']=$contactno;
$_SESSION['email']=$email;
header('location:reset-password.php');
} else {
echo "<script>alert('Invalid details. Please try with valid details');</script>";
echo "<script>window.location.href ='forgot-password.php'</script>";


}

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Doctor | Password Recovery</title>
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

<body>
    <div class="container">
        <div class="card shadow-lg border-0">
            <div class="card-body">
                <div class="text-center mb-4">
                    <a href="../../index.php">
                        <h2 class="text-primary">HMS | Doctor Password Recovery</h2>
                    </a>
                </div>
                <form method="post">
                    <fieldset>
                        <legend class="text-center mb-3">Recover Your Password</legend>
                        <p class="text-muted text-center">Enter your registered contact number and email to reset your password.</p>
                        <div class="form-group">
                            <label for="contactno">Contact Number</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                </div>
                                <input type="text" class="form-control" name="contactno" id="contactno" placeholder="Enter your contact number" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="submit">
                                Reset Password <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        </div>
                        <div class="text-center">
                            <a href="index.php">Back to Login</a>
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
</body>

</html>