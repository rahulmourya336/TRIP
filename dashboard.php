<?php
/**
 * Created by IntelliJ IDEA.
 * User: RadioactiveScript
 * Date: 7/13/2018
 * Time: 11:24 AM
 */






$fileName = "logout.php";
session_start();

if(isset($_SESSION["username"])){
    echo "<h2> Welcome back : ". $_SESSION["username"] . "</h2>";
    echo "<a href=$fileName>Log-out</a>";
    echo "<!doctype html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\"
          content=\"width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
    <title>TRIP Dashboard</title>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300'>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,700,300'>
    <link rel=\"stylesheet\" href=\"css/index_style.css\">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
    <link rel='stylesheet prefetch'
          href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.min.css'>

    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>
    <script src=\"//code.jquery.com/jquery-1.11.2.min.js\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js\"></script>
</head>
<body class=\"dashboard_bg dashboard_body\">


</body>
</html>";
}
else{
    echo "Unable to set session";
    echo "<a href=$fileName>Log-out</a>";
}

