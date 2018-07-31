<?php
/**
 * Created by IntelliJ IDEA.
 * User: RadioactiveScript
 * Date: 7/13/2018
 * Time: 11:24 AM
 */
session_start();

$user = $_SESSION['current_user'];
$fileName = "logout.php";

if (isset($_SESSION["username"])) {
    include("connection.php");
    $username_ = $_SESSION["current_user"];
    $current_user_id = $_SESSION['current_user_id'];

    /* Select the list of trips created */
    $select_list_query = "select * from trip_list INNER JOIN trip_traveller where trip_list.t_creator_id = $current_user_id and trip_traveller.u_id = $current_user_id";
    $result = mysqli_query($connection, $select_list_query);
    $index = mysqli_fetch_assoc($result);    // Trip details

    $trip_name = $index['t_name'];
    $trip_url = $index['t_url'];
    $trip_start_date = $index['t_start_date'];
    $trip_end_date = $index['t_end_date'];
    $trip_creator_id = $index['t_creator_id'];

    /* Get total trip count */
    $total_trip_count_query = "select count(*) as count from trip_list INNER JOIN trip_traveller where trip_list.t_creator_id = $current_user_id and trip_traveller.u_id = $current_user_id";
    $trip_count_query_result = mysqli_query($connection, $total_trip_count_query);
    $trip_count = mysqli_fetch_assoc($trip_count_query_result);
    $trip_count = $trip_count["count"];         // Got the total trip count

    include("dashboard_ui.php");


    $sql = "SELECT * FROM trip_list";
    echo "<div class='container'>";
    echo "<div >";
    echo "<div class='row col-md-12'>";
    echo "<div class=\"card-group \">";
    if ($result = mysqli_query($connection, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $trip_id = $row['t_id'];
                $trip_name = $row['t_name'];
                $trip_url = $row['t_url'];
                $trip_start_date = $row['t_start_date'];
                $trip_end_date = $row['t_end_date'];
                $trip_creator_id = $row['t_creator_id'];
                /*
                 * Fetch name based upon t_creator_id
                 * */
                $sql_trip_creator_name = "select distinct u_name from trip_user INNER JOIN trip_list where trip_user.u_id = '$trip_creator_id';";

                $sql_result = mysqli_query($connection, $sql_trip_creator_name);
                $user = mysqli_fetch_array($sql_result);

                $trip_creator_name = $user['u_name'];


                echo " <div class=\"card \" id='_$trip_id'>
                ";
                echo "
                 
        <img class=\"card-img-top img-fluid \" src=\"$trip_url\" alt=\"$trip_name\" id='trip_image'>
        <div class=\"card-body\">
            <h5 class=\"card-title\">$trip_name</h5>
            <p id='start_date'>
                Starting date: $trip_start_date</p> 
                <p id='end_date'>Ending date:  $trip_end_date
            </p>
        </div>
        <div class=\"card-footer\">
            <small class=\"text-muted\">Trip created by: $trip_creator_name : $trip_creator_id </small>
        </div>
        <div class=\"dropup\" id='trip-action-button'>
    <button class=\"btn btn-info dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">Action
            <span class=\"glyphicon glyphicon-pencil\"></span>
        <span class=\"caret\"></span></button>
    <ul class=\"dropdown-menu\" >
        <li class=\"dropdown-item\">
        <button type=\"button\" class=\"btn btn-link\" data-toggle=\"modal\" data-target=\"#myModal\" onclick='triggerUpdateTrip($trip_id);populate($trip_id);' id='trip-edit-link'>Edit Trip</button></li>
         <div class=\"dropdown-divider\"></div>
  <a class=\"dropdown-item\" href=\"#\"></a>
        <li class=\"dropdown-item\"><a href=\"remove_trip.php?remove=$trip_id\" class='text-danger p-2' name='delete' id='trip-remove-link'>Delete</a></li>
    </ul>
</div>";
                $current_user_id = $_SESSION['current_user_id'];
                if ($current_user_id != $trip_creator_id) {
                    echo "
                    <script>ToggleLink(true,$trip_id);</script>";
                } else {
                    echo "<a href='manage_trip.php?t_id=$trip_id' ><button type=\"button\" class=\"btn btn-default btn-sm\"> Manage </button></a>";
                }

                echo "</div><!-- End of card-group -->";
            }

            // Free result set
            mysqli_free_result($result);
        }
    }
    echo "

</div> <!-- End of card group -->
</div> <!-- End of Col-md-5 -->
</div> <!-- End of container-->
</div><!--- End of main container -->
           
";

} else {
    header("Location: ./signin.php?flag=loginfirst");
}