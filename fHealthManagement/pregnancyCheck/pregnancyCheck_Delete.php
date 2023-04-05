<?php
require_once("../../SQLServer.php");

if (isset($_POST['Del'])) {
    $postSn = $_POST['postSn'];
    $query = "DELETE FROM `pregnancy_check` WHERE sn='$postSn'";
    $result = mysqli_query($db_link, $query);

    if ($result) {
        header("location:pregnancyCheck.php");
    } else {
        echo 'Please Check Your Query';
    }
} else {
    header("location:pregnancyCheck.php");
}
