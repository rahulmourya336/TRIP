<?php
/**
 * Created by IntelliJ IDEA.
 * User: RadioactiveScript
 * Date: 7/23/2018
 * Time: 11:51 AM
 */


session_start();
$user = $_SESSION['current_user'];
if (isset($_SESSION["username"])) {
    include("connection.php");
    $object_id = $_GET['edit'];

    $sql_select_query = "SELECT * FROM trip_list where t_id = '$object_id';";
    $sql_result = mysqli_query($connection, $sql_select_query);
    $user = mysqli_fetch_assoc($sql_result);

    $t_name = $user['t_name'];
    $t_url = $user['t_url'];
    $t_start_date = $user['t_start_date'];
    $t_end_date = $user['t_end_date'];



} else {
    header("Location: ./signin.php?flag=loginfirst");
}