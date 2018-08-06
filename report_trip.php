<?php

session_start();
$user = $_SESSION['current_user'];
$current_user_id = $_SESSION['current_user_id'];
include("check_session.php")
//include ('connection.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>.: TRIPP | Dashboard :.</title>
<?php include ("head_assets.html");?>
    <style>
        .bg-white-text{
            color: #fff !important;
        }
        .bg-text-underline{
            text-decoration: underline;
        }
        .nav-link:hover{
            color: #fff !important;
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

        .fade.in {
            opacity: 1;
        }

        .modal.in .modal-dialog {
            -webkit-transform: translate(0, 0);
            -o-transform: translate(0, 0);
            transform: translate(0, 0);
        }

        .modal-backdrop.in {
            opacity: 0.5;
        }

        .modal-backdrop.fade {
            opacity: 0;
            filter: alpha(opacity=0);
        }

        .modal-backdrop.fade.in {
            opacity: 0.4;
            filter: alpha(opacity=50);
        }

        /* Donut Chart Styles*/
        #chart {
            height: 400px;
        }

    </style>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/d3/4.2.2/d3.min.js'></script>
    <script>
      var total_data_JSON = []
      var individual_data_JSON = []

      function setJSON_total (JSONData) {
        total_data_JSON = JSONData
        console.log(total_data_JSON)
      }

      function setJSON_individual (JSONData) {
        individual_data_JSON = JSONData
        console.log(individual_data_JSON)
      }

    </script>
    <script>
      window.onload = function () {
        one = window.location.href
        status_prevent = one.search('t_id')
        status_success = one.search('SUCCESS')
        status_failed = one.search('ERROR')

        if (status_prevent === -1) {
          window.location.href = 'dashboard.php'
        }
        else if (status_success != -1) {
          document.getElementById('alert_message_content').classList.add('text-success')
          document.getElementById('alert_message_content').innerHTML = 'Expense Added '

        }
        else if (status_failed != -1) {
          /*document.getElementById('trip_status').classList.add('alert-danger')
          document.getElementById('trip_status').innerHTML += 'Error while adding'
        */
          document.getElementById('alert_message_content').classList.add('text-danger')
          document.getElementById('alert_message_content').innerHTML = 'Error while adding'
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
                <a class="nav-link bg-white-text" href="manage_trip.php?t_id=<?= $_GET['t_id'] ?>">Expense <span class="sr-only">(current)</span></a>
            </li>
            <?php
            include("is_creator.php");
            if ($is_creator === true) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="manage_travellers.php?t_id=<?= $_GET['t_id'] ?>"">Manage</a>
                </li>
                <?php
            }
            ?>
        </ul>
        <ul class="navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link bg-white-text "><?php echo $user.'  ' ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link bg-white-text" href="logout.php">logout</a>
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
        <a href="manage_travellers.php?t_id=<?= $_GET['t_id'] ?>"" id="manageTravellerLink">Manage Traveller</a>
        <?php
    }
    ?>
    <a href="manage_trip.php?t_id=<?= $_GET['t_id'] ?>">Add Expense</a>
    <a href="#" class="active">View Report</a>

</div>

