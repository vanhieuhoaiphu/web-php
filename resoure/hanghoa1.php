<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="./css/hanghoa.css">
  <style>
    .container1 {
      text-align: center;
      padding: 20px 0;
      position: relative;
    }

    .container1 p {
      font-size: 24px;
      background: #fff;
      position: absolute;
      padding: 0 20px;
      color: #0f9ed8;
      margin-top: -20px;
      margin-left: 500px;
    }

    .container1::before {
      display: table;
      content: "";
      border-top: 1px solid #0f9ed8;
      width: 100%;
      position: absolute;
      top: 50%;

    }
  </style>
</head>

<body>

  <?php 
            include "menu.php";
            include "danhmuc.php";
          ?>

  <?php
          $sql="SELECT * from danhmuc";
          $ketqua=mysqli_query($conn,$sql);
         while($row=mysqli_fetch_assoc($ketqua)){
             $dem=0;
             ?>
  <div class="container" style="margin-top:50px; margin-bottom:30px">
    <div class="container1">
      <p>
        <?php echo $row['tendanhmuc'];?>
      </p>
    </div>
  </div>

  <div class="contaier">
    <div class="row">

      <?php
             $sql1="SELECT * from hanghoa  where iddanhmuc=".$row['iddanhmuc']." ORDER BY daban DESC limit 12 offset 0";
            $ketqua1=mysqli_query($conn,$sql1);
            if(mysqli_num_rows($ketqua1)>0){
            while($row1=mysqli_fetch_assoc($ketqua1)){
              if($row1['hienthi']==0){
                if ($dem%4==0){
                    $dem++;
                    ?>
    </div>
  </div>

  <div class="container" style="    
                        background-color: rgb(223, 217, 217);
                        border: 1px solid rgb(189, 188, 188);">
    <div class="row">
      <div class="col col1">
        <a href="./chitiet.php?id=<?php echo $row1['idhanghoa'];?>">
          <img src="./css/img/<?php echo $row1['link'];?>" alt="">
          <h4 class="h4">
            <?php echo $row1['tenhang'];?>
          </h4>
          <h5 style="color:red;">
            <?php echo number_format($row1['dongia'], 0, ',', '.');?> <sup>Đ</sup>
          </h5>
        </a>
      </div>
      <?php
                } else{
                 $dem++;
                ?>
      <div class="col col1">

        <a href="./chitiet.php?id=<?php echo $row1['idhanghoa'];?>">
          <img src="./css/img/<?php echo $row1['link'];?>" alt="">
          <h4 class="h4">
            <?php echo $row1['tenhang'];?>
          </h4>
          <h5 style="color:red;">
            <?php echo number_format($row1['dongia'], 0, ',', '.');?> <sup>Đ</sup>
          </h5>
        </a>

      </div>
      <?php }
                 }
                }
                } else echo "<div class='container'><center><p>Không có hàng<p></center></div>";
            while($dem %4!=0){
              ?>
      <div class="col"></div>

      <?php
                  $dem++;
               }
                 ?>
    </div>
  </div>
  <?php
            }
       
        ?>
  </div>
  <?php  include 'form.php';?>
</body>

</html>