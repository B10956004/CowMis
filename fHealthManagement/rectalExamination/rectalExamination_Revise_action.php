<?php

require_once("../../SQLServer.php");
if (isset($_POST['update']))
{
    $GetSn=$_GET['GetSn'];
    $id = $_POST['id'];
    $checkDate = $_POST['checkDate'];
    $pregnancyResult = $_POST['pregnancyResult'];


    $query = "UPDATE rectal_examination SET checkDate='$checkDate',pregnancyResult='$pregnancyResult' WHERE sn='$GetSn'";
    $result = mysqli_query($db_link,$query);

if($result)
{
header("location:rectalExamination.php");

}
else
{
echo 'Please Check Your Query';
}
}
else
{
    header("location:rectalExamination.php");
}
?>

