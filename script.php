<?php
include("connection.php");

$route_flag = $_POST['route_status'];

if ($route_flag) {
    @$name = $_POST['name'];
    @$email = $_POST['email'];
    @$password = $_POST['password'];
    @$mobile = $_POST['mobile'];
    @$status = 1;

// connect to the database
    $db = mysqli_connect('localhost', 'root', '', 'trip');


    // receive all input values from the form
    $username = mysqli_real_escape_string($connection, $name);
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);
    $mobile = mysqli_real_escape_string($connection, $mobile);
    $status = mysqli_real_escape_string($connection, $status);

    $sql = "INSERT INTO trip_user(u_name, u_email, u_password, u_mobile, u_status) VALUES('$username', '$email', '$password', '$mobile', '$status')";

    if (mysqli_query($connection, $sql)) {
        header("Location:./404.php");
    } else {
        echo "Something went wrong";
        sleep(2);
        header("Location: index.php");
    }



} else {
    @$email = $_POST['email'];
    @$password = $_POST['password'];

    // Fetch query and send redicrect page

    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

    $user_check_query = "SELECT * FROM trip_user WHERE u_email='$email' OR u_password='$password' LIMIT 1";
    $result = mysqli_query($connection, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if

}

?>