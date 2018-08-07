<?php

session_start();
include ("check_session.php");
$user = $_SESSION['current_user'];
$trip_id = $_GET['t_id'];

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

    </style>
    <script>
      window.onload = function () {
        one = window.location.href
        status_prevent = one.search('t_id')
        status_success = one.search('SUCCESS')
        status_failed = one.search('ERROR')
        trip_expense_remove_success = one.search('trip_remove=STATUS_OK')
        trip_expense_remove_error = one.search('trip_remove=STATUS_ERRO')
        trip_expense_update_success = one.search('flag=UPDATE_DONE')
        trip_expense_update_error = one.search('flag=UPDATE_ERROR')
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
        else if (trip_expense_remove_success != -1) {
          document.getElementById('alert_message_content').classList.add('text-success')
          document.getElementById('alert_message_content').innerHTML = 'Expense removed successfully'
        }
        else if (trip_expense_remove_error != -1) {
          document.getElementById('alert_message').classList.add('text-danger')
          document.getElementById('alert_message_content').innerHTML = 'Error while removing'
        }
        else if (trip_expense_update_success != -1) {
          document.getElementById('alert_message_content').classList.add('text-success')
          document.getElementById('alert_message_content').innerHTML = 'Expense Updated'
        }
        else if (trip_expense_update_error != -1) {
          document.getElementById('alert_message_content').classList.add('text-danger')
          document.getElementById('alert_message_content').innerHTML = 'Unable to update expense'
        }

      }

      function populate_expense (trip_expense_id) {
        dummy_trip_id = '#_' + trip_expense_id
        query = document.querySelector(dummy_trip_id)
        console.log(dummy_trip_id)

        expense_name = query.querySelector('#__expense_name').innerHTML.trim()
        expense_category = query.querySelector('#__expense_category').getAttribute('name')
        expense_date = query.querySelector('#__expense_date').innerHTML.trim()
        expense_amount = query.querySelector('#__expense_amount').innerHTML.trim().split(' ')[1]

        expense_date = expense_date.trim()

        console.log(expense_name, expense_category, expense_date, expense_amount)

        /* Populating the data */
        document.getElementById('expense_name').value = expense_name
        document.getElementById('expense_category').value = expense_category
        document.getElementById('expense_date').value = expense_date
        document.getElementById('expense_amount').value = expense_amount
      }

      function triggerAddExpense () {
        document.getElementById('expense_form').setAttribute('action', './add_expense.php?t_id=<?=$trip_id?>')

        document.getElementById('add-expense-btn').style.display = 'block'
        document.getElementById('update-expense-btn').style.display = 'none'
        console.log('In trigger add trip()')
      }

      function triggerUpdateExpense (trip_expense_id) {
        url = './update_trip_expense.php?t_id=<?=$trip_id ?>&ex_id='
        id = trip_expense_id
        trip_expense_id = url.concat(id)
        console.log(trip_expense_id)
        document.getElementById('expense_form').setAttribute('action', trip_expense_id)

        document.getElementById('add-expense-btn').style.display = 'none'
        document.getElementById('update-expense-btn').style.display = 'block'
      }

      function clearForm () {
        document.getElementById('expense_form').reset()
        return true
      }

      function validateForm(){
            var x = document.getElementById("expense_amount").value
        if(x.length > 10){
                document.getElementById("amount_error").innerHTML = "Should be less than 10 digit"
          return false
        }
      }

      function validateDate(){

        now = new Date()

        day = ('0' + now.getDate()).slice(-2)
        month = ('0' + (now.getMonth() + 1)).slice(-2)
        today_ = now.getFullYear()+ '-' + (month) + '-' + (day)

        element = document.getElementById('expense_date')
        start_date = element.getAttribute('aria-valuemin')
        end_date = element.getAttribute('aria-valuemax')
        current_date = $('#expense_date').html($('#expense_date').val())

        console.log(current_date)

        if (current_date >= start_date && current_date <= end_date) {
          document.getElementById('dateErrorMessage').innerHTML = 'Add values between ' + start_date + ' to ' + end_date
          return false
        }
        else {
          document.getElementById('dateErrorMessage').innerHTML = ''
          return true
        }
      }
    </script>
</head>
<body>
<nav class="navbar navbar-toggleable-md navbar-light bg-faded p-2" style="background-color: #6200ea; z-index: 999">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" ariacontrols="navbarSupportedContent" aria-expanded="false"
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
                <a class="nav-link bg-white-text" href="logout.php"><span class="bg-text-underline">logout</a>
            </li>
        </ul>

    </div>
</nav>

<!-- Show trip info here -->
<div class="sidenav"><br/><br/>
    <?php
    include("is_creator.php");
    if($is_creator === true){
        ?>
        <a href="manage_travellers.php?t_id=<?= $_GET['t_id'] ?>" id="manageTravellerLink">Manage Traveller</a>
    <?php
    }
    ?>

    <a href="#" class="active">Add Expense</a>
    <a href="report_trip.php?t_id=<?= $_GET['t_id'] ?>">View Report</a>

</div>

<!-- Main Page content -->
<div class="main">
    <!-- Add new expense button-->
    <!--    Onclick open modal for form -->
    <div class="row">
        <div class="col-xl-3 col-sm-6" onclick='clearForm();triggerAddExpense()'>
            <!-- Trigger the modal with a button -->
            <a href="#" data-toggle="modal" data-target="#myModal">
                <div class="card text-white bg-light o-hidden">
                    <div class="card-body">
                        <div><h1 class="display-1 text-center text-primary">+</h1></div>
                    </div>
                </div>
            </a>
        </div>
        <!--        iterate this card for new expense -->
        <?php
