<?php
/**
 * Created by IntelliJ IDEA.
 * User: RadioactiveScript
 * Date: 7/16/2018
 * Time: 12:48 PM
 */
include("connection.php");
session_start();

// initializing variables
$username = "";
$email = "";
$password = "";
$mobile = "";
$status = 1;
$errors = array();

// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $mobile = mysqli_real_escape_string($connection, $_POST['mobile']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $status = mysqli_real_escape_string($connection, $status);

    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM trip_user WHERE u_email='$email' LIMIT 1";
    $result = mysqli_query($connection, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['u_email'] === $email) {
            header('Location: index.php?invalid=true');
        }
    } else {
        // Finally, register user if there are no errors in the form

        $password = md5($password);//encrypt the password before saving in the database

        $query = "INSERT INTO trip_user (u_name, u_email, u_mobile, u_password, u_status) 
  			  VALUES('$username', '$email', '$mobile', '$password', '$status')";
        mysqli_query($connection, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: ./404.php');
    }


}