<!-- Main Page content -->
<div class="main">
    <?php
    include("connection.php");
    $trip_id = $_GET['t_id'];
    $trip_name_sql = "select t_name from trip_list where t_id = $trip_id;";
    $trip_name = mysqli_query($connection, $trip_name_sql);
    $trip_name = mysqli_fetch_assoc($trip_name);
    $trip_name = $trip_name['t_name'];

    /* Individual trip expense */
    $count_individual_sql = "select sum(ex_amount) as total from trip_expenese where t_id  = $trip_id and u_id = $current_user_id;";
    $result_individual = mysqli_query($connection, $count_individual_sql);
    $result_individual = mysqli_fetch_assoc($result_individual);
    $total_expense_individual = $result_individual['total'];
    if ($result_individual > 0) {
        if ($result_individual['total'] === null) {
            $total_expense_individual = 0;
        }
    }

    /* Total trip expense */
    $count_total_sql = "select sum(ex_amount) as total from trip_expenese where t_id  = $trip_id;";
    $result = mysqli_query($connection, $count_total_sql);
    $result = mysqli_fetch_assoc($result);
    $total_expense = $result['total'];
    if ($result > 0) {
        if ($result['total'] === null) {
            $total_expense = 0;
        }
        echo "<div class=\"alert alert-dark\" role=\"alert\">
  Total trip expense of <span class='text-info'>$trip_name</span> is &#8377;<strong> $total_expense</strong>

  <small class='pull-right'>Your total expense is: &#8377; <span class='text-info'>$total_expense_individual</span></small>
</div>";
    } else {
        echo "Total trip count error";
        exit();
    }

    /*
      *
      * Total expense JSON prepare
      *
      */


    // Get name and expense
    $name_sql = "select * from trip_expenese where t_id = $trip_id";
    $expense_JSON = Array();
    $unique_list_JSON = Array();
    $single_list_JSON = Array();
    $result = mysqli_query($connection, $name_sql);
    if (mysqli_num_rows($result) > 0) {
//        $select_count_cid = "select count(c_id) as count_cid from trip_expenese where t_id = $trip_id";
//        $cid_count = mysqli_query($connection, $select_count_cid);
//        $cid_count = mysqli_fetch_assoc($cid_count);
//
//        echo $cid_count['count_cid'];
//        exit();

        while ($row = mysqli_fetch_array($result)) {
            $expense_name = $row['ex_name'];
            $expense_amount = $row['ex_amount'];
            $expense_date = $row['ex_date'];
            $ex_cat = $row['c_id'];
            $category_name_sql = "select distinct ex_name from trip_expense_category where ex_id = $ex_cat";
            $result_name_sql = mysqli_query($connection, $category_name_sql);
            $result_name_sql = mysqli_fetch_assoc($result_name_sql);
            $cat_name = "";
            if ($result_name_sql > 0) {
                echo "<script>console.log('%c Category found! ', 'background: white; color: Green');</script>";
                $cat_name = $result_name_sql['ex_name'];
            } else {
                echo "<script>console.log('%c Category error! ', 'background: white; color: Green');</script>";
                exit();
            }
            $expense_JSON[] = array('label' => $cat_name, 'value' => $expense_amount);
        }

        $array_length = count($expense_JSON);
        for ($i = 0; $i < $array_length - 1; $i++) {
            for ($j = 1; $j < $array_length; $j++) {
                if ($expense_JSON[$i]['label'] == $expense_JSON[$j]['label']) {
                    $sum = $expense_JSON[$i]['value'] + $expense_JSON[$j]['value'];
                    $unique_list_JSON[$i] = array('label' => $expense_JSON[$i]['label'], 'value' => $sum);
                } else {
                    $unique_list_JSON[$i] = $expense_JSON[$i];
                }
            }

        }
//        Stack overflow solution
        $individualSum = array_reduce($expense_JSON, function ($a, $b) {
            isset($a[$b['label']]) ? $a[$b['label']]['value'] += $b['value'] : $a[$b['label']] = $b;
            return $a;
        });
//        End of Stack overflow code
        $total_list = Array();
        foreach ($individualSum as $select) {
            $total_list[] = array('label' => $select['label'], 'value' => $select['value']);
        }
        $total_list = json_encode($total_list);
        echo "<script>setJSON_total($total_list)</script>";

    } else {
        echo "<span class='text-secondary'>Please add expenses to view report.</span>";
        exit();
    }

    /*
     *
     * Individual expense JSON prepare
     *
     */

    $individual_expense_JSON = Array();
    $select_individual_expense_sql = "select * from trip_expenese where t_id  = $trip_id and u_id = $current_user_id;";
    $result = mysqli_query($connection, $select_individual_expense_sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $expense_name = $row['ex_name'];
            $expense_amount = $row['ex_amount'];
            $expense_date = $row['ex_date'];
            $ex_cat = $row['c_id'];
            $category_name_sql_individual = "select distinct ex_name from trip_expense_category where ex_id = $ex_cat";
            $result_name_sql_individual = mysqli_query($connection, $category_name_sql_individual);
            $result_name_sql_individual = mysqli_fetch_assoc($result_name_sql_individual);
            $cat_name = "";
            if ($result_name_sql_individual > 0) {
                echo "<script>console.log('%c Category found! ', 'background: white; color: Green');</script>";
                $cat_name = $result_name_sql_individual['ex_name'];
            } else {
                echo "<script>console.log('%c Category error! ', 'background: white; color: Green');</script>";
                exit();
            }
            $individual_expense_JSON[] = array('label' => $cat_name, 'value' => $expense_amount);
        }

//        Stack overflow solution
        $individualSum = array_reduce($individual_expense_JSON, function ($a, $b) {
            isset($a[$b['label']]) ? $a[$b['label']]['value'] += $b['value'] : $a[$b['label']] = $b;
            return $a;
        });
//        End of Stack overflow code
        $single_list = Array();
        foreach ($individualSum as $select) {
            $single_list[] = array('label' => $select['label'], 'value' => $select['value']);
        }

        $single_list = json_encode($single_list);
        echo "<script>setJSON_individual($single_list)</script>";
    } else {

    }

    ?>
    <div class="row">
    <div class="col-md-5 text-center"> Total expense</div>
    <div class="col-md-2 text-center"></div>
    <div class="col-md-5 text-left">Individual Expense</div>
    </div>

    <div class="row">
        <div id="chart_total"></div>
        <div id="chart_individual"></div>
    </div>
</div>

</body>
<script type="text/javascript">
  $('#alert_message').modal('show')

  setTimeout(function () {
    $('#alert_message').modal('hide')
  }, 3000)
</script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script>
    window.onload = function () {
      Morris.Donut({
        element: 'chart_total',
        data: total_data_JSON
      })

      Morris.Donut({
        element: 'chart_individual',
        data: individual_data_JSON
      })

    }

</script>
<!-- End of Google Chart-->

<script src='js/sb-admin.js'></script>
</html>