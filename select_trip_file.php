<?php
/**
 * Created by IntelliJ IDEA.
 * User: RadioactiveScript
 * Date: 7/19/2018
 * Time: 5:00 PM
 */


start_session();
include ("connection.php");
// Creator info
// Trip information
$email = $_SESSION['username'];

$get_creator_id = "select t_creator_id from trip_list WHERE u_name = '$email'";

// inner join query for fetching name of creator
$query ="select distinct u_name from trip_user INNER JOIN trip_list where trip_user.u_id = ";
echo "
// add your trips list

<div class=\"card\" style=\"width: 18rem;\">
<img class=\"card-img-top\" src=\"\" alt=\"\">
<div class=\"card-body\">
</div>
</div>

// if count is < 0 then display Add Trips

<p class=\"text-primary\">Add trips.</p>

";
