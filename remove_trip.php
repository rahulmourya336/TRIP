<?php
/**
 * Created by IntelliJ IDEA.
 * User: RadioactiveScript
 * Date: 7/23/2018
 * Time: 10:53 AM
 */

session_start();
$user = $_SESSION['current_user'];
if (isset($_SESSION["username"])) {
    include("connection.php");

    if ($_GET['remove']) {
        $object_id = $_GET['remove'];
        $trip_creator_id = $_SESSION['current_user_id'];
        /* Only creator can update and delete the TRIP information - [Validate]*/
        $sql_trip_creator = "select distinct t_creator_id from trip_list where t_id = '$object_id'";

        $sql_result = mysqli_query($connection, $sql_trip_creator);
        $user = mysqli_fetch_array($sql_result);
        if (!$user == 0) {
            if ($user['t_creator_id'] == $trip_creator_id) {
                $sql_delete_trip = "DELETE FROM trip_list WHERE t_id='$object_id'";
                mysqli_query($connection, $sql_delete_trip);
                header("Location: dashboard.php?trip_remove=STATUS_OK");
            } else {
                header("Location: dashboard.php?trip_remove=STATUS_NOT_ADMIN");
            }
        } else {
            header("Location: dashboard.php?trip_remove=STATUS_ERROR");
        }

    } else {
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    }
} else {
    header("Location: ./signin.php?flag=loginfirst");
}