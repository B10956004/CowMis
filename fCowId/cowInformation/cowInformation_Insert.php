<?php
require_once("../../SQLServer.php");


if (isset($_POST['submit'])) {

    $id = $_POST['id']; //編號
    $dob = $_POST['dob']; //生日
    $mid = $_POST['mid']; //母親牛編號
    $fid = $_POST['fid']; //精液編號
    //出生胎次、胎距計算
    // $sql = "SELECT * FROM `cows_information` WHERE mid='$mid'";
    // echo $sql;
    // $result = mysqli_query($db_link, $sql);
    // $count = mysqli_num_rows($result);
    // if ($count == 0||$count==NULL) {
    //     $birthParity = 1;
    //     $calvingInterval = "0天";
    // } else {
    //     $birthParity = $count + 1;
    //     $sql = "SELECT * FROM `cows_information` WHERE mid='$mid' AND birthParity='$count'";
    //     $result = mysqli_query($db_link, $sql);
    //     $row = mysqli_fetch_array($result);
    //     $preDob = $row['dob'];
    //     $calvingInterval = abs(floor((strtotime($preDob) - strtotime($dob)) / (60 * 60 * 24))).'天';
    // }
    $calvingInterval = "0天";
    $birthParity = 0;
    $area = $_POST['area']; //區域

    $query = "INSERT INTO `cows_information`(`id`, `dob`, `mid`, `fid`, `birthParity`, `calvingInterval`, `area`) VALUES ('$id','$dob','$mid','$fid','$birthParity','$calvingInterval','$area')";
    $result = mysqli_query($db_link, $query);

    if ($result) {
        header("location:cowInformation.php");
    } else {
        echo 'Please check ur query';
    }
} else {
    header("location:cowInformation.php");
}
