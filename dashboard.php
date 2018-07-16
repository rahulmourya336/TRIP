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
}
else{
    echo "Unable to set session";
    echo "<a href=$fileName>Log-out</a>";
}

