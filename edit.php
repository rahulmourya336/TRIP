<?php
/**
 * Created by IntelliJ IDEA.
 * User: RadioactiveScript
 * Date: 7/23/2018
 * Time: 11:51 AM
 */


session_start();
$user = $_SESSION['current_user'];
if (isset($_SESSION["username"])) {



} else {
    header("Location: ./signin.php?flag=loginfirst");
}