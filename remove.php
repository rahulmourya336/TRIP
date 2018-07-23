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

    if ($_GET['remove']) {
        $object_id = $_GET['remove'];

        /* Only creator can update and delete the TRIP information - [Validate]*/
        $sql_trip_creator = "select distinct t_id from trip_user INNER JOIN trip_list where trip_user.u_id = '$trip_creator_id';";

        $sql_result = mysqli_query($connection, $sql_trip_creator);
        $user = mysqli_fetch_array($sql_result);

        $trip_creator_name = $user['u_name'];


    } else {
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    }
} else {
    header("Location: ./signin.php?flag=loginfirst");
}