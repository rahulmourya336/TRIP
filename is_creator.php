<?php
/**
 * Created by IntelliJ IDEA.
 * User: RadioactiveScript
 * Date: 8/2/2018
 * Time: 1:31 PM
 */

$creator_id = $_SESSION['current_user_id'];
$trip_id = $_GET['t_id'];
include ("connection.php");
$check_creator_sql = "select distinct trip_user.u_id,trip_list.t_creator_id from trip_user INNER JOIN trip_list where trip_user.u_id = $creator_id and trip_list.t_id = $trip_id";
$result = mysqli_query($connection, $check_creator_sql);
$result = mysqli_fetch_assoc($result);

if($result['u_id'] == $result['t_creator_id']){
    $is_creator = true;
}
else{
    $is_creator = false;
}
