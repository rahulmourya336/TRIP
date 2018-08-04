<?php
/**
 * Created by IntelliJ IDEA.
 * User: RadioactiveScript
 * Date: 7/14/2018
 * Time: 7:44 PM
 */

    session_start();
    session_destroy();
    $_SESSION["username"] = "";
    unset($_SESSION["username"]);
    header("Location: ./signin.php");