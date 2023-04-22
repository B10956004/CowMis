<?php
require_once("../../../../SQLServer.php");
if (isset($_POST['update'])) {
    $GetSn = $_GET['GetSn'];
    $id = $_POST['id'];
    $birthparity=$_POST['birthparity'];
    $date = $_POST['date'];
    if($_POST['selectEvent']!='其他'){
        $events=$_POST['selectEvent'];
    }else{
        $events=$_POST['textOther'];
    }
    $details = $_POST['details'];

    if($events!='空胎'){
        $updateMotherQuery = "UPDATE `cows_information` SET `birthparity`='$birthparity' WHERE `id`='$id'";
        mysqli_query($db_link, $updateMotherQuery);
    }

    $query = "UPDATE pregnancy_check SET parturitiondate='$date',events='$events',details='$details' WHERE sn='$GetSn' ";
    $result = mysqli_query($db_link, $query);
    if ($result) {
        header("location:../../cowInformation.php?GetID={$id}");
    } else {
        echo 'Please Check Your Query';
    }
} else {
    header("location:../../cowInformation.php?GetID={$id}");
}
