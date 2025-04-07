<?php
session_start();
error_reporting(0);
include('include/config.php');

// Check if the pharmacy user is logged in
if (strlen($_SESSION['id']) == 0) {
    header('location:logout.php');
} else {
    // Fetch pharmacy profile details
    $pharmEmail = $_SESSION['plogin'];
    $pharmacyQuery = mysqli_query($con, "SELECT * FROM pharmacy WHERE pharmEmail='$pharmEmail'");
    $pharmacy = mysqli_fetch_array($pharmacyQuery);

    // Fetch prescriptions ordered
    $prescriptionsQuery = mysqli_query($con, "SELECT * FROM prescriptions ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pharmacy | Dashboard</title>
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
    <link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
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
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .panel:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .btn {
            border-radius: 20px;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .btn-primary {
            background: #6c63ff;
            border: none;
        }

        .btn-primary:hover {
            background: #5a54d6;
            transform: scale(1.1);
        }

        .btn-success {
            background: #28a745;
            border: none;
        }

        .btn-success:hover {
            background: #218838;
            transform: scale(1.1);
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
                    <h1 class="text-center">Pharmacy Dashboard</h1>
                    <div class="row">
                        <!-- Profile Button -->
                        <div class="col-sm-6">
                            <div class="panel text-center">
                                <div class="panel-body">
                                    <span class="fa-stack fa-2x">
                                        <i class="fa fa-square fa-stack-2x text-primary"></i>
                                        <i class="fa fa-user fa-stack-1x fa-inverse"></i>
                                    </span>
                                    <h2 class="StepTitle">My Profile</h2>
                                    <p class="links cl-effect-1">
                                        <a href="profile.php">
                                            <button class="btn btn-primary btn-lg">Go to Profile</button>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Prescription Button -->
                        <div class="col-sm-6">
                            <div class="panel text-center">
                                <div class="panel-body">
                                    <span class="fa-stack fa-2x">
                                        <i class="fa fa-square fa-stack-2x text-success"></i>
                                        <i class="fa fa-medkit fa-stack-1x fa-inverse"></i> <!-- Changed icon to 'fa-prescription-bottle' -->
                                    </span>
                                    <h2 class="StepTitle">Prescriptions</h2>
                                    <p class="links cl-effect-1">
                                        <a href="view-prescription.php">
                                            <button class="btn btn-success btn-lg">View Prescriptions</button>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('include/footer.php'); ?>
           <!-- start: SETTINGS -->
           <?php include('include/setting.php');?>
        <!-- end: SETTINGS -->
    </div>
       <!-- Scripts -->
       <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/modernizr/modernizr.js"></script>
    <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="vendor/switchery/switchery.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/form-elements.js"></script>
    <script>
        jQuery(document).ready(function() {
            Main.init();
            FormElements.init();
        });
    </script>
</body>
</html>
<?php } ?>