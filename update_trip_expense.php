<?php
/**
 * Created by IntelliJ IDEA.
 * User: RadioactiveScript
 * Date: 7/31/2018
 * Time: 6:56 PM
 */

session_start();
include("check_session.php");
include("connection.php");

$expense_id = $_GET['ex_id'];
$expense_category = $_POST['expense_category'];
$expense_name = $_POST['expense_name'];
$expense_date = $_POST['expense_date'];
$expense_amount = $_POST['expense_amount'];
$trip_id = mysqli_real_escape_string($connection, trim($_GET['t_id']));
$user_id = $_SESSION['current_user_id'];

$update_query = "UPDATE trip_expenese SET  t_id = '$trip_id', u_id = '$user_id', ex_name = '$expense_name', ex_date = '$expense_date', ex_amount = '$expense_amount' where ex_id = '$expense_id'";

//print($trip_id." ".$trip_name ." ". $trip_url ."". $trip_start_date."". $trip_end_date );


if (mysqli_query($connection, $update_query)){
    header("Location: ./manage_trip.php?t_id=$trip_id&flag=UPDATE_DONE");
} else {
    $_SESSION['trip_status'] = "error";
    header("Location: ./manage_trip.php?t_id=$trip_id&flag=UPDATE_ERROR");
}
