<?php
/**
 * Created by IntelliJ IDEA.
 * User: RadioactiveScript
 * Date: 7/18/2018
 * Time: 6:02 PM
 */
session_start();
include("connection.php");
include("check_session.php");

@$trip_name = $_POST['trip-name'];
@$trip_url = $_POST['trip-url'];
@$trip_start_date = $_POST['trip-starting-date'];
@$trip_end_date = $_POST['trip-ending-date'];

$user_email = $_SESSION['username'];
$creator_id_sql = "select u_id from trip_user WHERE u_email = '$user_email'";

$sql_result = mysqli_query($connection, $creator_id_sql);
$user = mysqli_fetch_assoc($sql_result);

$trip_creator_id = $user['u_id'];

$add_trip_query = "INSERT INTO trip_list (t_url, t_name, t_start_date, t_end_date, t_creator_id) VALUES ('$trip_url', '$trip_name', '$trip_start_date', '$trip_end_date', '$trip_creator_id')";

$add_trip_result = mysqli_query($connection, $add_trip_query);
$last_trip_id = mysqli_insert_id($connection);

include("add_travellers.php");

if ($add_trip_result && $sql_insert_traveller_query) {
    header("Location: ./dashboard.php?flag=success");
} else {
    $_SESSION['trip_status'] = "error";
    header("Location: ./dashboard.php?flag=error");
}