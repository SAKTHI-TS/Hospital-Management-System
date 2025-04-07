<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']==0)) {
 header('location:logout.php');
  } else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );
if(isset($_POST['submit']))
{
$cpass=md5($_POST['cpass']);
$did=$_SESSION['id'];
$sql=mysqli_query($con,"SELECT password FROM  doctors where password='$cpass' && id='$did'");
$num=mysqli_fetch_array($sql);
if($num>0)
{
$npass=md5($_POST['npass']);
 $con=mysqli_query($con,"update doctors set password='$npass', updationDate='$currentTime' where id='$did'");
$_SESSION['msg1']="Password Changed Successfully !!";
}
else
{
$_SESSION['msg1']="Old Password not match !!";
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Doctor | Change Password</title>
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
    <script type="text/javascript">
        function valid() {
            if (document.chngpwd.cpass.value == "") {
                alert("Current Password Field is Empty!");
                document.chngpwd.cpass.focus();
                return false;
            } else if (document.chngpwd.npass.value == "") {
                alert("New Password Field is Empty!");
                document.chngpwd.npass.focus();
                return false;
            } else if (document.chngpwd.cfpass.value == "") {
                alert("Confirm Password Field is Empty!");
                document.chngpwd.cfpass.focus();
                return false;
            } else if (document.chngpwd.npass.value != document.chngpwd.cfpass.value) {
                alert("Password and Confirm Password Field do not match!");
                document.chngpwd.cfpass.focus();
                return false;
            }
            return true;
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="card shadow-lg border-0">
            <div class="card-body">
                <div class="text-center mb-4">
                    <a href="../../index.php">
                        <h2 class="text-primary">HMS | Change Password</h2>
                    </a>
                </div>
                <form name="chngpwd" method="post" onSubmit="return valid();">
                    <fieldset>
                        <legend class="text-center mb-3">Update Your Password</legend>
                        <p class="text-danger text-center">
                            <?php echo htmlentities($_SESSION['msg1']); ?>
                            <?php echo htmlentities($_SESSION['msg1'] = ""); ?>
                        </p>
                        <div class="form-group">
                            <label for="cpass">Current Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" name="cpass" id="cpass" placeholder="Enter Current Password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="npass">New Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" name="npass" id="npass" placeholder="Enter New Password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cfpass">Confirm Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" name="cfpass" id="cfpass" placeholder="Confirm New Password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="submit">
                                Update Password <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        </div>
                        <div class="text-center">
                            <a href="dashboard.php">Back to Dashboard</a>
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
<?php } ?>
