<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        table img {
            height: 100px;
            width: 100px;
        }
    </style>
    <style>
        .service {

            box-shadow: 0px 1px 5px 2px rgb(178, 178, 241);
            margin: 10px;

        }
    </style>
</head>

<body>
    <?php
     include "sider.php";?>
    <div class="container service">
        <div class="container">
            <table style="width:1100px;margin-top:50px" class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <td>
                            ID
                        </td>
                        <td>
                            Hàng hóa
                        </td>

                        <td>
                            Người bình luận
                        </td>
                        <td>
                            Nội dung
                        </td>
                    </tr>
                </thead>
                <tbody>


                    <?php
       
        $conn=mysqli_connect("localhost","root", "","banhang2020");

        $sql="SELECT *FROM binhluan";

      $sqlc="";
        if(isset($_POST['timkiem'])){
         $sql.=" where  noidung like '%".$_POST['search']."%' or tendangnhap like '%".$_POST['search']."%' ngay like '%".$_POST['search']."%'";
         $sqlc=" where  noidung like '%".$_POST['search']."%' or tendangnhap like '%".$_POST['search']."%' ngay like '%".$_POST['search']."%'";
        }
        
        $record=($_GET['page']-1)*20;
        $sql.=" LIMIT 20 OFFSET ".$record;



        $ketqua=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($ketqua)){
            echo '<tr><td> '.$row['id'].' </td>';
           
            $sql1="SELECT tenhang, link from hanghoa where idhanghoa=".$row['idhanghoa'];
            $ketqua1=mysqli_query($conn,$sql1);
            $row1=mysqli_fetch_assoc($ketqua1);
            echo '<td>'.$row1['tenhang'].'<br><img src="./css/img/'.$row1['link'].'" alt=""></td>';
            echo '<td>'.$row['tendangnhap'].'</td>';
            echo '<td>'.$row['noidung'].'<a href="traloi.php?id='.$row['id'].'" class="btn btn-light">Trả lời</a><a href="deletebl.php?id='.$row['id'].'" class="btn btn-light">DELETE</a></td></tr>';
        }
    ?>

                </tbody>
            </table>
        </div>


        <div class="container">
            <center>
                <?php
      $sql="SELECT COUNT(id) FROM binhluan $sqlc";
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