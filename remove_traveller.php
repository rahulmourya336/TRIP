<?php
/**
 * Created by IntelliJ IDEA.
 * User: RadioactiveScript
 * Date: 8/2/2018
 * Time: 11:22 PM
 */

session_start();
include("connection.php");
include("check_session.php");
$trip_id = $_GET['t_id'];

if (isset($_GET['t_id']) && isset($_GET['id'])) {
    $u_id = $_GET['id'];
    $delete_traveller_query = "delete from trip_traveller where t_id = '$trip_id' and u_id = '$u_id'";
    if(mysqli_query($connection, $delete_traveller_query)){
        header("Location: ./manage_travellers.php?t_id=$trip_id&traveller_remove=STATUS_OK");
    }
    else{
        header("Location: ./manage_travellers.php?t_id=$trip_id&traveller_remove=STATUS_ERRO");
    }
} else {
    header("Location: ./manage_travellers.php?t_id=$trip_id&traveller_remove=STATUS_ERRO");
}