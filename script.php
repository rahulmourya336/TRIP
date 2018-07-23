<?php
include("connection.php");

$route_flag = $_POST['route_status'];

if ($route_flag) {
    @$name = $_POST['name'];
    @$email = $_POST['email'];
    @$password = $_POST['password'];
    @$mobile = $_POST['mobile'];
    @$status = 1;

    // receive all input values from the form
    $username = mysqli_real_escape_string($connection, $name);
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);
    $mobile = mysqli_real_escape_string($connection, $mobile);
    $status = mysqli_real_escape_string($connection, $status);

    $sql = "INSERT INTO trip_user(u_name, u_email, u_password, u_mobile, u_status) VALUES('$username', '$email', '$password', '$mobile', '$status')";

    if (mysqli_query($connection, $sql)) {
        header("Location:./Dashboard.php");
    } else {
        echo "Something went wrong";
        sleep(2);
        header("Location: index.php");
    }

} else {
    @$email = $_POST['email'];
    @$password = $_POST['password'];
    $error = array();

    // Fetch query and send redirect page

    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);
    $password = md5($password);

    $user_check_query = "SELECT * FROM trip_user WHERE u_email='$email' AND u_password='$password' LIMIT 1";
    $result = mysqli_query($connection, $user_check_query);
    $user = mysqli_fetch_assoc($result);


    if ($user) {
        $sql_current_user_name = "select distinct u_name from trip_user where u_email = '$email'";
        $sql_current_user_id = "select distinct u_id from trip_user where u_email = '$email'";

        /* Select the name of user from [trip_user] table */
       /* $sql = "select distinct u_name from trip_user INNER JOIN trip_list where trip_user.u_id = 29;";*/

        $sql_result = mysqli_query($connection, $sql_current_user_name);
        $sql_result_id = mysqli_query($connection, $sql_current_user_id);

        $user = mysqli_fetch_array($sql_result);
        $u_id = mysqli_fetch_array($sql_result_id);

        $trip_creator_name = $user['u_name'];
        $trip_creator_id = $u_id['u_id'];

        session_start();
        $_SESSION['username'] = $email;
        $_SESSION['current_user'] = $trip_creator_name;
        $_SESSION['current_user_id'] = $trip_creator_id;

        header("Location:./dashboard.php");
    } else {
        header("Location: signin.php?invalid=true");
    }
}

?>