<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <style>
    .service {

      box-shadow: 0px 1px 5px 2px rgb(178, 178, 241);
      margin: 10px;

    }
  </style>
  <?php include "sider.php";   
        ?>
  <?php
 if(isset($_GET['id'])){
     if(isset($_GET['xacnhan'])){
     
        if($_GET['xacnhan']==1){
            $sql4 = "UPDATE hoadon SET xacnhan=1 WHERE idhoadon=".$_GET['id']; 
            $ketqua4 = mysqli_query($conn, $sql4); 

            $sql1 = "SELECT * FROM chitiet where idhoadon=".$_GET['id']; 
            $ketqua1 = mysqli_query($conn, $sql1); 
            while ($row1=mysqli_fetch_assoc($ketqua1)){
                $sql2 = "SELECT * FROM hanghoa where idhanghoa=".$row1['idhanghoa']; 
               
              $ketqua2 = mysqli_query($conn, $sql2); 
              while ($row2=mysqli_fetch_assoc($ketqua2)){

          
              $sl=$row1['soluong']+$row2['daban'];
              $sql="UPDATE `hanghoa` SET `daban`=$sl WHERE idhanghoa=".$row1['idhanghoa'];
              $ketqua = mysqli_query($conn, $sql);
              $message = 'Đơn hàng của bạn đã được xác nhận!';
            }
          }
        }
        else if($_GET['xacnhan']==3){
          $sql4 = "UPDATE hoadon SET xacnhan=3 WHERE idhoadon=".$_GET['id']; 
          $ketqua4 = mysqli_query($conn, $sql4); 
          $message = 'Đơn hàng của bạn đã được thanh toán!';
        }
        else{
            $sql1 = "SELECT * FROM chitiet where idhoadon=".$_GET['id']; 
            $ketqua1 = mysqli_query($conn, $sql1); 
            while ($row1=mysqli_fetch_assoc($ketqua1)){
                $sql2 = "SELECT * FROM hanghoa where idhanghoa=".$row1['idhanghoa']; 
               
              $ketqua2 = mysqli_query($conn, $sql2); 
              while ($row2=mysqli_fetch_assoc($ketqua2)){

              $sl=$row2['daban']-$row1['soluong'];
              $sql="UPDATE `hanghoa` SET `daban`=$sl WHERE idhanghoa=".$row1['idhanghoa'];
              $message= mysqli_query($conn, $sql);
       
            }
          }
          $subject = 'Đơn hàng của bạn đã được hủy xác nhận!';
            $sql4 = "UPDATE hoadon SET xacnhan=0 WHERE idhoadon=".$_GET['id']; 
            $ketqua4 = mysqli_query($conn, $sql4); 
        }
        $sql5 = "SELECT tendangnhap FROM hoadon where idhoadon=".$_GET['id']; 
        $ketqua5 = mysqli_query($conn, $sql5); 
        $row5=mysqli_fetch_assoc($ketqua5);
        $sql5 = "SELECT gmail FROM dangnhap where tendangnhap='".$row5['tendangnhap']."'"; 
        $ketqua5 = mysqli_query($conn, $sql5); 
        $row5=mysqli_fetch_assoc($ketqua5);
        $to = $row5['gmail'];
        $subject="Shop online";
        $headers = "From: your@email-address.com\r\n";
        mail($to, $subject, $message, $headers);
     }
   if(isset($_GET['xoa'])){
    if(isset($_GET['id'])){
        $sql1 = "SELECT * FROM chitiet where idhoadon=".$_GET['id']; 
              $ketqua1 = mysqli_query($conn, $sql1); 
              while ($row1=mysqli_fetch_assoc($ketqua1)){
                  $sql2 = "SELECT * FROM hanghoa where idhanghoa=".$row1['idhanghoa'];           
                $ketqua2 = mysqli_query($conn, $sql2); 
                while ($row2=mysqli_fetch_assoc($ketqua2)){
                $sl=$row1['soluong']+$row2['soluong'];
                $sql="UPDATE `hanghoa` SET `soluong`=$sl WHERE idhanghoa=".$row1['idhanghoa'];
              }
            }
        $ketqua=mysqli_query($conn,$sql);
        $sql="DELETE FROM `chitiet` WHERE idhoadon=".$_GET['id'];
        $ketqua=mysqli_query($conn,$sql);
        $sql="DELETE FROM `hoadon` WHERE idhoadon=".$_GET['id'];
        $ketqua=mysqli_query($conn,$sql);
       
       } 
   }
     }
    
?>


</head>

