<?php
session_start();
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('include/config.php');
if(strlen($_SESSION['id']==0)) {
    header('location:logout.php');
} else {
    if(isset($_GET['del'])) {
        $docid = $_GET['id'];
        mysqli_query($con, "delete from pharmacy where id ='$docid'");
        $_SESSION['msg'] = "data deleted !!";
        header('Location: manage-pharma.php'); // Refresh the page
        exit(); // Ensure script execution stops here
    }

    if (isset($_POST['add'])) {
        $pharmName = $_POST['pharmName'];
        $pharmContact = $_POST['pharmContact'];
        $pharmEmail = $_POST['pharmEmail'];
        $pharmAddress = $_POST['pharmAddress'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = $createdAt;

        $query = "INSERT INTO pharmacy (pharmName, pharmContact, pharmEmail, pharmAddress, password, created_at, updated_at) 
                  VALUES ('$pharmName', '$pharmContact', '$pharmEmail', '$pharmAddress', '$password', '$createdAt', '$updatedAt')";
        if (mysqli_query($con, $query)) {
            $_SESSION['msg'] = "Pharmacy added successfully!";
        } else {
            $_SESSION['msg'] = "Error: " . mysqli_error($con);
        }
        header('Location: manage-pharma.php');
        exit();
    }

    if (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $pharmName = $_POST['pharmName'];
        $pharmContact = $_POST['pharmContact'];
        $pharmEmail = $_POST['pharmEmail'];
        $pharmAddress = $_POST['pharmAddress'];
        $updatedAt = date('Y-m-d H:i:s');

        if (!empty($_POST['password'])) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $query = "UPDATE pharmacy 
                      SET pharmName='$pharmName', pharmContact='$pharmContact', pharmEmail='$pharmEmail', pharmAddress='$pharmAddress', password='$password', updated_at='$updatedAt' 
                      WHERE id='$id'";
        } else {
            $query = "UPDATE pharmacy 
                      SET pharmName='$pharmName', pharmContact='$pharmContact', pharmEmail='$pharmEmail', pharmAddress='$pharmAddress', updated_at='$updatedAt' 
                      WHERE id='$id'";
        }

        if (mysqli_query($con, $query)) {
            $_SESSION['msg'] = "Pharmacy updated successfully!";
        } else {
            $_SESSION['msg'] = "Error: " . mysqli_error($con);
        }
        header('Location: manage-pharma.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin | Manage pharma</title>
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
    </head>
    <body>
        <div id="app">
            <?php include('include/sidebar.php'); ?>
            <div class="app-content">
                <?php include('include/header.php'); ?>
                <div class="main-content">
                    <div class="wrap-content container" id="container">
                        <section id="page-title">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h1 class="mainTitle">Admin | Manage pharma</h1>
                                </div>
                                <ol class="breadcrumb">
                                    <li>
                                        <span>Admin</span>
                                    </li>
                                    <li class="active">
                                        <span>Manage pharma</span>
                                    </li>
                                </ol>
                            </div>
                        </section>
                        <div class="container-fluid container-fullw bg-white">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="over-title margin-bottom-15">Manage <span class="text-bold">pharma</span></h5>
                                    <p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
                                    <?php echo htmlentities($_SESSION['msg'] = ""); ?></p>

                                    <!-- Add New Pharmacy Button -->
                                    <button class="btn btn-primary" onclick="showAddForm()">Add New Pharmacy</button>

                                    <!-- Add/Edit Form -->
                                    <form method="post" action="" id="pharmacyForm" style="margin-top: 20px; display: none;">
                                        <input type="hidden" name="id" id="pharmId" value="">
                                        <div class="form-group">
                                            <label for="pharmName">Pharmacy Name</label>
                                            <input type="text" name="pharmName" id="pharmName" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="pharmContact">Contact</label>
                                            <input type="text" name="pharmContact" id="pharmContact" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="pharmEmail">Email</label>
                                            <input type="email" name="pharmEmail" id="pharmEmail" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="pharmAddress">Address</label>
                                            <textarea name="pharmAddress" id="pharmAddress" class="form-control" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control">
                                            <small class="text-muted">Leave blank to keep the current password when editing.</small>
                                        </div>
                                        <button type="submit" name="add" id="addButton" class="btn btn-primary">Add</button>
                                        <button type="submit" name="edit" id="editButton" class="btn btn-success" style="display: none;">Update</button>
                                        <button type="button" class="btn btn-secondary" onclick="hideForm()">Cancel</button>
                                    </form>

                                    <table class="table table-hover" id="sample-table-1">
                                        <thead>
                                            <tr>
                                                <th class="center">#</th>
                                                <th class="hidden-xs">Pharma Name</th>
                                                <th>Contact</th>
                                                <th>PharmEmail</th>
                                                <th>Address</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = mysqli_query($con, "SELECT * FROM pharmacy");
                                            $cnt = 1;
                                            while($row = mysqli_fetch_array($sql)) {
                                            ?>
                                            <tr>
                                                <td class="center"><?php echo $cnt; ?>.</td>
                                                <td><?php echo $row['pharmName']; ?></td>
                                                <td><?php echo $row['pharmContact']; ?></td>
                                                <td class="hidden-xs"><?php echo $row['pharmEmail']; ?></td>
                                                <td><?php echo $row['pharmAddress']; ?></td>
                                                <td><?php echo $row['created_at']; ?></td>
                                                <td><?php echo $row['updated_at']; ?></td>
                                                <td>
                                                    <div class="visible-md visible-lg hidden-sm hidden-xs">
                                                        <button class="btn btn-transparent btn-xs" onclick="editPharma(<?php echo $row['id']; ?>, '<?php echo $row['pharmName']; ?>', '<?php echo $row['pharmContact']; ?>', '<?php echo $row['pharmEmail']; ?>', '<?php echo $row['pharmAddress']; ?>')"><i class="fa fa-pencil"></i></button>
                                                        <a href="manage-pharma.php?id=<?php echo $row['id']; ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-transparent btn-xs tooltips"><i class="fa fa-times fa fa-white"></i></a>
                                                    </div>
                                                    <div class="visible-xs visible-sm hidden-md hidden-lg">
                                                        <div class="btn-group" dropdown is-open="status.isopen">
                                                            <button type="button" class="btn btn-primary btn-o btn-sm dropdown-toggle" dropdown-toggle>
                                                                <i class="fa fa-cog"></i>&nbsp;<span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu pull-right dropdown-light" role="menu">
                                                                <li><a href="#">Edit</a></li>
                                                                <li><a href="#">Share</a></li>
                                                                <li><a href="#">Remove</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $cnt = $cnt + 1; } ?>
                                        </tbody>
                                    </table>
                                </div>
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
        <script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
        <script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="vendor/autosize/autosize.min.js"></script>
        <script src="vendor/selectFx/classie.js"></script>
        <script src="vendor/selectFx/selectFx.js"></script>
        <script src="vendor/select2/select2.min.js"></script>
        <script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/form-elements.js"></script>
        <script>
            jQuery(document).ready(function() {
                Main.init();
                FormElements.init();
            });

            function showAddForm() {
                document.getElementById('pharmacyForm').style.display = 'block';
                document.getElementById('addButton').style.display = 'inline-block';
                document.getElementById('editButton').style.display = 'none';
                document.getElementById('pharmId').value = '';
                document.getElementById('pharmName').value = '';
                document.getElementById('pharmContact').value = '';
                document.getElementById('pharmEmail').value = '';
                document.getElementById('pharmAddress').value = '';
                document.getElementById('password').value = '';
            }

            function hideForm() {
                document.getElementById('pharmacyForm').style.display = 'none';
            }

            function editPharma(id, name, contact, email, address) {
                document.getElementById('pharmacyForm').style.display = 'block';
                document.getElementById('pharmId').value = id;
                document.getElementById('pharmName').value = name;
                document.getElementById('pharmContact').value = contact;
                document.getElementById('pharmEmail').value = email;
                document.getElementById('pharmAddress').value = address;
                document.getElementById('password').value = '';
                document.getElementById('addButton').style.display = 'none';
                document.getElementById('editButton').style.display = 'inline-block';
            }
        </script>
    </body>
</html>
<?php } ?>