<?php
/**
 * Created by IntelliJ IDEA.
 * User: RadioactiveScript
 * Date: 7/18/2018
 * Time: 6:03 PM
 */

if(!isset($_SESSION["username"])){
    header("Location: ./signin.php?flag=loginfirst");
}