<body>
  <div class="container service">
    <center>
      <form action="" method="post" style="margin-top:50px;margin-bottom:30px">
        <input type="text" name="search" id="" require>
        <input type="submit" class="btn btn-primary" value="Tìm kiếm" name="timkiem">
      </form>
    </center>
    <div class="container">

      <table style="width:1100px" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Người mua</th>
            <th scope="col">Địa chỉ</th>
            <th scope="col">Ngày mua</th>
            <th scope="col">Hàng hóa</th>
            <th scope="col">Thành tiền </th>
            <th scope="col">Sửa</th>
            <th scope="col">Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php
    $sql = "SELECT * FROM hoadon  "; 
    $sqlc="";
 if(isset($_POST['timkiem'])){
  $sql.=" where  ngay like ('%".$_POST['search']."%') or tendangnhap like ('%".$_POST['search']."%')";
  $sqlc=" where  ngay like ('%".$_POST['search']."%') or tendangnhap like ('%".$_POST['search']."%')";
 }
 
       
        $record=($_GET['page']-1)*20;
        $sql.=" LIMIT 20 OFFSET ".$record;

                        
                                $ketqua = mysqli_query($conn, $sql); 
                                while ($row=mysqli_fetch_assoc($ketqua)){
                                    echo "<tr><td>".$row['idhoadon']."</td>";
                                    echo "<td>".$row['tendangnhap']."</td>";
                                    $sql1="SELECT diachi from dangnhap where tendangnhap='".$row['tendangnhap']."'";
                                    $ketqua1=mysqli_query($conn,$sql1);
                                    $row1=mysqli_fetch_assoc($ketqua1);
                                    echo "<td>".$row1['diachi']."</td>";
                                    echo "<td>".$row['ngay']."</td>";
                                    ?>
          <td>
            <?php
                                       $sql2 = "SELECT * FROM chitiet where idhoadon=".$row['idhoadon']; 
                                       $ketqua2 = mysqli_query($conn, $sql2); 
                                       if(mysqli_num_rows($ketqua2)>0){
                                       while ($row2=mysqli_fetch_assoc($ketqua2)){
                                        $sql3="SELECT * from hanghoa where idhanghoa=".$row2['idhanghoa'];
                                        $ketqua3=mysqli_query($conn,$sql3);
                                        if(mysqli_num_rows($ketqua3)>0){
                                        $row3=mysqli_fetch_assoc($ketqua3);
                                           ?>
            <p>Tên hàng:
              <?php echo $row3['tenhang'];?> <br>
              Số lượng:
              <?php echo $row2['soluong'];?> <br>
              Đơn giá:
              <?php echo $row2['dongia'];?> <br>

            </p>
            <div class="row">
              <div class="col-4"> <img style="width:100%" src="./css/img/<?php echo $row3['link'];?>" alt=""></div>
            </div>
            <?php
                                       } else{
                                           echo 'Mặt hàng đã xóa <br>';
                                       }
                                    }}
                                    else{
                                      echo 'Mặt hàng đã xóa <br>';
                                  }
                                    ?>
          </td>
          <?php
                                    echo "<td>".number_format($row['tongtien'],0, ',', '.')."VNĐ</td>";
                                   
                                      ?>
          <td>
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php if($row['xacnhan']==0){
     echo "Chưa xác nhận";
   } else{
     if($row['xacnhan']==1){
       echo "Đã xác nhận";
     }
     else{
       echo "Đã thanh toán";
     }
   }
   ?>
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?php if($row['xacnhan']==0){
     ?>
                <a class="dropdown-item"
                  href="?page=<?php echo $_GET['page'];?>&&id=<?php echo $row['idhoadon'];?>&&xacnhan=1"
                  class="btn btn-primary">Xác nhận</a>
                <a class="dropdown-item"
                  href="?page=<?php echo $_GET['page'];?>&&id=<?php echo $row['idhoadon'];?>&&xacnhan=3"
                  class="btn btn-primary">Đã thanh toán</a>
                <?php
   } else{
     if($row['xacnhan']==1){
      ?>
                <a class="dropdown-item"
                  href="?page=<?php echo $_GET['page'];?>&&id=<?php echo $row['idhoadon'];?>&&xacnhan=1"
                  class="btn btn-primary">Đã thanh toán</a>
                <a class="dropdown-item"
                  href="?page=<?php echo $_GET['page'];?>&&id=<?php echo $row['idhoadon'];?>&&xacnhan=0"
                  class="btn btn-primary">Hủy xác nhận</a>
                <?php
     }
  
   }
   ?>

              </div>
            </div>
          </td>


          <td>

            <a href="?page=<?php echo $_GET['page'];?>&&id=<?php echo $row['idhoadon'];?>&&xoa=0"
              class="btn btn-primary">Xóa</a>
          </td>
          <?php

                            }

                            ?>
        </tbody>
      </table>
    </div>


    <div class="container">
      <center>
        <?php
      $sql="SELECT COUNT(idhoadon) FROM hoadon $sqlc";
      $ketqua = mysqli_query($conn, $sql); 
      $data=mysqli_fetch_row($ketqua)[0];
      $row=ceil($data/20);
      for($i=1;$i<=$row;$i++){
      
             if($_GET['page']==$i){
              
                 ?>

        <strong> <a href="quanlisp.php?id=<?php echo $_GET['id'];?>&&page=<?php echo $i;?> ">
            <?php echo $i;?>
          </a></strong>
        <?php
                 }
             
         else{
            
                 ?>
        <a href="quanlisp.php?id=<?php echo $_GET['id'];?>&&page=<?php echo $i;?> ">
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