<?php
/**
 * Created by IntelliJ IDEA.
 * User: RadioactiveScript
 * Date: 7/13/2018
 * Time: 11:24 AM
 */

$fileName = "logout.php";
session_start();

if (isset($_SESSION["username"])) {
    echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>.: TRIPP | Dashboard :.</title>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300'>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,700,300'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css\"
          crossorigin=\"anonymous\">
    <script src=\"https://code.jquery.com/jquery-3.1.1.slim.min.js\" crossorigin=\"anonymous\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js\" crossorigin=\"anonymous\"></script>
    <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js\"
            crossorigin=\"anonymous\"></script>

    <link rel='stylesheet prefetch'
          href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>
    <style>
        #addTrip {
            background-color: steelblue;
            width: 75%;
            color: #333333;
            height: 150px;
            margin: 0 auto;
            overflow: hidden;
            padding: 10px 0;
            align-items: center;
            justify-content: space-around;
            display: flex;
            float: none;
        }
    </style>
</head>
<body>
<nav class=\"navbar navbar-toggleable-md navbar-light bg-faded\" style=\"background-color: #E1E1E1;\">
    <button class=\"navbar-toggler navbar-toggler-right\" type=\"button\" data-toggle=\"collapse\"
            data-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\"
            aria-label=\"Toggle navigation\">
        <span class=\"navbar-toggler-icon\"></span>
    </button>
    <a class=\"navbar-brand\" href=\"#\">TRIPP.</a>
    <div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">

        <ul class=\"navbar-nav mr-auto \">
            <li class=\"nav-item active\">
                <a class=\"nav-link\" href=\"#\">Home <span class=\"sr-only\">(current)</span></a>
            </li>
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"#\">expense</a>
            </li>
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"#\">contact</a>
            </li>
        </ul>
        <ul class=\"navbar-nav navbar-right\">
            <li class=\"nav-item\">
                <a class=\"nav-link \" href=\"logout.php\">logout</a>
            </li>
        </ul>

    </div>
</nav>

<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>
</div>

<div id=\"addTrip\">
    <div class=\"col-md-2\">
        <!-- Trigger the modal with a button -->
        <button type=\"button\" class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#myModal\">Add Trip</button>
    </div>
</div>

<!-- Modal -->
<div id=\"myModal\" class=\"modal fade \" role=\"dialog\">
    <div class=\"modal-dialog modal-lg\">

        <!-- Modal content-->
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <h4 class=\"modal-title\">Add Trip information</h4>
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>

            </div>
            <div class=\"modal-body\">
                <!--Form Start-->
                <form action=\"add_trip.php\" method=\"post\">
                    <div class=\"form-group row\">
                        <label for=\"trip-name\" class=\"col-sm-2 col-form-label\">Trip Name</label>
                        <div class=\"col-sm-10\">
                            <input type=\"text\" class=\"form-control\" id=\"trip-name\" placeholder=\"St. Lucia.\" required autofocus />
                        </div>
                    </div>
                    <div class=\"form-group row\">
                        <label for=\"trip-url\" class=\"col-sm-2 col-form-label\">Trip URL</label>
                        <div class=\"col-sm-10\">
                            <input type=\"url\" class=\"form-control\" id=\"trip-url\" placeholder=\"http://someurl.com\" required>
                        </div>
                    </div>
                    <div class=\"form-group row\">
                        <label for=\"trip-starting-date\" class=\"col-sm-2 col-form-label\">Starting Date</label>
                        <div class=\"col-sm-10\">
                            <input type=\"date\" class=\"form-control\" id=\"trip-starting-date\" placeholder=\"Select Trip Starting Date\" required>
                        </div>
                    </div>
                    <div class=\"form-group row\">
                        <label for=\"trip-ending-date\" class=\"col-sm-2 col-form-label\">Ending Date</label>
                        <div class=\"col-sm-10\">
                            <input type=\"date\" class=\"form-control\" id=\"trip-ending-date\" placeholder=\"Select Trip Ending Date\" required>
                        </div>
                    </div>
                    <button type=\"submit\" class=\"btn btn-primary pull-right\">Add Trip</button>

                </form>
                <!--Form End-->
            </div>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-link\" data-dismiss=\"modal\">Close</button>
            </div>
        </div>

    </div>
</div>


</body>
</html>";

   // echo "<h2> Welcome back : " . $_SESSION["username"] . "</h2>";
   // echo "<a href=$fileName>Log-out</a>";

} else {
    header("Location: ./signin.php?flag=loginfirst");
}

