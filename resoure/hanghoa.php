<?php
 $cookie_name = "hienthi";
 $cookie_value = 26;
 if(empty($_COOKIE[$cookie_name])){
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    $_COOKIE[$cookie_name] = 26;
    }
 if(isset($_POST['hienthi'])){
    $_COOKIE[$cookie_name] = $_POST['number'];
    setcookie($cookie_name, $_POST['number'], time() + (86400 * 30), "/");
 } 
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/hanghoa.css">
</head>

<body>


    <?php 
    include 'menu.php';
    include 'danhmuc.php';
    $conn=mysqli_connect("localhost","root", "","banhang2020");
    $trang=1;
   
    ?>



    <div class="container" style="margin-top:30px">
        <h3>Sản phẩm</h3>
        <hr>
    </div>
    <div class="container" style="margin-top:20px; margin-bottom:20px">
        <center>
            <form action="" method="POST">
                Số sản phẩm trên 1 trang: <input type="number" min="1" max="100" id=""
                    value="<?php echo  $_COOKIE[$cookie_name];?>" name="number">
                <input type="submit" value="Hiển thị" name="hienthi" class="btn btn-primary">

        </center>
        </form>

    </div>
    <div class="container">
        <div class="row">
            <?php
    $dem=0;
  
    $sql="SELECT * FROM hanghoa";
   $sqlc="";
    if(isset($_GET['soluong'])){
        $sql.=" where dongia >=".$_GET['soluong']." and hienthi=0";
        $sqlc=" where dongia >=".$_GET['soluong']." and hienthi=0";
        if(!empty($_GET['soluong2'])){
        $sql.=" and dongia <=".$_GET['soluong2'];
        $sqlc.=" and dongia <=".$_GET['soluong2'];
        }
    if(isset($_GET['timkiem'])){
        
        $sql.=" and tenhang like '%".$_GET['timkiem']."%'";
        $sqlc.=" and tenhang like '%".$_GET['timkiem']."%'";
    }
}
    else{
        if(isset($_GET['danhmuc'])){
            $sql.=" where iddanhmuc=".$_GET['danhmuc']." and hienthi=0";
            $sqlc=" where iddanhmuc=".$_GET['danhmuc']." and hienthi=0";
             }
             else {
                 $ketqua=mysqli_query($conn,"SELECT *FROM danhmuc");
                 $row=mysqli_fetch_assoc($ketqua);
                 $sql.=" where iddanhmuc=".$row['iddanhmuc']." and hienthi=0";
                 $sqlc=" where iddanhmuc=".$row['iddanhmuc']." and hienthi=0";
             }    
    }
    if(isset($_GET['page'])){
        $record=($_GET['page']-1)*$_COOKIE[$cookie_name];
        $sql.=" LIMIT $_COOKIE[$cookie_name] OFFSET ".$record;
        $trang=$_GET['page'];
    }
    else{
        $sql.=" LIMIT $_COOKIE[$cookie_name] OFFSET 0";
    }
    $ketqua=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($ketqua)){
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
                <a href="./chitiet.php?id=<?php echo $row['idhanghoa'];?>">
                    <img src="./css/img/<?php echo $row['link'];?>" alt="">
                    <h4 class="h4" style="color:black">
                        <?php echo $row['tenhang'];?>
                    </h4>
                    <h5 style="color: #0f9ed8;">
                        <?php echo number_format($row['dongia'], 0, ',', '.');?> <sup>Đ</sup>
                    </h5>
                </a>
            </div>
            <?php
        } else{
         $dem++;
        ?>
            <div class="col col1">

                <a href="./chitiet.php?id=<?php echo $row['idhanghoa'];?>">
                    <img src="./css/img/<?php echo $row['link'];?>" alt="">
                    <h4 class="h4" style="color:black">
                        <?php echo $row['tenhang'];?>
                    </h4>
                    <h5 style="color: #0f9ed8;">
                        <?php echo number_format($row['dongia'], 0, ',', '.');?> <sup>Đ</sup>
                    </h5>
                </a>

            </div>
            <?php }
         }
         while($dem %4!=0){
        ?>
            <div class="col "></div>

            <?php
            $dem++;
         }
        ?>
        </div>
    </div>
    </div>
    <div class="container">
        <center>
            <?php
       
            $sql="SELECT COUNT(idhanghoa) FROM hanghoa   $sqlc";
         $ketqua = mysqli_query($conn, $sql); 
         $data=mysqli_fetch_row($ketqua)[0];
         $row=ceil($data/$_COOKIE[$cookie_name]);
         for($i=1;$i<=$row;$i++){
         
                if($trang==$i){
                    if(isset($_GET['danhmuc'])){
                        ?>
            <strong> <a href="?danhmuc=<?php echo $_GET['danhmuc'];?>&&page=<?php echo $i;?> ">
                    <?php echo $i;?>
                </a></strong>
            <?php
                    }else{
                    ?>

            <strong> <a href="?page=<?php echo $i;?> ">
                    <?php echo $i;?>
                </a></strong>
            <?php
                    }
                }
            else{
                if(isset($_GET['danhmuc'])){
             ?>

            <a href="?danhmuc=<?php echo $_GET['danhmuc'];?>&&page=<?php echo $i;?> ">
                <?php echo $i;?>
            </a>
            <?php
                }
                else{
                    ?>
            <a href="?page=<?php echo $i;?> ">
                <?php echo $i;?>
            </a>
            <?php
                }
         }
        }
        ?>
        </center>
    </div>
    </div>




    <div class="container-fuild">
        <?php
            include "form.php";
            ?>
    </div>
</body>

</html>