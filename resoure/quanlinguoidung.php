<?php
 $conn=mysqli_connect("localhost", "root","","banhang2020");
 if(isset($_GET['xoa'])){
     $tendangnhap=$_GET['xoa'];
     $vohieu=$_GET['vohieu'];
     $sql="UPDATE `dangnhap` SET `vohieu`=$vohieu WHERE `tendangnhap`='$tendangnhap'";
     $ketqua=mysqli_query($conn,$sql);
 }
 if(isset($_POST['sua'])){
     $matkhau=md5($_POST['matkhau']);
     
     $sql="UPDATE `dangnhap` SET `matkhau`=$matkhau WHERE tendangnhap='".$_GET['id']."'";
     $ketqua=mysqli_query($conn,$sql);
   header("location: quanlinguoidung.php?page=". $_GET['page']);
    
 }
 
 ?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    .service {

      box-shadow: 0px 1px 5px 2px rgb(178, 178, 241);
      margin: 10px;

    }
  </style>
</head>



<body>
  <?php
    include 'sider.php';
    ?>
  <div class="container service">
    <div class="container" style="margin-top:100px; margin-left:400px">
      <form action="" method="post">
        <input type="text" name="search" id="" require>
        <input type="submit" class="btn btn-info" value="Tìm kiếm" name="timkiem">
      </form>
    </div>
    <div class="container" style="margin-top:70px">
      <div class="row">
        <div class="col-12">
          <center>
            <h2>Quản lí người dùng</h2>

            <table class="table table-bordered table-hover " style="width:1100px">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Tên</th>
                  <th scope="col">Gmail</th>
                  <th scope="col">SDT</th>
                  <th>Sửa/Xóa</th>
                </tr>
              </thead>
              <tbody>

                <?php

$sql = "SELECT * FROM dangnhap "; 
if(isset($_POST['timkiem'])){
 $sql.=" where  tendangnhap like '%".$_POST['search']."%'";
}
       $record=($_GET['page']-1)*20;
       $sql.=" LIMIT 20 OFFSET ".$record;
                               
                                $ketqua = mysqli_query($conn, $sql); 
                                while ($row=mysqli_fetch_assoc($ketqua)){
                                    echo "<tr><td>".$row['tendangnhap']."</td>";
                                    echo "<td><img src=./css/img/avatar.png class=img-circle width=50px height=50px alt=>".$row['tenkhach']."</td>";
                                    echo "<td>".$row['gmail']."</td>";
                                    echo "<td>".$row['sdt']."</td>";
                              if($row['vohieu']==0){
?>
                <td>
                  <a href="?xoa=<?php echo $row['tendangnhap'];?>&&vohieu=1&&page=<?php echo $_GET['page']?>"
                    class="btn btn-danger">Vô hiệu hóa</a>
                  <a href="?page=<?php echo $_GET['page']?>&&id=<?php echo $row['tendangnhap'];?>"
                    class="btn btn-warning">Sửa</a>
                </td>
                </tr>
                <?php
                              }
                              else{
                                ?>

                <td>
                  <a href="?xoa=<?php echo $row['tendangnhap'];?>&&vohieu=0&&page=<?php echo $_GET['page']?>"
                    class="btn btn-danger">Hủy vô hiệu hóa</a>
                  <a href="?page=<?php echo $_GET['page']?>&&id=<?php echo $row['tendangnhap'];?>"
                    class="btn btn-warning">Sửa</a>
                </td>
                </tr>
                <?php
                              }
                      

                            }

                            ?>
              </tbody>
            </table>


            <?php    
                if(isset($_GET['id'])){
                    ?>

            <div class="con">

              <div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
                  <!--Content-->
                  <div class="modal-content text-center">
                    <!--Header-->
                    <form action="" method="post">
                      <div class="modal-header d-flex justify-content-center">

                        <p class="heading">Đặt lại mật khẩu</p>
                        <input type="text" name='matkhau'>
                      </div>

                      <!--Body-->
                      <div class="modal-body">

                        <i class="fas fa-times fa-4x animated rotateIn"></i>

                      </div>

                      <!--Footer-->
                      <div class="modal-footer flex-center">
                        <a href=""> <input type="submit" value="Yes" class="btn  btn-outline-danger" name='sua'> </a>

                      </div>
                    </form>
                  </div>
                  <!--/.Content-->
                </div>
              </div>
              <script>
                $("#modalConfirmDelete").modal("show");
              </script>

            </div>
            <?php }  ?>
          </center>
        </div>
      </div>
    </div>
    <div class="container">
      <center>
        <?php
      $sql="SELECT COUNT(tendangnhap) FROM dangnhap  ";
      $ketqua = mysqli_query($conn, $sql); 
      $data=mysqli_fetch_row($ketqua)[0];
      $row=ceil($data/20);
      for($i=1;$i<=$row;$i++){
      
             if($_GET['page']==$i){
              
                 ?>

        <strong> <a href="quanlinguoidung.php?page=<?php echo $i;?> ">
            <?php echo $i;?>
          </a></strong>
        <?php
                 }
             
         else{
            
                 ?>
        <a href="quanlinguoidung.php?page=<?php echo $i;?> ">
          <?php echo $i;?>
        </a>
        <?php
             }
      }
     

      ?>
      </center>
    </div>
  </div>
</body>

</html>