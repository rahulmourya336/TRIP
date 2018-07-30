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
<nav class="navbar navbar-toggleable-md navbar-light bg-faded" style="background-color: #E1E1E1;">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">TRIPP.</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto ">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="manage_trip.php">Expense</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">contact</a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link " href="logout.php"><span class="text-primary"><?php echo $user.'  ' ?></span>logout</a>
            </li>
        </ul>

    </div>
</nav>

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

<script type="text/javascript">
  $('#alert_message').modal('show')

  setTimeout(function () {
    $('#alert_message').modal('hide')
  }, 3000)
</script>

<script type="text/javascript">

  $(document).ready(function () {
    $('#multiple-checkboxes').multiselect()
  })
  window.onload = function () {

    $('trip_status').hide()

    var dateControl = document.querySelector('input[type="date"]')
    dateControl.value = '2017-06-01'

    one = window.location.href
    status_success = one.search('success')
    status_failed = one.search('error')
    trip_remove_success = one.search('trip_remove=STATUS_OK')
    trip_remove_error = one.search('trip_remove=STATUS_ERRO')
    trip_remove_admin_error = one.search('trip_remove=STATUS_NOT_ADMIN')
    trip_update_success = one.search('flag=UPDATE_DONE')
    trip_update_error = one.search('flag=UPDATE_ERROR')

    if (status_success != -1) {
      document.getElementById('alert_message_content').classList.add('text-success')
      document.getElementById('alert_message_content').innerHTML = 'Trip Added '

    }
    else if (status_failed != -1) {
      /*document.getElementById('trip_status').classList.add('alert-danger')
      document.getElementById('trip_status').innerHTML += 'Error while adding'
    */
      document.getElementById('alert_message_content').classList.add('text-danger')
      document.getElementById('alert_message_content').innerHTML = 'Error while adding'
    }
    else if (trip_remove_success != -1) {
      document.getElementById('alert_message_content').classList.add('text-success')
      document.getElementById('alert_message_content').innerHTML = 'Trip removed successfully'
    }
    else if (trip_remove_error != -1) {
      document.getElementById('alert_message').classList.add('text-danger')
      document.getElementById('alert_message_content').innerHTML = 'Error while removing'
    }
    else if (trip_remove_admin_error != -1) {
      document.getElementById('alert_message_content').classList.add('text-danger')
      document.getElementById('alert_message_content').innerHTML = 'Only creator can remove the trip(s)'
    }
    else if (trip_update_success != -1) {
      document.getElementById('alert_message_content').classList.add('text-success')
      document.getElementById('alert_message_content').innerHTML = 'Trip Updated'
    }
    else if (trip_update_error != -1) {
      document.getElementById('alert_message_content').classList.add('text-danger')
      document.getElementById('alert_message_content').innerHTML = 'Unable to update trip'
    }
    else {
      $('#trip_status').hide()
    }
  }

  function populate (trip_id) {
    dummy_trip_id = '#_' + trip_id
    date_query = document.querySelector(dummy_trip_id)
    query = document.querySelector(dummy_trip_id).querySelector('img#trip_image')
    trip_name = query.getAttribute('alt')
    trip_url = query.getAttribute('src')
    trip_start_date = date_query.querySelector('#start_date').innerText
    trip_end_date = date_query.querySelector('#end_date').innerText

    start_date = trip_start_date.slice(trip_start_date.search(':') + 1)
    start_date = start_date.trim()

    end_date = trip_end_date.slice(trip_end_date.search(':') + 1)
    end_date = end_date.trim()

    console.log(trip_name, trip_url, start_date, end_date)

    /* Populating the data */
    document.getElementById('trip-name').value = trip_name
    document.getElementById('trip-url').value = trip_url
    document.getElementById('trip-starting-date').value = start_date
    document.getElementById('trip-ending-date').value = end_date
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

  function triggerAddTrip () {
    document.getElementById('trip_form').setAttribute('action', './add_trip.php')
    document.getElementById('add-trip-btn').style.display = 'block'
    document.getElementById('update-trip-btn').style.display = 'none'
    $("#member_list").show()
    console.log('In trigger add trip()')
  }

  function triggerUpdateTrip (trip_id) {
    url = './update_trip.php?id='
    id = trip_id
    trip_id = url.concat(id)
    document.getElementById('trip_form').setAttribute('action', trip_id)
    document.getElementById('add-trip-btn').style.display = 'none'
    document.getElementById('update-trip-btn').style.display = 'block'
    $("#member_list").hide()
    form_action = document.querySelector('#trip_form').getAttribute('action')
    if (form_action.search('update') != -1) {
      a = document.querySelector('#trip_form').querySelector('#update-trip-btn')
      a.removeAttribute('onclick')
    }

  }

  function clearForm () {
    document.getElementById('trip_form').reset()
    return true
  }

  function ToggleLink (status, trip_id) {
    if (status) {
      dummy_trip_id = '#_' + trip_id
      query = document.querySelector(dummy_trip_id).querySelector('#trip-action-button')
      query.style.display = 'none'
    }
  }

  function doubleClick (id, name) {
    console.log('Trip id' + id + 'Trip Name' + name)
    alert()
  }

  function showImages () {
  //    var a = ''
  //    a += document.getElementById('trip-url').value
  //    if (a.length == 0) {
  //    node = document.getElementById('unsplash_placeholder')
  //      if(node.childElementCount > 0){
  //        while (node.hasChildNodes()) {
  //          node.removeChild(node.lastChild);
  //      }
  //      }
  //    }
  //
  //    API_URL = 'https://api.unsplash.com/search/photos/?client_id=e52ce48ac3e7d6834829e06e94030fea3d98dc7ed671bc9bdd519c66bfdc63fa&query='
  //    API_URL = API_URL.concat(a)
  //
  //    if (true) {
  //      xmlhttp = new XMLHttpRequest()
  //      xmlhttp.onreadystatechange = function () {
  //        if (this.readyState == 4 && this.status == 200) {
  //          json_reponse = this.responseText
  //          json_reponse = JSON.parse(json_reponse)
  //          var thumb_img = []
  //          var json_length = json_reponse.results.length
  //          while (json_length > 0) {
  //            thumb_img.push(json_reponse.results[json_length - 1].urls.thumb)
  //            json_length--
  //          }
  //
  //           for (i in thumb_img){
  //          var element = document.createElement('img')
  //          document.getElementById('unsplash_placeholder').appendChild(element)
  //          element.setAttribute('src', thumb_img[1])
  //          //element.setAttribute('id', "-".concat(i))
  //          //element.setAttribute('height', '100px')
  //          //element.setAttribute('width', '100px')
  //             console.log(i)
  //          element.classList.add('img')
  //          }
  //          console.log(thumb_img)
  //        }
  //
  //      }
  //      xmlhttp.open('GET', API_URL, true)
  //      xmlhttp.send()
  //    } else {
  //      xmlhttp = new ActiveXObject('Microsoft.XMLHTTP')
  //    }
  //
  }
</script>
