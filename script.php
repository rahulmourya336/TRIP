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

    $sql = "select u_id from trip_user WHERE u_email = '$email'";

    $sql_result = mysqli_query($connection, $sql);
    $user = mysqli_fetch_assoc($sql_result);

    $trip_creator_id = $user['u_name'];

    if ($user) {
        session_start();
        $_SESSION['username'] = $email;
        $_SESSION['current_user'] = $trip_creator_id;
        header("Location:./dashboard.php");
    } else {
        header("Location: signin.php?invalid=true");
    }
}

?>