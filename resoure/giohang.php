<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<?php
include 'menu.php';
include 'danhmuc.php';
if(isset($_POST['capnhat'])){
  foreach($_SESSION['giohang'] as $key => $value ){
  
    $_SESSION['giohang'][$key]=$_POST[$key];
   }
}


    
?>

<body>

  <div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
      <!--Content-->
      <div class="modal-content text-center">
        <!--Header-->
        <div class="modal-header d-flex justify-content-center">
          <p class="heading">Thành công</p>
        </div>

        <!--Body-->
        <div class="modal-body">

          <i class="fas fa-times fa-4x animated rotateIn"></i>

        </div>

        <!--Footer-->
        <div class="modal-footer flex-center">
          <a href="" class="btn  btn-outline-danger">Yes</a>

        </div>
      </div>
      <!--/.Content-->
    </div>
  </div>
  <!--Modal: modalConfirmDelete-->


  <?php   
if(!empty($_SESSION['giohang'])){
    ?>
  <form action="" method="post">
    <div class="container">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Tên hàng</th>
            <th scope="col">Số lượng</th>
            <th scope="col">Đơn giá</th>
            <th scope="col">Ảnh</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>

          <?php

                                $conn=mysqli_connect("localhost", "root","","banhang2020");
                                $tongTien = 0;
                                foreach($_SESSION['giohang'] as $key => $value){
                                    $item[]=$key; 
                                }
                                $str=implode(",",$item);
                                $sql="SELECT * FROM hanghoa WHERE idhanghoa in($str)";
                                $ketqua=mysqli_query($conn,$sql);
                                while($row=mysqli_fetch_assoc($ketqua)){
                                    echo "<tr><td>".$row['idhanghoa']."</td>";
                                    echo "<td>".$row['tenhang']."</td>";
                                    echo "<td><input type=number name=".$row['idhanghoa']."  min=1 max=".$row['soluong']." value=".$_SESSION['giohang'][$row['idhanghoa']]."></td>";
                                 
                                    echo "<td>".$row['dongia']."</td>";
                                    $tongTien+=$_SESSION['giohang'][$row['idhanghoa']]*$row['dongia'];
                        ?>
          <td><img class="as" src="./css/img/<?php echo $row['link'];?>" alt="" height="100" width="100"></td>
          <td>
            <a href="delete.php?id=<?php echo $row['idhanghoa'];?>" class="btn btn-primary">Xóa</a>
          </td>
          </tr>
          <?php

                            }
                            ?>
        </tbody>
      </table>
      <center>
        <?php  echo "Tổng tiền: ".$tongTien;?>

        <input type="submit" value="Mua hàng" class="btn btn-primary" name="muahang">
        <input type="submit" value="Cập nhật" class="btn btn-primary" name="capnhat">
      </center>
      <?php
                        }
                        else{
                            ?>
      <div class="container">
        <center>
          <p style="height:30vh">Không có hàng trong giỏ</p>
        </center>
      </div>
      <?php
                           
                        }

                            ?>

    </div>

  </form>
  <?php
        if(isset($_POST['muahang'])){
          if(isset($_SESSION['tendangnhap'])){
            $tendangnhap= $_SESSION['tendangnhap'];
            $today = date("Y-m-d");
            $sql="INSERT INTO hoadon( `tendangnhap`, `ngay`, `tongtien`,xacnhan) VALUES('$tendangnhap','$today','$tongTien',0);";   
            $ketqua=mysqli_query($conn,$sql);
            $row1= mysqli_insert_id($conn);
            $sql="SELECT * FROM hanghoa WHERE idhanghoa in($str)";
            $ketqua=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($ketqua)){
              $sql="INSERT INTO chitiet( idhoadon, idhanghoa, dongia,soluong) values($row1,$row[idhanghoa],$row[dongia],".$_SESSION['giohang'][$row['idhanghoa']].")";
              $sqlhh="SELECT  `soluong` FROM `hanghoa` WHERE idhanghoa=".$row['idhanghoa'];
              $ketqua1=mysqli_query($conn,$sqlhh);
              $rowhh=mysqli_fetch_assoc($ketqua1);
              $soluong=$rowhh['soluong']-$_SESSION['giohang'][$row['idhanghoa']];
              $sql1="UPDATE hanghoa SET soluong=$soluong WHERE idhanghoa=".$row['idhanghoa'];
              $ketqua1=mysqli_query($conn,$sql);
              $ketqua1=mysqli_query($conn,$sql1);
        }
          unset($_SESSION['giohang']);
   ?>
  <script>
    $("#modalConfirmDelete").modal("show");
  </script>
  <?php
   } else{?>
  <div class="modal fade" id="modalConfirmDelete1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
      <!--Content-->
      <div class="modal-content text-center">
        <!--Header-->
        <div class="modal-header d-flex justify-content-center">
          <p class="heading">Đăng nhập để mua hàng</p>
        </div>
        <!--Body-->
        <div class="modal-body">
          <i class="fas fa-times fa-4x animated rotateIn"></i>
        </div>
        <!--Footer-->
        <div class="modal-footer flex-center">
          <a href="" class="btn  btn-outline-danger">Yes</a>
        </div>
      </div>
      <!--/.Content-->
    </div>
  </div>
  <script>
    $("#modalConfirmDelete1").modal("show");
  </script>
  <?php
   }
  }
        ?>





  <?php
include "form.php";
?>
</body>

</html>