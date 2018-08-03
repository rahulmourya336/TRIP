<?php

session_start();
include("check_session.php");
$user = $_SESSION['current_user'];
$current_user_id = $_SESSION['current_user_id'];
$trip_id = $_GET['t_id'];
$TRIP_ADMIN = FALSE;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>.: TRIPP | Dashboard :.</title>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300'>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,700,300'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-2.x-git.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>

    <style>
        .bg-white-text{
            color: #fff !important;
        }
        .bg-text-underline{
            text-decoration: underline;
        }
        .sidenav {
            height: 100%;
            width: 220px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            padding-top: 20px;
        }

        .sidenav a {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 24px;
            color: #818181;
            display: block;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .main {
            margin-left: 225px; /* Same as the width of the sidenav */
            margin-top: 20px;
            font-size: 28px; /* Increased text to enable scrolling */
            padding: 0px 10px;
        }
        label.checkbox{
            width: 400px !important;
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
                width: 40px;
            }

            nav {
                z-index: 999;
            }

            .sidenav a {
                font-size: 12px;
            }
        }

        .active {
            color: #fff !important;
        }

        label {
            font-size: 20px !important;
        }
        .nav-link:hover{
            color: #fff !important;
        }
    </style>
    <script>
      window.onload = function () {
        one = window.location.href
        status_prevent = one.search('t_id')
        status_success = one.search('SUCCESS')
        status_failed = one.search('ERROR')
        traveller_remove_success = one.search('traveller_remove=STATUS_OK')
        traveller_remove_error = one.search('traveller_remove=STATUS_ERRO')

        if (status_prevent === -1) {
          window.location.href = 'dashboard.php'
        }
        else if (status_success != -1) {
          document.getElementById('alert_message_content').classList.add('text-success')
          document.getElementById('alert_message_content').innerHTML = 'Travellers Added '

        }
        else if (status_failed != -1) {
          /*document.getElementById('trip_status').classList.add('alert-danger')
          document.getElementById('trip_status').innerHTML += 'Error while adding'
        */
          document.getElementById('alert_message_content').classList.add('text-danger')
          document.getElementById('alert_message_content').innerHTML = 'Error while adding'
        }
        else if (traveller_remove_success != -1) {
          document.getElementById('alert_message_content').classList.add('text-success')
          document.getElementById('alert_message_content').innerHTML = 'Traveller list updated'
        }
        else if (traveller_remove_error != -1) {
          document.getElementById('alert_message').classList.add('text-danger')
          document.getElementById('alert_message_content').innerHTML = 'Error while updating'
        }
      }
      function checkCheckboxStatus(){
        check_status = document.querySelector(".multiselect-selected-text").innerText
        error_message_container = document.getElementById('checkbox_error_message')

        if(check_status.search("None") !== -1){
          error_message_container.innerHTML = "Select members";
          return false
        }
        else{
          error_message_container.innerHTML = check_status
          return true
        }
      }

      function validateCheckboxEmpty(){
        option = document.getElementById("multiple-checkboxes");
        if(option.querySelector("option") === null){
          error_message_container.innerHTML = "All members are in traveller list. ";
          return false
        }
      }

    </script>
</head>
<body>
<nav class="navbar navbar-toggleable-md navbar-light bg-faded p-2" style="background-color: #6200ea; z-index: 999">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="dashboard.php"></a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto ">
            <li class="nav-item ">
                <a class="nav-link" href="dashboard.php">Home </a>
            </li>
            <li class="nav-item active ">
                <a class="nav-link bg-white-text" href="#">Expense <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Manage</a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link bg-white-text" href="logout.php"><span class="bg-text-underline"><?php echo $user . '  ' ?></span>logout</a>
            </li>
        </ul>

    </div>
</nav>

<!-- Show trip info here -->
<div class="sidenav"><br/><br/>
    <?php
    include("is_creator.php");
    if ($is_creator === true) {
        ?>
        <a href="manage_travellers.php?t_id=<?= $_GET['t_id']?>" id="manageTravellerLink" class='active'>Manage
            Traveller</a>
        <?php
    }
    ?>
    <a href="manage_trip.php?t_id=<?= $_GET['t_id'] ?>">Add Expense</a>
    <a href="report_trip.php?t_id=<?= $_GET['t_id'] ?>">View Report</a>

</div>
<div class="main">
    <!-- Show travellers -->
    <?php
    include("connection.php");
    //    Total travellers count
    $select_travellers_count = "SELECT  DISTINCT  count(*) as total FROM trip_traveller where t_id=$trip_id";
    $result = mysqli_query($connection, $select_travellers_count);
    $result = mysqli_fetch_assoc($result);
    $total_count = $result['total'];

