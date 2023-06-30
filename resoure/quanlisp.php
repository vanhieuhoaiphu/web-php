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

  <!-- San pham -->
  <div class="container service">
    <div class="container" style="margin-top:100px; margin-left:400px">
      <form action="" method="post">
        <input type="text" name="search" id="" require>
        <input type="submit" value="Tìm kiếm" class="btn btn-primary" name="timkiem">
      </form>
    </div>
    <div class="container">
      <div class="row">

        <div class="col-12">
          <center>
            <table class="table table-bordered table-hover text-center" style="width:1100px">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Tên hàng</th>
                  <th scope="col">Số lượng</th>
                  <th scope="col">Đơn giá</th>
                  <th scope="col">Ảnh</th>
                  <th scope="col">Sửa/Xóa</th>
                </tr>
              </thead>
              <tbody>
                <?php

                                  
                                $conn=mysqli_connect("localhost", "root","","banhang2020");
                                $sql = "SELECT * FROM hanghoa "; 
                             if(isset($_POST['timkiem'])){
                              $sql.=" where iddanhmuc=".$_GET['id']." and tenhang like '%".$_POST['search']."%'";
                              $sqlc=" where iddanhmuc=".$_GET['id']." and tenhang like '%".$_POST['search']."%'";
                             }
                             else{
                              $sql.=" where iddanhmuc=".$_GET['id'];
                              $sqlc=" where iddanhmuc=".$_GET['id'];
                             }
                                   
                                    $record=($_GET['page']-1)*20;
                                    $sql.=" LIMIT 20 OFFSET ".$record;
                               
                                $ketqua = mysqli_query($conn, $sql); 
                                while ($row=mysqli_fetch_assoc($ketqua)){
                                   
                                    echo "<tr><td>".$row['idhanghoa']."</td>";
                                    echo "<td>".$row['tenhang']."</td>";
                                    echo "<td>".$row['soluong']."</td>";
                                    echo "<td>".$row['dongia']."</td>";
                        ?>
                <td><img class="as" src="./css/img/<?php echo $row['link'];?>" alt="" height="100" width="100"></td>
                <td><a href="suahanghoa.php?id=<?php echo $_GET['id'];?>&&sua=<?php echo $row['idhanghoa'];?>"
                    class="btn btn-primary">Sửa</a>
                  <a href="xoahang.php?iddm=<?php echo $_GET['id'];?>&&page=<?php echo $_GET['page'];?>&&id=<?php echo $row['idhanghoa'];?>"
                    class="btn btn-primary">Xóa</a>
                  <?php if($row['hienthi']==0){
            ?>
                  <a href="suahanghoa.php?iddm=<?php echo $_GET['id'];?>&&page=<?php echo $_GET['page'];?>&&id=<?php echo $row['idhanghoa'];?>&&hienthi=1"
                    class="btn btn-primary">Ẩn</a>
                  <?php
          }
          else
          {
            ?>
                  <a href="suahanghoa.php?iddm=<?php echo $_GET['id'];?>&&page=<?php echo $_GET['page'];?>&&id=<?php echo $row['idhanghoa'];?>&&hienthi=0"
                    class="btn btn-primary">Hiển thị</a>
                  <?php
          }
          ?>
                </td>
                </tr>
                <?php

                            }

                            ?>
              </tbody>
            </table>
            <div class="container">
              <center>
                <?php
      $sql="SELECT COUNT(idhanghoa) FROM hanghoa  $sqlc";
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
          </center>
        </div>
      </div>
    </div>
  </div>


</body>

</html>