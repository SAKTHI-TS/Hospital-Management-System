<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']==0)) {
 header('location:logout.php');
  } else{
if(isset($_POST['submit']))
  {
    
    $vid=$_GET['viewid'];
    $bp=$_POST['bp'];
    $bs=$_POST['bs'];
    $weight=$_POST['weight'];
    $temp=$_POST['temp'];
   $pres=$_POST['pres'];
   
 
      $query.=mysqli_query($con, "insert   tblmedicalhistory(PatientID,BloodPressure,BloodSugar,Weight,Temperature,MedicalPres)value('$vid','$bp','$bs','$weight','$temp','$pres')");
    if ($query) {
    echo '<script>alert("Medicle history has been added.")</script>';
    echo "<script>window.location.href ='manage-patient.php'</script>";
  }
  else
    {
      echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Doctor | View Patient</title>
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

        .btn-primary {
            background: #6c63ff;
            border: none;
            color: #fff;
        }

        .btn-primary:hover {
            background: #5a54d6;
            transform: scale(1.05);
        }

        .btn-secondary {
            background: #6c757d;
            border: none;
            color: #fff;
        }

        .btn-secondary:hover {
            background: #5a6268;
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
                    <h1 class="text-center">View Patient</h1>
                    <div class="container">
                        <?php
                        $vid = $_GET['viewid'];
                        $ret = mysqli_query($con, "select * from tblpatient where ID='$vid'");
                        while ($row = mysqli_fetch_array($ret)) {
                        ?>
                            <table class="table table-bordered mt-4">
                                <thead>
                                    <tr>
                                        <th colspan="4">Patient Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Patient Name</th>
                                        <td><?php echo $row['PatientName']; ?></td>
                                        <th>Patient Email</th>
                                        <td><?php echo $row['PatientEmail']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Contact Number</th>
                                        <td><?php echo $row['PatientContno']; ?></td>
                                        <th>Address</th>
                                        <td><?php echo $row['PatientAdd']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Gender</th>
                                        <td><?php echo $row['PatientGender']; ?></td>
                                        <th>Age</th>
                                        <td><?php echo $row['PatientAge']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Medical History</th>
                                        <td><?php echo $row['PatientMedhis']; ?></td>
                                        <th>Registration Date</th>
                                        <td><?php echo $row['CreationDate']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php } ?>

                        <?php
                        $ret = mysqli_query($con, "select * from tblmedicalhistory where PatientID='$vid'");
                        ?>
                        <table class="table table-bordered mt-4">
                            <thead>
                                <tr>
                                    <th colspan="7">Medical History</th>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>Blood Pressure</th>
                                    <th>Weight</th>
                                    <th>Blood Sugar</th>
                                    <th>Body Temperature</th>
                                    <th>Prescription</th>
                                    <th>Visit Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $cnt = 1;
                                while ($row = mysqli_fetch_array($ret)) {
                                ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $row['BloodPressure']; ?></td>
                                        <td><?php echo $row['Weight']; ?></td>
                                        <td><?php echo $row['BloodSugar']; ?></td>
                                        <td><?php echo $row['Temperature']; ?></td>
                                        <td><?php echo $row['MedicalPres']; ?></td>
                                        <td><?php echo $row['CreationDate']; ?></td>
                                    </tr>
                                <?php $cnt++;
                                } ?>
                            </tbody>
                        </table>
                        <div class="text-center mt-4">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Medical History</button>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Medical History</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post">
                                            <div class="form-group">
                                                <label for="bp">Blood Pressure</label>
                                                <input type="text" name="bp" class="form-control" placeholder="Enter Blood Pressure" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="bs">Blood Sugar</label>
                                                <input type="text" name="bs" class="form-control" placeholder="Enter Blood Sugar" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="weight">Weight</label>
                                                <input type="text" name="weight" class="form-control" placeholder="Enter Weight" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="temp">Body Temperature</label>
                                                <input type="text" name="temp" class="form-control" placeholder="Enter Body Temperature" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="pres">Prescription</label>
                                                <textarea name="pres" class="form-control" rows="4" placeholder="Enter Prescription" required></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
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
<?php }  ?>
