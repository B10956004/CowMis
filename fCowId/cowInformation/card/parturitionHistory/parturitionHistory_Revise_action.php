<?php
require_once("../../../../SQLServer.php");
if (isset($_POST['update'])) {
    $GetSn = $_GET['GetSn'];
    $id = $_POST['id'];
    $date = $_POST['date'];
    $birthParity = $_POST['birthParity'];
    if($_POST['selectEvent']!='其他'){
        $events=$_POST['selectEvent'];
    }else{
        $events=$_POST['textOther'];
    }
    $details = $_POST['details'];

    $query = "UPDATE pregnancy_check SET parturitiondate='$date',birthparity='$birthParity',events='$events',details='$details' WHERE sn='$GetSn' ";
    $result = mysqli_query($db_link, $query);
    if ($result) {
        header("location:../../cowInformation.php?GetID={$id}");
    } else {
        echo 'Please Check Your Query';
    }
} else {
    header("location:../../cowInformation.php?GetID={$id}");
}