//        Get trip start and end date
        $select_expense_date_sql = "select t_start_date, t_end_date from trip_list where t_id='$trip_id'";
        $date_result = mysqli_query($connection, $select_expense_date_sql);
        $date_result = mysqli_fetch_assoc($date_result);
        $start_date  = $date_result['t_start_date'];
        $end_date    = $date_result['t_end_date'];

        include('connection.php');
        $trip_id = $_GET['t_id'];
        $current_user_id = $_SESSION['current_user_id'];
        $select_expense_sql = "select * from trip_expenese where u_id = $current_user_id and t_id = $trip_id ORDER BY ex_id DESC";
        if ($result = mysqli_query($connection, $select_expense_sql)) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $expense_id = $row['ex_id'];
                    $expense_name = $row['ex_name'];
                    $expense_amount = $row['ex_amount'];
                    $expense_date = $row['ex_date'];
                    $ex_cat = $row['c_id'];
                    $category_name_sql = "select distinct ex_name,ex_id from trip_expense_category where ex_id = $ex_cat";
                    $result_name_sql = mysqli_query($connection, $category_name_sql);
                    $result_name_sql = mysqli_fetch_assoc($result_name_sql);
                    $cat_name = "";
                    $cat_id = $result_name_sql['ex_id'];
                    if ($result_name_sql > 0) {
                        echo "<script>console.log('%c Category found! ', 'background: white; color: Green');</script>";
                        $cat_name = $result_name_sql['ex_name'];
                    } else {
                        echo "<script>console.log('%c Category error! ', 'background: white; color: Green');</script>";
                        exit();
                    }
                    echo "
<div class=\"col-xl-3 col-sm-6 mb-2\" id='_$expense_id'>
            <div class=\"card text-white bg-warning o-hidden h-100\">

                <div class=\"card-body\">
                            <a href='./remove_trip_expense.php?t_id=$trip_id&expense_id=$expense_id'><button type=\"submit\" class=\"close btn\" aria-label=\"Close\">
  <span aria-hidden=\"true\" >&times;</span>
</button></a>
<a href=\"#\" data-toggle=\"modal\" data-target=\"#myModal\" class='small' onclick='populate_expense($expense_id);triggerUpdateExpense($expense_id)' >Edit</a>                           
                    <!--<div class=\"card-body-icon\" style='z-index: 0;'>
                        <i class=\"fas fa-fw fa-list\"></i>
                    </div>-->
                    <div class=\"mr-5\" id='__expense_name'>$expense_name </div><div  id='__expense_category' name='$cat_id'><h6>$cat_name</h6></div>
                    
                </div>
                <a class=\"card-footer text-white clearfix small z-1\" href=\"#\">
                    <span class=\"float-left\" id=\"__expense_date\">$expense_date</span>
                    <span class=\"float-right\" id='__expense_amount'>&#8377; $expense_amount </span>
                </a>
            </div>
        </div>";
                }
            }
        }
        ?>
    </div>


    <!-- Modal -->
    <div class="modal" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- Form Start -->
                    <form action="" method="POST" id="expense_form">
                        <div class="form-group row" id="member_list">
                            <label for="trip-member" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-md-10" id="trip-member">
                                <select name="expense_category" required class="form-control" id="expense_category">

                                    <!-- PHP Code to SPIT data here -->
                                    <?php
                                    session_start();
                                    include("connection.php");
                                    $current_user_id = $_SESSION['current_user_id'];
                                    $expense_query = "SELECT * FROM trip_expense_category";
                                    if ($result = mysqli_query($connection, $expense_query)) {
                                        if (mysqli_num_rows($result) > 0) {

                                            while ($row = mysqli_fetch_array($result)) {
                                                $expense_id = $row['ex_id'];
                                                $expense_name = $row['ex_name'];
                                                echo "
                                <option value='$expense_id' style='font-size: 18px;'>$expense_name</option>
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
                        <div class="form-group row">
                            <label for="expense_name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="expense_name" placeholder="Dinner" required
                                       autofocus name="expense_name" maxlength="45"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="expense_date" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="expense_date"
                                       placeholder="Select Trip Starting Date" required name="expense_date" aria-valuemin="<?=$start_date ?>" aria-valuemax="<?=$end_date ?>">
                                <h6 id="dateErrorMessage" class="text-danger small" style="font-size: 1.2rem"></h6>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="expense_amount" class="col-sm-2 col-form-label">Amount</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="expense_amount" placeholder="2000"
                                       required name="expense_amount">
                                <h6 id="amount_error" class="text-danger small"></h6>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary pull-right" id="add-expense-btn" onclick="return validateDate()">Add Expense
                        </button>
                        <button type="submit" class="btn btn-success pull-right" id="update-expense-btn" onclick="return validateDate()">Update Expense
                        </button>
                    </form>
                    <!--Form End-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div><!--    End of expense modal-->
</div><!-- End of Main Page content -->

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


<script type="text/javascript">

  $('#alert_message').modal('show')

  setTimeout(function () {
    $('#alert_message').modal('hide')
  }, 3000)

  var today = new Date();
  var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
  document.getElementById('expense_date').value = date;
</script>
<script src="js/sb-admin.js"></script>

</body>
</html>