//    Get creator ID
    $select_creator_id = "select t_creator_id from trip_list where t_id = '$trip_id'";
    $result = mysqli_query($connection, $select_creator_id);
    $result = mysqli_fetch_assoc($result);
    $t_creator_id = $result['t_creator_id'];


    //    Fetch trip name
    $trip_name_sql = "select t_name from trip_list where t_id = $trip_id;";
    $trip_name = mysqli_query($connection, $trip_name_sql);
    $trip_name = mysqli_fetch_assoc($trip_name);
    $trip_name = $trip_name['t_name'];

    echo "<div class=\"alert alert-dark alert-success\" role=\"alert\">
  Traveller list in <span class='text-info'>$trip_name</span>.  <strong class='small pull-right' > $total_count travellers</strong>
</div>";
    ?>

    <div class="row">
        <!--    Trigger modal using button -->
        <button type="button" class="btn btn-info btn-circle btn-xl btn-block col-md-6"
                style="margin:0 auto;margin-bottom: 30px" data-toggle="modal" data-target="#myModal"><strong>+</strong> Add travellers
        </button>
    </div>
    <?php
    $select_travellers_sql = "SELECT  DISTINCT * FROM trip_traveller where t_id='$trip_id'";
        if ($result = mysqli_query($connection, $select_travellers_sql)) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $user_id = $row['u_id'];

                    //    Fetch user name
                    $user_name_sql = "select u_name from trip_user where u_id = '$user_id';";
                    $user_name = mysqli_query($connection, $user_name_sql);
                    $user_name = mysqli_fetch_assoc($user_name);
                    $user_name = $user_name['u_name'];

                    echo "<div class='container small'>
                <div class=\"alert alert-info col-md-4\">
                  <strong>$user_name</strong> ";
                    if ($t_creator_id !== $user_id) {
                        echo "<a href='remove_traveller.php?t_id=$trip_id&id=$user_id'>
                  <button type=\"button\" class=\"close\">
                    <span aria-hidden=\"true\">&times;</span>
                  </button>
                  </a>";
                    }
                    echo " 
                </div>
                </div> <!-- End of container-->
                ";
                }
            }
        } else {
            echo "<small>Add More travellers</small>";
        }

    ?>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade " role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add traveller for <?= $trip_name ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Form Start -->
                <form action="add_travellers.php?t_id=<?=$trip_id?>" method="POST" id="trip_form">
                    <div class="form-group row">
                        <label for="trip-name" class="col-sm-3 col-form-label">Trip Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control disabled" id="trip-name" placeholder="St. Lucia."
                                   name="trip-name" value="<?= $trip_name ?>" readonly/>
                        </div>
                    </div>
                    <div class="form-group row" id="member_list">
                        <label for="trip-member" class="col-sm-3 col-form-label">Select Members</label>
                        <div class="col-md-9" id="trip-member">
                            <select id="multiple-checkboxes" multiple="multiple" class=" lg_select_text_box"
                                    name="member[]" required>

                                <!-- PHP Code to SPIT data here -->
                                <?php
                                /* TODO :Combine two array and make associative array and list name in ascending order */

                                $trip_list = Array();
                                $trip_traveller_list = Array();

                                $select_query = "select u_id, u_name from trip_user";
                                if ($result = mysqli_query($connection, $select_query)) {
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_array($result)) {
                                            array_push($trip_list, $row['u_id']);
                                        }
                                    }
                                }

                                $select_query_traveller = "select u_id from trip_traveller WHERE t_id=$trip_id";
                                if ($result = mysqli_query($connection, $select_query_traveller)) {
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_array($result)) {
                                            array_push($trip_traveller_list, $row['u_id']);
                                        }
                                    }
                                }
                                // Removed matching elements
                                $trip_list = array_diff($trip_list, $trip_traveller_list);
                                print_r($trip_list);

                                foreach ($trip_list as $ts) {
                                    $select_query = "select u_id, u_name from trip_user WHERE u_id = '$ts'";
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
                                }


                                ?>
                                <!-- End of SPIT PHP data here -->
                            </select>
                            <div id="checkbox_error_message" class="text-danger"></div>
                        </div>


                    </div>
                    <button type="submit" class="btn btn-primary pull-right" id="add-trip-btn" onclick="checkCheckboxStatus();validateCheckboxEmpty()">Add Traveller</button>
                </form>
                <!--Form End-->
            </div>
            <div class="modal-footer">
                <!-- Spit temp modal data -->
                <?php

                echo "<br />";

                ?>
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Status modal -->
<div class="modal fade" id="alert_message">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h4 id="alert_message_content">Loading . . .</h4>
            </div>
        </div>
    </div>
</div>


</body>
<script type="text/javascript">
  $('#alert_message').modal('show')

  setTimeout(function () {
    $('#alert_message').modal('hide')
  }, 3000)
</script>
<script>
  $(document).ready(function () {
    $('#multiple-checkboxes').multiselect()
  })
</script>
<script src='js/sb-admin.js'></script>
</html>

