<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
  <?php include 'sider.php';
    ?>
  <div class="container">
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
          <a href="" class="btn  btn-success">
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
          <a href="" class="btn  btn-warning">
            <p>Có
              <?php echo $row;?> người dùng
            </p>
          </a>
        </center>
      </div>
    </div>
  </div>
</body>

</html>