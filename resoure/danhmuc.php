<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/danhmuc.css">
</head>

<body>
  <div class="container-fluid menu" style=" background-color: #0f9ed8 !important;">
    <div class="container">
      <div class="dropdown">
        <button class="dropdown-toggle" style="font-size: 150% !important;" type="button" id="dropdownMenuButton"
          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Danh mục
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

          <?php

              $sql="SELECT * FROM danhmuc";
              $ketqua=mysqli_query($conn,$sql);
              while($row=mysqli_fetch_assoc($ketqua)){
            ?>

          <a class="dropdown-item" href="hanghoa.php?danhmuc=<?php echo $row['iddanhmuc'];?>"
            class="text-white btn btn-danger" style="">
            <?php echo $row['tendanhmuc'];?>
          </a>

          <?php
                        }
            ?>

        </div>
        <a class="nav1 nav2" style="font-size: 150% !important;" href="index.php">Trang chủ</a>

        <a class="nav1 nav2" style="font-size: 150% !important;" href="hanghoa1.php">Sản phẩm</a>
        <a class="nav1 nav2" style="font-size: 150% !important;" href="tintuc.php">Tin tức</a>
      </div>
    </div>
  </div>
</body>

</html>