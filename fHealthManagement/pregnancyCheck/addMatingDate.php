<div class="card">
    <div class="card-body">
        <form action="addMatingDate.php" method="post">
            <div class="row">
                <div class="col-6">
                    <p><?php echo $_GET['GetID'] ?> 配種日期 </p>
                    <input type="date" class="form-control card-text" placeholder="請輸入配種日期" name="matingDate" required>
                </div>
            </div>
            <br>
            <input type="hidden" value="<?php echo $_GET['GetSn']; ?>" name="GetSn">
            <input type="hidden" value="<?php echo $_GET['GetID']; ?>" name="GetID">
            <input type="submit" class="btn btn-success" value="新增" name="submit"></input>
    </div>
    </form>
</div>
<?php
if (isset($_POST['matingDate'])) {
    require("../../SQLServer.php");
    $sn = $_POST['GetSn'];
    $id = $_POST['GetID'];
    $matingDate = $_POST['matingDate'];
    $query = "SELECT * FROM `pregnancy_check` WHERE sn='$sn' AND id='$id'";
    $result = mysqli_query($db_link, $query);
    if (mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO `pregnancy_check`(`sn`, `id`, `matingDate`) VALUES('$sn','$id','$matingDate')";
        $result = mysqli_query($db_link, $query);
        if ($result) {
            header("location:pregnancyCheck.php");
        } else {
            echo 'Please Check Your Query';
        }
    } else {
        $query = "UPDATE `pregnancy_check` SET `matingDate`='$matingDate' WHERE `sn`='$sn' AND `id`='$id'";
        $result = mysqli_query($db_link, $query);
        if ($result) {
            header("location:pregnancyCheck.php");
        } else {
            echo 'Please Check Your Query';
        }
    }
};

?>