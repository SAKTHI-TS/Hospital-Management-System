<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']==0)) {
 header('location:logout.php');
  } else{

if(isset($_POST['submit']))
{	
	$eid=$_GET['editid'];
	$patname=$_POST['patname'];
$patcontact=$_POST['patcontact'];
$patemail=$_POST['patemail'];
$gender=$_POST['gender'];
$pataddress=$_POST['pataddress'];
$patage=$_POST['patage'];
$medhis=$_POST['medhis'];
$sql=mysqli_query($con,"update tblpatient set PatientName='$patname',PatientContno='$patcontact',PatientEmail='$patemail',PatientGender='$gender',PatientAdd='$pataddress',PatientAge='$patage',PatientMedhis='$medhis' where ID='$eid'");
if($sql)
{
echo "<script>alert('Patient info updated Successfully');</script>";
header('location:manage-patient.php');

}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Doctor | Edit Patient</title>
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
                        <h1>Edit Patient</h1>
                        <div class="panel">
                            <form role="form" name="edit-patient" method="post">
                                <?php
                                $eid = $_GET['editid'];
                                $ret = mysqli_query($con, "select * from tblpatient where ID='$eid'");
                                while ($row = mysqli_fetch_array($ret)) {
                                ?>
                                    <div class="form-group">
                                        <label for="patname">Patient Name</label>
                                        <input type="text" name="patname" class="form-control" value="<?php echo $row['PatientName']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="patcontact">Patient Contact No</label>
                                        <input type="text" name="patcontact" class="form-control" value="<?php echo $row['PatientContno']; ?>" required maxlength="10" pattern="[0-9]+">
                                    </div>
                                    <div class="form-group">
                                        <label for="patemail">Patient Email</label>
                                        <input type="email" id="patemail" name="patemail" class="form-control" value="<?php echo $row['PatientEmail']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <div class="clip-radio radio-primary">
                                            <input type="radio" id="rg-female" name="gender" value="Female" <?php if ($row['PatientGender'] == "Female") echo "checked"; ?>>
                                            <label for="rg-female">Female</label>
                                            <input type="radio" id="rg-male" name="gender" value="Male" <?php if ($row['PatientGender'] == "Male") echo "checked"; ?>>
                                            <label for="rg-male">Male</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="pataddress">Patient Address</label>
                                        <textarea name="pataddress" class="form-control" required><?php echo $row['PatientAdd']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="patage">Patient Age</label>
                                        <input type="text" name="patage" class="form-control" value="<?php echo $row['PatientAge']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="medhis">Medical History</label>
                                        <textarea name="medhis" class="form-control" required><?php echo $row['PatientMedhis']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="creationdate">Creation Date</label>
                                        <input type="text" class="form-control" value="<?php echo $row['CreationDate']; ?>" readonly>
                                    </div>
                                <?php } ?>
                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
             
            </div>
        </div>
		<?php include('include/footer.php'); ?>
		<?php include('include/setting.php'); ?>
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
