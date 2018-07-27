<?php
/**
 * Created by IntelliJ IDEA.
 * User: RadioactiveScript
 * Date: 7/27/2018
 * Time: 3:04 PM
 */
session_start();

$user = $_SESSION['current_user'];
$fileName = "logout.php";

if (isset($_SESSION["username"])) {
    $current_user_id = $_SESSION['current_user_id'];
    include("connection.php");
    $select_query = "select u_id, u_name from trip_user WHERE u_id <> '$current_user_id'";
    if ($result = mysqli_query($connection, $select_query)) {
        echo "<form action='' method='get' ><select multiple name='member'>";
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $trip_id = $row['u_id'];
                $trip_name = $row['u_name'];
                echo "
                <option value='$trip_id'>$trip_name</option>
                ";

            }
            echo "</select>
<button type='submit'>Submit</button>

</form>";
        }
    }


} else {
    header("Location: ./signin.php?flag=loginfirst");
}
