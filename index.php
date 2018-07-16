<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>.: TRIP | Welcome login, signup :.</title>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300'>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,700,300'>
    <link rel="stylesheet" href="css/index_style.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
    <link rel='stylesheet prefetch'
          href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.min.css'>

    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>

</head>

<body>
<div class="signup__container">
    <div class="container__child signup__thumbnail">
        <div class="thumbnail__content text-center">
            <h1 class="heading--primary">Welcome to TRIP</h1>
            <h2 class="heading--secondary">Travel Expense Manager</h2>
        </div>
        <div class="signup__overlay"></div>
    </div>
    <div class="container__child signup__form">
        <div class="text-center">
            <h5>Create an account</h5>
        </div>
        <form action="dummy_signup.php" onsubmit="" method="post"
              id="signup">
            <div class="form-group">
                <label for="username">Full Name</label>
                <input class="form-control" type="text" name="name" id="name" placeholder="james.bond" required/>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="text" name="email" id="email" placeholder="james.bond@spectre.com"
                       required/>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="********"
                       required min="6"/>
            </div>
            <div class="form-group">
                <label for="passwordRepeat">Repeat Password</label>
                <input class="form-control" type="password" name="passwordRepeat" id="passwordRepeat"
                       placeholder="********" required min="6"/>
            </div>

            <!--				TODO - Add [+91] Style block bootstrap-->


            <div class="form-group">
                <label for="passwordRepeat">Contact Number</label>
                <input class="form-control" type="number" name="mobile" id="mobile" placeholder="+91 XXXXXXXXXX"
                       min="10"
                       required/>
            </div>
            <div class="m-t-lg">
                <ul class="list-inline">
                    <li>
                        <input class="btn btn--form" type="submit" value="Register" name="reg_user"/>
                    </li>
                    <li>
                        <a class="signup__link" href="signin.php">I am already a member</a>
                    </li>
                </ul>
            </div>
        </form>
    </div>
</div>

</body>


<?php
//include("connection.php");
//
//if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['mobile']))
//{
//    @$name = $_POST['name'];
//    @$email = $_POST['email'];
//    @$password = $_POST['password'];
//    @$mobile = $_POST['mobile'];
//    @$status = 1;
//
//// connect to the database
//
//
//// receive all input values from the form
//    $username = mysqli_real_escape_string($connection, $name);
//    $email = mysqli_real_escape_string($connection, $email);
//    $password = mysqli_real_escape_string($connection, $password);
//    $mobile = mysqli_real_escape_string($connection, $mobile);
//    $status = mysqli_real_escape_string($connection, $status);
//
//    $sql = "INSERT INTO trip_user(u_name, u_email, u_password, u_mobile, u_status) VALUES('$username', '$email', '$password', '$mobile', '$status')";
//
//    if (mysqli_query($connection, $sql)) {
//        header("Location:./Dashboard.php");
//    } else {
//        echo "<div class=\"alert alert-danger\" role=\"alert\">
//  Error while contacting server.
//</div>";
//        sleep(2);
//        header("Location: index.php");
//    }
//
//
//}
//
//
//?>


</html>