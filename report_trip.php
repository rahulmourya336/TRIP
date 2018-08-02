<?php

session_start();
$user = $_SESSION['current_user'];
include ("check_session.php");
//include ('connection.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>.: TRIPP | Dashboard :.</title>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300'>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,700,300'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin.css" rel="stylesheet">


    <style>
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
        .pie {
            margin: 20px;
        }

        .pie text {
            font-family: "Verdana";
            fill: #888;
        }

        .pie .name-text {
            font-size: 1em;
        }

        .pie .value-text {
            font-size: 3em;
        }
    </style>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/d3/4.2.2/d3.min.js'></script>
    <script>
      var data = []

      function setJSON (JSONData) {
        data = JSONData
        console.log(data)
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
<nav class="navbar navbar-toggleable-md navbar-light bg-faded p-2" style="background-color: #E1E1E1; z-index: 999">
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
            <li class="nav-item active">
                <a class="nav-link" href="#">Expense <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Manage</a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link " href="logout.php"><span class="text-primary"><?php echo $user . '  ' ?></span>logout</a>
            </li>
        </ul>

    </div>
</nav>

<!-- Show trip info here -->
<div class="sidenav"><br/><br/>
    <a href="#">Manage Traveller</a>
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
</div>";
    } else {
        echo "Total trip count error";
        exit();
    }

    //    Create Dounut char for categorie of expense

    // Get name and expense
    $name_sql = "select * from trip_expenese where t_id = $trip_id";
    $expense_JSON = Array();
    $result = mysqli_query($connection, $name_sql);
    if (mysqli_num_rows($result) > 0) {
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
            $expense_JSON[] = array('name' => $cat_name, 'value' => $expense_amount);
        }
        $expense_JSON = json_encode($expense_JSON);
        echo "<script>setJSON($expense_JSON)</script>";
    } else {
        echo "<span class='text-secondary'>Please add expenses to view report.</span>";
        exit();
    }
    ?>


    <div id="chart"></div>
</div>

</body>
<script type="text/javascript">
  $('#alert_message').modal('show')

  setTimeout(function () {
    $('#alert_message').modal('hide')
  }, 3000)
</script>

<!-- Donut chart Script -->
<script>
  var text = 'Expense'

  var width = 480
  var height = 460
  var thickness = 50
  var duration = 750

  var radius = Math.min(width, height) / 2
  var color = d3.scaleOrdinal(d3.schemeCategory10)

  var svg = d3.select('#chart').append('svg').attr('class', 'pie').attr('width', width).attr('height', height)

  var g = svg.append('g').attr('transform', 'translate(' + width / 2 + ',' + height / 2 + ')')

  var arc = d3.arc().innerRadius(radius - thickness).outerRadius(radius)

  var pie = d3.pie().value(function (d) {
    return d.value
  }).sort(null)

  var path = g.selectAll('path').data(pie(data)).enter().append('g').on('mouseover', function (d) {
    let g = d3.select(this).style('cursor', 'pointer').style('fill', 'black').append('g').attr('class', 'text-group')

    g.append('text').
      attr('class', 'name-text').
      text(`${d.data.name}`).
      attr('text-anchor', 'middle').
      attr('dy', '-1.2em')

    g.append('text').
      attr('class', 'value-text').
      text(`${d.data.value}`).
      attr('text-anchor', 'middle').
      attr('dy', '.9em')
  }).on('mouseout', function (d) {
    d3.select(this).style('cursor', 'none').style('fill', color(this._current)).select('.text-group').remove()
  }).append('path').attr('d', arc).attr('fill', (d, i) = > color(i)
  )
  .on('mouseover', function (d) {
    d3.select(this).style('cursor', 'pointer').style('fill', 'black')
  }).on('mouseout', function (d) {
    d3.select(this).style('cursor', 'none').style('fill', color(this._current))
  }).each(function (d, i) {
    this._current = i
  })

  g.append('text').attr('text-anchor', 'middle').attr('dy', '.3em').text(text)

</script>
<!-- end of dounut chart-->

<script src='js/sb-admin.js'></script>
</html>