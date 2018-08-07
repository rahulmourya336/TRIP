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
        #trip_image {
            height: 150px;
            width: 300px;
        }
        label.checkbox{
            width: 400px !important;
            margin-bottom: 0.2em!important;
        }
        .bg-white-text{
            color: #fff !important;
        }
        .bg-text-underline{
            text-decoration: underline;
        }
        .navbar-toggler-icon{

        }
    </style>
</head>
<nav class="navbar sticky-top navbar-toggleable-md bg-primary">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon bg-white-text"><strong> ≡ </strong></span>
    </button>
    <a class="navbar-brand bg-white-text" href="#" > TRIPP.</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">
        </ul>
        <ul class="navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link bg-white-text "><strong>Howdy!</strong> <?php echo $user.'  ' ?></a>
            </li>
            <li class="nav-item">
               <a class="nav-link bg-white-text bg-text-underline" href="logout.php">logout</a></span>
            </li>
        </ul>

    </div>
</nav>

<!--<div class="alert alert-dismissible fade show" role="alert" id='trip_status'>-->
<!--    <button type="button" class="close" data-dismiss="alert" aria-label="Close">-->
<!--        <span aria-hidden="true">&times;</span>-->
<!--    </button>-->
<!--</div>-->


<nav aria-label="breadcrumb sticky-top">
    <ol class="breadcrumb">
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-lg btn-primary btn-block col-md-5" style="margin: 0 auto;" data-toggle="modal" data-target="#myModal"
                onclick="clearForm();triggerAddTrip()">
            <strong>+ </strong>Add Trip
        </button>
    </ol>
</nav>


<!--</div>  End of id=addtrip of dashboard.html-->

<!-- Modal -->
<div id="myModal" class="modal fade " role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Trip Information</h4>
                <button type="button" class="close" data-dismiss="modal" onclick="refreshPage()">&times;</button>

            </div>
            <div class="modal-body">
                <!-- Form Start -->
                <form action="" method="POST" id="trip_form">
                    <div class="form-group row">
                        <label for="trip-name" class="col-sm-2 col-form-label">Trip Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="trip-name" placeholder="St. Lucia." required
                                   autofocus name="trip-name" maxlength="45"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="trip-url" class="col-sm-2 col-form-label">Trip URL</label>
                        <div class="col-sm-10">
                            <input type="url" class="form-control" id="trip-url" placeholder="http://someurl.com"
                                   required name="trip-url" oninput="showImages()" maxlength="400" />
                            <div id="unsplash_placeholder"></div>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="trip-starting-date" class="col-sm-2 col-form-label">Starting Date</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="trip-starting-date"
                                   placeholder="Select Trip Starting Date" required data-date-format="YYYY MM DD"
                                    name="trip-starting-date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="trip-ending-date" class="col-sm-2 col-form-label">Ending Date</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="trip-ending-date"
                                   placeholder="Select Trip Ending Date" required data-date-format="YYYY MM DD" name="trip-ending-date">

                            <div id="dateErrorMessage" class="text-danger"></div>
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
                                $select_query = "select u_id, u_name, u_email from trip_user WHERE u_id != '$current_user_id' ORDER by u_name ASC";
                                if ($result = mysqli_query($connection, $select_query)) {
                                    if (mysqli_num_rows($result) > 0) {

                                        while ($row = mysqli_fetch_array($result)) {
                                            $traveller_id = $row['u_id'];
                                            $traveller_name = $row['u_name'];
                                            $traveller_email = $row['u_email'];
                                            echo "
                                <option value='$traveller_id' title='$traveller_email'>$traveller_name</option>
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
                            onclick="return validateCombo(1);" onclose="return checkCheckboxStatus();" onmouseover="">Add Trip
                    </button>

                    <button type="submit" class="btn btn-success pull-right" id="update-trip-btn" onclick="return validateCombo()" >Update Trip</button>
                </form>
                <!--Form End-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal" onclick="refreshPage()">Close</button>
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

    today = new Date()
    date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()
    document.getElementById('trip-starting-date').value = date
    document.getElementById('trip-ending-date').value = date

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
    var memberList;

  function triggerAddTrip () {
    document.getElementById('trip_form').setAttribute('action', './add_trip.php')
    document.getElementById('add-trip-btn').style.display = 'block'
    document.getElementById('update-trip-btn').style.display = 'none'
    if (memberList !== undefined) {
      memberList.add()
    }
    console.log('In trigger add trip()')
  }

  function refreshPage(){
    url = window.location.href;
    if(url.split(/(\?)/) !== -1){
      url = url.split("?")[0]
      window.location.assign(url)
    }

  }

  function triggerUpdateTrip (trip_id) {
    url = './update_trip.php?id='
    id = trip_id
    trip_id = url.concat(id)
    document.getElementById('trip_form').setAttribute('action', trip_id)
    document.getElementById('add-trip-btn').style.display = 'none'
    document.getElementById('update-trip-btn').style.display = 'block'
    memberList = $('#member_list')
    $('#member_list').remove()
    form_action = document.querySelector('#trip_form').getAttribute('action')
    if (form_action.search('update') != -1) {
      a = document.querySelector('#trip_form').querySelector('#update-trip-btn')
      a.removeAttribute('onclick')
    }
  }

  function validateDate () {
    start_date = document.getElementById('trip-starting-date').value
    end_date = document.getElementById('trip-ending-date').value
    dateErrorBox = document.getElementById('dateErrorMessage')

    if (start_date > end_date) {
      console.log("error")
      dateErrorBox.innerHTML = 'Invalid Date'
      return false
    }
    else {
      console.log("Not error")
      dateErrorBox.innerHTML = ' '
      return true
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
    return;
  }

  function validateCombo (status) {
    dateFlag = validateDate()
    console.log("Date flag value: "+ dateFlag)
    if (status) {
      checkboxFlag = checkCheckboxStatus()
      resultFlag = checkboxFlag && dateFlag
      return resultFlag
    }
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
