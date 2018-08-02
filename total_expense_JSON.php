<?php
/**
 * Created by IntelliJ IDEA.
 * User: RadioactiveScript
 * Date: 8/2/2018
 * Time: 2:51 PM
 */ // Get name and expense

$name_sql_individual = "select sum(ex_amount) as total from trip_expenese where t_id  = $trip_id and u_id = $current_user_id;";
$individual_expense_JSON = Array();
$result = mysqli_query($connection, $name_sql_individual);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $expense_name = $row['ex_name'];
        $expense_amount = $row['ex_amount'];
        $expense_date = $row['ex_date'];
        $ex_cat = $row['c_id'];
        $category_name_sql_individual = "select distinct ex_name from trip_expense_category where ex_id = $ex_cat";
        $result_name_sql_individual = mysqli_query($connection, $category_name_sql_individual);
        $result_name_sql_individual = mysqli_fetch_assoc($result_name_sql_individual);
        $cat_name = "";
        if ($result_name_sql_individual > 0) {
            echo "<script>console.log('%c Category found! ', 'background: white; color: Green');</script>";
            $cat_name = $result_name_sql_individual['ex_name'];
        } else {
            echo "<script>console.log('%c Category error! ', 'background: white; color: Green');</script>";
            exit();
        }
        $individual_expense_JSON[] = array('label' => $cat_name, 'value' => $expense_amount);
    }
    $individual_expense_JSON = json_encode($individual_expense_JSON);


    //exit();
    echo "<script>setJSON_individual($individual_expense_JSON)</script>";
}