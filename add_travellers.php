<?php
/**
 * Created by IntelliJ IDEA.
 * User: RadioactiveScript
 * Date: 7/28/2018
 * Time: 9:15 PM
 */
/*  Add travellers to table */
$member_list = array();
if (empty($_GET['t_id'])) {


    if (!empty($_POST['member'])) {
        foreach ($_POST['member'] as $check) {
            array_push($member_list, $check);
        }
        $current_user_id = $_SESSION['current_user_id'];
        array_push($member_list, $current_user_id);
        print_r($member_list);

    } else {
        echo "<h2>Error in checkboxes @line " . __LINE__ . "</h2>";
        exit();
    }

// Get last trip_id from database
    $sql_insert_traveller_query = "";
    echo "Last trip id" . $last_trip_id;
    $_SESSION['last_trip_id'] = $last_trip_id;

    foreach ($member_list as $members) {
        $sql_insert_traveller_query = "INSERT INTO trip_traveller(t_id, u_id) VALUES ('$last_trip_id', '$members')";
        if (mysqli_query($connection, $sql_insert_traveller_query)) {
            echo mysqli_error($connection);
            echo "Traveller added";
            echo "<script>console.log('%c Traveller added ', 'background: white; color: Green');</script>";
        } else {
            echo mysqli_error($connection);
            echo "Traveller insert error";
            echo "<script>console.log('%c Traveller insert Error! ', 'background: red; color: white');</script>";
        }
    }
} else {
    include ("connection.php");

    if (!empty($_POST['member'])) {
        foreach ($_POST['member'] as $check) {
            array_push($member_list, $check);
        }
    } else {
        echo "<h2>Error in checkboxes @line " . __LINE__ . "</h2>";
        exit();
    }


    $last_trip_id = $_GET['t_id'];
    foreach ($member_list as $members) {
        $sql_insert_traveller_query = "INSERT INTO trip_traveller(t_id, u_id) VALUES ('$last_trip_id', '$members')";
        if (mysqli_query($connection, $sql_insert_traveller_query)) {
            echo "Traveller added";
            echo "<script>console.log('%c Traveller added ', 'background: white; color: Green');</script>";
            header("Location: ./manage_travellers.php?t_id=$last_trip_id&status=SUCCESS");
        } else {
            echo mysqli_error($connection);
            echo "<script>console.log('%c Traveller insert Error! ', 'background: red; color: white');</script>";
            header("Location: ./manage_travellers.php?t_id=$last_trip_id&status=ERROR");
        }
    }

}
/* End of add travellers to table */
