<?php include "sider.php";?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="icon" href="./css/img/icon-thanh-toan.png" type="image/png" sizes="16x16 32x32">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <style>
    .service {
      padding: 40px;
      box-shadow: 0px 1px 5px 2px rgb(178, 178, 241);
      margin: 10px;

    }
  </style>


</head>

<body>


  <div class="container service">
    <div class="container" style="margin-top:50px">



      <div class="row">

        <?php
      $sql="SELECT COUNT(idhanghoa) FROM hanghoa";
      $ketqua=mysqli_query($conn,$sql);
      $row=mysqli_fetch_row($ketqua)[0];
      ?>
        <div class="col">
          <center>
            <a href="" class="btn  btn-danger">
              <p>Có
                <?php echo $row;?> sản phẩm
              </p>
            </a>
          </center>
        </div>

        <?php
      $sql="SELECT COUNT(idhoadon) FROM hoadon where xacnhan=0";
      $ketqua=mysqli_query($conn,$sql);
      $row=mysqli_fetch_row($ketqua)[0];
      ?>
        <div class="col">
          <center>
            <a href="quanlidonhang.php?page=1" class="btn  btn-success">
              <p>Có
                <?php echo $row;?> đơn hàng chưa xác nhận
              </p>
            </a>
          </center>
        </div>
        <?php
      $sql="SELECT COUNT(tendangnhap) FROM dangnhap ";
      $ketqua=mysqli_query($conn,$sql);
      $row=mysqli_fetch_row($ketqua)[0];
      ?>
        <div class="col">
          <center>
            <a href="quanlinguoidung.php?page=1" class="btn  btn-warning">
              <p>Có
                <?php echo $row;?> người dùng
              </p>
            </a>
          </center>
        </div>

      </div>
      <div class="row" style="margin-top:100px">
        <div class="col">
          <center>
            <p href="" class="btn  btn-info">Doanh thu trong ngày</p>
            <form action="" method="post">
              <input type="date" name="ngay" id="" require>
              <input type="submit" value="Hiển thị" name="btnngay" class="btn btn-warning">
            </form>
            <?php
            if(isset($_POST['btnngay'])){
        
             $today=date("Y-m-d", strtotime($_POST['btnngay'])); 
            }
            else{
             $today=date("Y-m-d");
            }
           
               $sql="SELECT SUM(tongtien)as total FROM `hoadon` WHERE ngay LIKE('%$today%')";
               $ketqua=mysqli_query($conn,$sql);
               $row=mysqli_fetch_assoc($ketqua);
               echo number_format($row['total'],0,',','.')." VNĐ" ;
             
            ?>
          </center>
        </div>

        <div class="col">
          <center>
            <a href="" class="btn  btn-primary">Doanh thu trong tháng</a>
            <form action="" method="get">
              <input type="month" name="thang" id="">
              <input type="submit" value="Hiển thị" name="month">
            </form>

            <?php
      $today=date("Y-m");
      if(isset($_GET['month'])){
         $today=$_GET['thang'];
      }
         $sql="SELECT SUM(tongtien)as total FROM `hoadon` WHERE ngay LIKE('%$today%')";
      $ketqua=mysqli_query($conn,$sql);
      $row=mysqli_fetch_assoc($ketqua);
      echo "Doanh thu trong tháng $today =".number_format($row['total'],0,',','.')." VNĐ";
        ?>
          </center>
        </div>
      </div>
    </div>








    <div class="container ">
      <canvas id="myChart"></canvas>
    </div>

    <script>
      let myChart = document.getElementById('myChart').getContext('2d');

      // Global Options
      Chart.defaults.global.defaultFontFamily = 'Lato';
      Chart.defaults.global.defaultFontSize = 18;
      Chart.defaults.global.defaultFontColor = '#777';

      let massPopChart = new Chart(myChart, {
        type: 'line', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
        data: {
          labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
          datasets: [{
            label: 'DOANH THU',
            data: [
    <?php
    $year = date("Y");
            $conn=mysqli_connect('localhost', 'root', '', 'banhang2020');
            for($i = 1;$i<= 12; $i++){
              if($i < 10){
        $sql = "SELECT SUM(tongtien)as total FROM `hoadon` WHERE ngay LIKE('%$year-0$i-%')";
      } else {
        $sql = "SELECT SUM(tongtien)as total FROM `hoadon` WHERE ngay LIKE('%$year-$i-%')";
      }

      $ketqua = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($ketqua);
      echo $row['total'].',';

      }
     ?>
   ],
      //backgroundColor:'green',
      backgroundColor: [
        'rgba(255, 99, 132, 0.6)',
        'rgba(54, 162, 235, 0.6)',
        'rgba(255, 206, 86, 0.6)',
        'rgba(75, 192, 192, 0.6)',
        'rgba(153, 102, 255, 0.6)',
        'rgba(255, 159, 64, 0.6)',
        'rgba(255, 99, 132, 0.6)'
      ],
        borderWidth: 1,
          borderColor: '#777',
            hoverBorderWidth: 3,
              hoverBorderColor: '#000'
 }]
},
      options: {
        title: {
          display: true,
            text: 'Doanh thu theo tháng',
              fontSize: 25
        },
        legend: {
          display: true,
            position: 'right',
              labels: {
            fontColor: '#000'
          }
        },
        layout: {
          padding: {
            left: 50,
              right: 0,
                bottom: 0,
                  top: 0
          }
        },
        tooltips: {
          enabled: true
        }
      }
});
    </script>
  </div>


</body>

</html>