
<!--/**-->
<!-- * Created by IntelliJ IDEA.-->
<!-- * User: RadioactiveScript-->
<!-- * Date: 7/30/2018-->
<!-- * Time: 10:16 AM-->
<!-- */-->
<?php

session_start();
$user = $_SESSION['current_user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TRIP Admin - Dashboard</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <style>
        #addTrip {
            background-color: steelblue;
            width: 75%;
            color: #333333;
            height: 150px;
            margin: 0 auto;
            overflow: hidden;
            padding: 10px 0;
            align-items: center;
            justify-content: space-around;
            display: flex;
            float: none;
        }

        #trip_image {
            height: 150px;
            width: 300px;
        }
        label.checkbox{
            width: 400px !important;
        }
    </style>

</head>
<body id="page-top">

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="./dashboard.php">TRIPP.</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
<!--    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">-->
<!--        <div class="input-group">-->
<!--            <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">-->
<!--            <div class="input-group-append">-->
<!--                <button class="btn btn-primary" type="button">-->
<!--                    <i class="fas fa-search"></i>-->
<!--                </button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </form>-->

    <!-- Navbar -->
    <ul class="navbar-nav d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" href="logout.php" >Logout</a>
            </div>
        </li>
    </ul>

</nav>

<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="dashboard.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-folder"></i>
                <span>Pages</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <h6 class="dropdown-header">Login Screens:</h6>
                <a class="dropdown-item" href="login.html">Login</a>
                <a class="dropdown-item" href="register.html">Register</a>
                <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
                <div class="dropdown-divider"></div>
                <h6 class="dropdown-header">Other Pages:</h6>
                <a class="dropdown-item" href="404.html">404 Page</a>
                <a class="dropdown-item" href="blank.html">Blank Page</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="charts.html">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Charts</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="tables.html">
                <i class="fas fa-fw fa-table"></i>
                <span>Tables</span></a>
        </li>
    </ul>


</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Main content -->

<div id="content-wrapper">

    <div class="container-fluid">

        <div class="alert alert-dismissible fade show" role="alert" id='trip_status'>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div id="addTrip">
            <div class="col-md-2">
                <!-- Trigger the modal with a button -->
                <button type="button" class="btn btn-lg btn-info" data-toggle="modal" data-target="#myModal"
                        onclick="clearForm();triggerAddTrip()">
                    Add Trip
                </button>
            </div>
        </div> <!-- End of id=addtrip of dashboard.html-->

        <!-- Modal -->
        <div id="myModal" class="modal fade " role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Trip Information</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>
                    <div class="modal-body">
                        <!-- Form Start -->
                        <form action="" method="POST" id="trip_form">
                            <div class="form-group row">
                                <label for="trip-name" class="col-sm-2 col-form-label">Trip Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="trip-name" placeholder="St. Lucia." required
                                           autofocus name="trip-name"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="trip-url" class="col-sm-2 col-form-label">Trip URL</label>
                                <div class="col-sm-10">
                                    <input type="url" class="form-control" id="trip-url" placeholder="http://someurl.com"
                                           required name="trip-url" oninput="showImages()">
                                    <div id="unsplash_placeholder"></div>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="trip-starting-date" class="col-sm-2 col-form-label">Starting Date</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="trip-starting-date"
                                           placeholder="Select Trip Starting Date" required data-date-format="YYYY MM DD"
                                           value="2018-08-09" name="trip-starting-date">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="trip-ending-date" class="col-sm-2 col-form-label">Ending Date</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="trip-ending-date"
                                           placeholder="Select Trip Ending Date" required data-date-format="DD MMMM YYYY"
                                           value="2018-08-09" name="trip-ending-date">
                                </div>
                            </div>
                            <div class="form-group row" id="member_list">
                                <label for="trip-member" class="col-sm-2 col-form-label">Select Members</label>
                                <div class="col-md-10" id="trip-member">
                                    <select id="multiple-checkboxes" multiple="multiple" class=" lg_select_text_box" name="member[]" required>

                                        <!-- PHP Code to SPIT data here -->
                                        <?php
                                        /* Combine two array and make associative array */
                                        function Combine($array1, $array2) {
                                            if(count($array1) == count($array2)) {
                                                $assArray = array();
                                                for($i=0;$i<count($array1);$i++) {
                                                    $assArray[$array1[$i]] = $array2[$i];
                                                }
                                                return $assArray;
                                            }
                                        }
                                        //                                TODO : Spit Sorted name to dropdown list

                                        $current_user_id = $_SESSION['current_user_id'];
                                        $select_query = "select u_id, u_name from trip_user WHERE u_id != '$current_user_id'";
                                        if ($result = mysqli_query($connection, $select_query)) {
                                            if (mysqli_num_rows($result) > 0) {

                                                while ($row = mysqli_fetch_array($result)) {
                                                    $trip_id = $row['u_id'];
                                                    $trip_name = $row['u_name'];
                                                    echo "
                                <option value='$trip_id'>$trip_name</option>
                                ";
                                                }
                                            }
                                        }

                                        ?>
                                        <!-- End of SPIT PHP data here -->
                                    </select>
                                    <div id="checkbox_error_message" class="text-danger"></div>
                                </div>


                            </div>
                            <button type="submit" class="btn btn-primary pull-right" id="add-trip-btn"
                                    onclick="checkCheckboxStatus();triggerAddTrip()" onclose="checkCheckboxStatus()">Add Trip
                            </button>
                            <button type="submit" class="btn btn-success pull-right" id="update-trip-btn"
                                    onclick="checkCheckboxStatus();triggerUpdateTrip()" >Update Trip
                            </button>

                        </form>
                        <!--Form End-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade hide" id="alert_message">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h4 id="alert_message_content">Loading . . .</h4>
                    </div>
                </div>
            </div>
        </div>


    </div>


</div>
<!-- /.content-wrapper -->

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin.min.js"></script>

<!-- Demo scripts for this page-->
<script src="js/demo/datatables-demo.js"></script>
<script src="js/demo/chart-area-demo.js"></script>

</body>

</html>