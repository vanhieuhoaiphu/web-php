<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php include 'menu.php';
    include 'danhmuc.php';
   
    ?>

  <?php
                           if(isset($_GET['hoadon'])){
                            $sql1 = "SELECT * FROM chitiet where idhoadon=".$_GET['hoadon']; 
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
                            $sql="DELETE FROM `chitiet` WHERE idhoadon=".$_GET['hoadon'];
                            $ketqua=mysqli_query($conn,$sql);
                            $sql="DELETE FROM `hoadon` WHERE idhoadon=".$_GET['hoadon'];
                            $ketqua=mysqli_query($conn,$sql);
                           
                           } 

                          ?>



  <?php  
  
                           
   
    
    
    if(isset($_SESSION['tendangnhap'])){?>
  <div class="container">
    <p class="text-center">Các đơn hàng</p>
    <table class="table">
      <a href=""></a>
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Tên hàng</th>
          <th scope="col">Ảnh</th>
          <th>Sửa/Xóa</th>
        </tr>
      </thead>
      <tbody>
        <?php

                               $tendangnhap=$_SESSION['tendangnhap'];

                                $sql = "SELECT * FROM hoadon where tendangnhap='$tendangnhap'"; 
                                $ketqua = mysqli_query($conn, $sql); 
                                while ($row=mysqli_fetch_assoc($ketqua)){
                                  $sql1 = "SELECT * FROM chitiet where idhoadon=".$row['idhoadon']; 
                                  $ketqua1 = mysqli_query($conn, $sql1); 
                                
                                  while ($row1=mysqli_fetch_assoc($ketqua1)){
                                    $sql2 = "SELECT * FROM hanghoa where idhanghoa=".$row1['idhanghoa']; 
                                
                                  $ketqua2 = mysqli_query($conn, $sql2); 
                                  while ($row2=mysqli_fetch_assoc($ketqua2)){
                                    echo "<tr><td>".$row2['idhanghoa']."</td>";
                                    echo "<td>".$row2['tenhang']."so luong".$row1['soluong']."</td>";
                                
                                    ?>
        <td><img src="./css/img/<?php echo $row2['link'];?>" height="100px" width="100px" alt=""></td>



        <?php
                                      }
                                    }
                                    if($row['xacnhan']==0){
                                      ?>

        <td><a href="?hoadon=<?php echo $row['idhoadon'];?>" class="btn btn-danger">Xóa</a>
        </td>
        </tr>
        <?php
                                                }
                                                else if($row['xacnhan']==3){
                                                  ?>
                                                   <td>Đã xác nhận
        </td>
        </tr>
                                                  <?php
                                                }
                                                else{
                                                  ?>
        <td>Đã xác nhận
        </td>
        </tr>
        <?php
                                                }
                            }  } else{
                              echo " <center style=height:30vh>Đăng nhập để kiểm tra đơn hàng </center>";
                          
                            }

                            ?>
      </tbody>
    </table>

  </div>



  <?php include 'form.php';
?>
</body>

</html>