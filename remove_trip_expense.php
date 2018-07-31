<?php
/**
 * Created by IntelliJ IDEA.
 * User: RadioactiveScript
 * Date: 7/31/2018
 * Time: 4:24 PM
 */

session_start();
include("connection.php");
include("check_session.php");
$trip_id = $_GET['t_id'];
$expense_id = $_GET['expense_id'];

$delete_trip_sql = "delete from trip_expenese where t_id = $trip_id and ex_id = $expense_id";
if(mysqli_query($connection, $delete_trip_sql)){
    header("Location: ./manage_trip.php?t_id=$trip_id&trip_remove=STATUS_OK");

}
else{
    header("Location: ./manage_trip.php?t_id=$trip_id&trip_remove=STATUS_ERROR");
}


