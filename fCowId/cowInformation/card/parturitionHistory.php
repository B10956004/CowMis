<?php
require("../../../SQLServer.php");
$GetID = $_GET['GetID'];
$query = "SELECT * FROM pregnancy_check WHERE id='$GetID'  ORDER BY `birthparity` DESC ";
$result = mysqli_query($db_link, $query);
?>

<div class="card-body">
    <h5 class="card-title"><i class="fas fa-heart"></i>&nbsp;歷史懷孕紀錄
        <?php
        if (mysqli_num_rows($result) != 0) {
            echo "&nbsp;&nbsp;&nbsp;&nbsp;編號:$GetID &nbsp;&nbsp;";
        }
        ?>
    </h5>
    <div class="table-responsive">
        <div id="cow_table" style="text-align:center;">

            <table id="rule" class="table table-hover">
                <thead>
                    <tr class="table-active">
                        <th>分娩日期</th>
                        <th>胎次</th>
                        <th>事件</th>
                        <th>詳情</th>
                        <th>編輯</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) != 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $sn=$row['sn'];
                            $date = $row['parturitiondate'];
                            if($date=='0000-00-00'){
                                $date="正在進行...";
                            }
                            $birthParity = $row['birthparity'];
                            $events = $row['events'];
                            $details = $row['details'];
                            echo "
                            <tr>
                                <td>$date</td>
                                <td>$birthParity</td>
                                <td>$events</td>
                                <td>$details</td>
                                <td><a href=\"#reviseHistory\" GetSn=\"$sn\" class=\"btn btn-primary view_historyData\">編輯</a></td>
                            </tr>
                        ";
                        }
                    } else {
                        echo "
                            <tr>
                                <td colspan='5'><center>無資料!</center></td>
                            </tr>
                        ";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
<div id="historyModal" class="modal fade bd-example-modal-lg">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold">修改歷史懷孕紀錄</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="cow_historyDetail">
                <!-- <input type="text" name="cow_ID" id="cow_ID" claass="form-control" readonly /> -->
                <br />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '.view_historyData', function() {
        var GetSn = $(this).attr("GetSn");

        $.ajax({
            url: "card/parturitionHistory/parturitionHistory_Revise.php",
            method: "GET",
            data: {
                GetSn: GetSn
            },

            success: function(data) {
                $('#cow_historyDetail').html(data);
                $('#historyModal').modal('show');
            }
        });

    });
</script>