<?php
require_once("../../SQLServer.php");

if(isset($_POST['Del']))
{
    $postSn=$_POST['postSn'];
    $query = "UPDATE cull_module SET isDel=1 WHERE sn='$postSn'";
    $result = mysqli_query($db_link, $query);

    if ($result) {
        header("location:cullModule.php");
    } else {
        echo 'Please Check Your Query';
    }
} else {
    header("location:cullModule.php");
}
?>