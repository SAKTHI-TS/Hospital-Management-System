<?php
session_start();
error_reporting(0);
include('include/config.php');

// Check if the pharmacy user is logged in
if (strlen($_SESSION['id']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $pharmName = $_POST['pharmname'];
        $pharmAddress = $_POST['pharmaddress'];
        $pharmContact = $_POST['pharmcontact'];
        $pharmEmail = $_POST['pharmemail'];

        // Update pharmacy profile
        $sql = mysqli_query($con, "UPDATE pharmacy SET pharmName='$pharmName', pharmAddress='$pharmAddress', pharmContact='$pharmContact' WHERE pharmEmail='$pharmEmail'");
        if ($sql) {
            echo "<script>alert('Pharmacy Details updated Successfully');</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pharmacy | Edit Profile</title>
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
                    <!-- Page Title -->
                    <!-- <section id="page-title">
                        <div class="row">
                           
                            <ol class="breadcrumb">
                                <li>
                                    <span>Pharmacy</span>
                                </li>
                                <li class="active">
                                    <span>Edit Profile</span>
                                </li>
                            </ol>
                        </div>
                    </section> -->

                    <!-- Edit Pharmacy Details Form -->
                    <div class="container">
                        <h1>Edit Pharmacy Profile</h1>
                        <div class="panel">
                            <form role="form" name="editpharmacy" method="post" onSubmit="return valid();">
                                <?php
                                $pharmEmail = $_SESSION['plogin'];
                                $sql = mysqli_query($con, "SELECT * FROM pharmacy WHERE pharmEmail='$pharmEmail'");
                                while ($data = mysqli_fetch_array($sql)) {
                                ?>
                                <h4><?php echo htmlentities($data['pharmName']); ?>'s Profile</h4>
                                <p><b>Profile Reg. Date: </b><?php echo htmlentities($data['created_at']); ?></p>
                                <?php if ($data['updated_at']) { ?>
                                <p><b>Profile Last Updation Date: </b><?php echo htmlentities($data['updated_at']); ?></p>
                                <?php } ?>
                                <hr />
                                <div class="form-group">
                                    <label for="pharmname">Pharmacy Name</label>
                                    <input type="text" name="pharmname" class="form-control" value="<?php echo htmlentities($data['pharmName']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="pharmaddress">Pharmacy Address</label>
                                    <textarea name="pharmaddress" class="form-control" required><?php echo htmlentities($data['pharmAddress']); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="pharmcontact">Pharmacy Contact No</label>
                                    <input type="text" name="pharmcontact" class="form-control" value="<?php echo htmlentities($data['pharmContact']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="pharmemail">Pharmacy Email</label>
                                    <input type="email" name="pharmemail" class="form-control" value="<?php echo htmlentities($data['pharmEmail']); ?>" readonly>
                                </div>
                                <?php } ?>
                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- start: FOOTER -->
        <?php include('include/footer.php');?>
        <!-- end: FOOTER -->

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