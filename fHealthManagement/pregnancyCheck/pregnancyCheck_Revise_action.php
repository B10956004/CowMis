<?php

require_once("../../SQLServer.php");
if (isset($_POST['update'])) {
    $GetSn = $_GET['GetSn'];
    $id = $_POST['id'];
    $birthparity = $_POST['birthparity'];
    $estrusdate = $_POST['estrusdate'];
    $matingdate = $_POST['matingdate'];
    $intervaldays = $_POST['intervaldays'];
    $pregnancydate = $_POST['pregnancydate'];
    if ($_POST['pregnancyresult'] != '請選擇') {
        $pregnancyresult = $_POST['pregnancyresult'];
    } else {
        $pregnancyresult = '';
    }
    if ($_POST['parturitiondate'] != '0000-00-00') {
        $parturitiondate = $_POST['parturitiondate'];
    } else {
        $parturitiondate = '';
    }

    if ($_POST['selectEvent'] != '其他') {
        if ($_POST['selectEvent'] != '請選擇') {
            $events = $_POST['selectEvent'];
        } else {
            $events = '';
        }
    } else {
        $events = $_POST['textOther'];
    }
    if ($_POST['details'] != '') {
        $details = $_POST['details'];
    } else {
        $details = '';
    }

    $query = "UPDATE pregnancy_check SET birthparity='$birthparity',estrusdate='$estrusdate',matingdate='$matingdate',
    intervaldays='$intervaldays',pregnancydate='$pregnancydate',pregnancyresult='$pregnancyresult',parturitiondate='$parturitiondate'
    ,events='$events',details='$details' WHERE `sn`='$GetSn' AND `id`='$id'";
    $result = mysqli_query($db_link, $query);
    echo $query;
    if ($result) {
        header("location:pregnancyCheck.php");
    } else {
        echo 'Please Check Your Query';
    }
} else {
    header("location:pregnancyCheck.php");
}
