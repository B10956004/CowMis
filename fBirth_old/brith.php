<?php
require_once("../SQLServer.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <!--<meta http-equiv="refresh" content="60;url='http://140.127.22.165//豬隻V2.1/index.php'"/>-->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">


  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
  <link rel="stylesheet" href="../css/indexcss.css">
</head>

<body>
  <div id="content">
    <div class="row">
      <div class="col-8">
        <!-- <span class="col-6" style="font-weight:bold;font-size:25px;">牧場概況</span> -->
      </div>
      <div class="col-md-12 col-lg-8">
        <div class="col-md-12 ">
          <div id="container" style="width:100%;">
            <div class="card">
              <div class="card-header">
                <h5><i class="fab fa-bandcamp"></i>&nbsp;即將分娩牛隻</h5>
              </div>
              <div class="collapse show" data-parent="#birth_data" id="cow_basic">
                <div class="card-body" id="birth_data">
                  <table id="rule" class="table table-hover">
                    <thead>
                      <tr>
                        <th>編號</th>
                        <th>預定分娩日</th>
                        <th>胎次</th>
                        <th>胎別</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = "SELECT * FROM mating_module WHERE isDel=0 AND dueDate BETWEEN CURDATE() AND DATE_ADD(CURDATE(),INTERVAL 3 DAY);";
                      $result = mysqli_query($db_link, $query);
                      while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $dueDate = $row['dueDate'];
                        $birthParity = $row['birthParity'];
                        $birthEvent = $row['birthEvent'];
                      ?>
                        <tr>
                          <td><?php echo $id ?></td>
                          <td><?php echo $dueDate ?></td>
                          <td><?php echo $birthParity ?></td>
                          <td><?php echo $birthEvent ?></td>
                        </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                  </table>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>