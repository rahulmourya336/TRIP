<?php
/**
 * Created by IntelliJ IDEA.
 * User: RadioactiveScript
 * Date: 7/25/2018
 * Time: 3:51 PM
 */
session_start();
include("check_session.php");
include("connection.php");

@$trip_id = $_GET['id'];
@$trip_name = $_POST['trip-name'];
@$trip_url = $_POST['trip-url'];
@$trip_start_date = $_POST['trip-starting-date'];
@$trip_end_date = $_POST['trip-ending-date'];

$update_query = "UPDATE trip_list SET t_url = '$trip_url', t  _name = '$trip_name', t_start_date = '$trip_start_date', t_end_date = '$trip_end_date'  where t_id = '$trip_id'";

//print($trip_id." ".$trip_name ." ". $trip_url ."". $trip_start_date."". $trip_end_date );


if (mysqli_query($connection, $update_query)){
header("Location: ./dashboard.php?flag=UPDATE_DONE");
} else {
    $_SESSION['trip_status'] = "error";
    header("Location: ./dashboard.php?flag=UPDATE_ERROR");
}
